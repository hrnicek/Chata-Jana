<?php

namespace App\Http\Controllers\Api\Booking;

use App\Events\BookingPlaced;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
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

            $total = (float) ($data['grand_total'] ?? 0);
            if ($total <= 0) {
                $total = (float) (($data['accommodation_total'] ?? 0) + ($data['addons_total'] ?? 0));
            }

            $booking = Booking::query()->create([
                'season_id' => null,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'total_price' => $total,
                'status' => 'pending',
            ]);

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
