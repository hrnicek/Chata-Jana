<?php

namespace App\Actions\Booking;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Services\BookingPriceCalculator;
use App\States\Booking\Pending;
use App\Services\BookingRules;
use App\Rules\Booking\MinStayRule;
use App\Rules\Booking\CheckInDayRule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CreateBookingAction
{
    // ...

    public function __construct(
        private BookingPriceCalculator $priceCalculator,
        private CalculateDominantSeasonAction $seasonCalculator,
        private ValidateAvailabilityAction $availabilityValidator,
        private BookingRules $bookingRules
    ) {
        // Register default rules
        $this->bookingRules
            ->addRule(new MinStayRule())
            ->addRule(new CheckInDayRule());
    }

    public function execute(array $data): Booking
    {
        return DB::transaction(function () use ($data) {
            // 1. Find or create customer
            $customer = Customer::query()->create(
                [
                    'email' => $data['customer']['email'],
                    'first_name' => $data['customer']['first_name'],
                    'last_name' => $data['customer']['last_name'],
                    'phone' => $data['customer']['phone'],
                ]
            );

            //2. Parse dates
            $startDate = Carbon::createFromFormat('Y-m-d', $data['start_date'])->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $data['end_date'])->startOfDay();

            // 3. Validate availability
            $availability = $this->availabilityValidator->execute($startDate, $endDate);
            if (!$availability['available']) {
                throw new \Exception('Selected dates are not available.');
            }

            // 5. Determine dominant season (moved up for validation)
            $season = $this->seasonCalculator->execute($startDate, $endDate);

            // Validate business rules
            $this->bookingRules->validate($startDate, $endDate, $season);

            // 4. Calculate price
            $priceBreakdown = $this->priceCalculator->calculate(
                $startDate,
                $endDate,
                $data['addons'] ?? []
            );

            // 6. Create booking
            $booking = Booking::create([
                'customer_id' => $customer->id,
                'season_id' => $season?->id,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'total_price' => $priceBreakdown->total,
                'status' => Pending::class,
            ]);

            // 7. Attach services
            foreach ($data['addons'] ?? [] as $selection) {
                $service = Service::find($selection['extra_id'] ?? $selection['service_id'] ?? null);
                $quantity = (int) ($selection['quantity'] ?? 0);

                if (!$service || !$service->is_active || $quantity <= 0) {
                    continue;
                }

                $nights = max(1, $startDate->diffInDays($endDate));
                $lineTotal = $service->price_type === 'per_day'
                    ? $quantity * $nights * (float) $service->price
                    : $quantity * (float) $service->price;

                $booking->services()->attach($service->id, [
                    'quantity' => $quantity,
                    'price_total' => $lineTotal,
                ]);
            }

            return $booking->load(['customer', 'services']);
        });
    }
}
