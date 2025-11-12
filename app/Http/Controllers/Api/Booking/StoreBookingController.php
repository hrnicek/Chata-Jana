<?php

namespace App\Http\Controllers\Api\Booking;

use App\Events\BookingPlaced;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Extra;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StoreBookingController extends Controller
{
    /**
     * Store a new booking.
     */
    public function __invoke(StoreBookingRequest $request): JsonResponse
    {
        $data = $request->validated();

        [$booking, $customer] = DB::transaction(function () use ($data) {
            $customer = Customer::query()->firstOrCreate(
                ['email' => $data['customer']['email']],
                [
                    'first_name' => $data['customer']['first_name'],
                    'last_name' => $data['customer']['last_name'],
                    'phone' => $data['customer']['phone'],
                ],
            );

            $customer->fill([
                'first_name' => $data['customer']['first_name'],
                'last_name' => $data['customer']['last_name'],
                'phone' => $data['customer']['phone'],
            ])->save();

            $start = Carbon::createFromFormat('Y-m-d', $data['start_date'])->startOfDay();
            $end = Carbon::createFromFormat('Y-m-d', $data['end_date'])->startOfDay();
            $nights = $start->diffInDays($end) + 1;

            $addonsTotal = 0.0;
            $selections = (array) ($data['addons'] ?? []);

            if (! empty($selections)) {
                $overlapping = Booking::query()
                    ->where('status', '!=', 'cancelled')
                    ->where('start_date', '<=', $end->toDateString())
                    ->where('end_date', '>=', $start->toDateString())
                    ->with(['extras'])
                    ->get();

                foreach ($selections as $selection) {
                    /** @var Extra|null $extra */
                    $extra = Extra::query()->find($selection['extra_id']);
                    $qty = (int) ($selection['quantity'] ?? 0);
                    if (! $extra || ! $extra->is_active || $qty <= 0) {
                        continue;
                    }

                    $bookedQty = 0;
                    foreach ($overlapping as $b) {
                        $pivot = $b->extras->firstWhere('id', $extra->id)?->pivot;
                        if ($pivot) {
                            $bookedQty += (int) $pivot->quantity;
                        }
                    }

                    $availableQty = max(0, (int) $extra->max_quantity - $bookedQty);
                    if ($availableQty < $qty) {
                        throw new \Illuminate\Validation\ValidationException(validator([], []), response()->json([
                            'message' => 'Selected extras are not available in requested quantity.',
                            'extra_id' => $extra->id,
                            'available_quantity' => $availableQty,
                        ], 422));
                    }

                    $lineTotal = (float) ($extra->price_type === 'per_day' ? $qty * $nights * (float) $extra->price : $qty * (float) $extra->price);
                    $addonsTotal += $lineTotal;
                }
            }

            $total = (float) ($data['grand_total'] ?? 0);
            if ($total <= 0) {
                $total = (float) (($data['accommodation_total'] ?? 0) + ($data['addons_total'] ?? $addonsTotal));
            }

            $booking = Booking::query()->create([
                'season_id' => null,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'total_price' => $total,
                'status' => 'pending',
            ]);

            // Attach extras pivot rows
            foreach ($selections as $selection) {
                /** @var Extra|null $extra */
                $extra = Extra::query()->find($selection['extra_id']);
                $qty = (int) ($selection['quantity'] ?? 0);
                if (! $extra || ! $extra->is_active || $qty <= 0) {
                    continue;
                }
                $lineTotal = (float) ($extra->price_type === 'per_day' ? $qty * $nights * (float) $extra->price : $qty * (float) $extra->price);
                $booking->extras()->attach($extra->id, [
                    'quantity' => $qty,
                    'price_total' => $lineTotal,
                ]);
            }

            event(new BookingPlaced($booking, $customer));

            return [$booking, $customer];
        });

        return response()->json([
            'id' => $booking->id,
            'status' => $booking->status->value ?? (string) $booking->status,
            'start_date' => $booking->start_date->toDateString(),
            'end_date' => $booking->end_date->toDateString(),
            'total_price' => (float) $booking->total_price,
            'customer' => [
                'id' => $customer->id,
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'email' => $customer->email,
                'phone' => $customer->phone,
            ],
        ], 201);
    }
}
