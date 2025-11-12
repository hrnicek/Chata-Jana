<?php

namespace App\Http\Controllers\Api\Extra;

use App\Http\Controllers\Controller;
use App\Http\Requests\Extra\CheckAvailabilityRequest;
use App\Models\Booking;
use App\Models\Extra;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class CheckAvailabilityController extends Controller
{
    public function __invoke(CheckAvailabilityRequest $request): JsonResponse
    {
        $data = $request->validated();

        $start = Carbon::createFromFormat('Y-m-d', $data['start_date'])->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $data['end_date'])->endOfDay();

        $overlappingBookings = Booking::query()
            ->where('status', '!=', 'cancelled')
            ->where('start_date', '<=', $end->toDateString())
            ->where('end_date', '>=', $start->toDateString())
            ->with(['extras'])
            ->get();

        $resultItems = [];
        $overallAvailable = true;

        foreach ($data['selections'] as $selection) {
            /** @var Extra $extra */
            $extra = Extra::query()->find($selection['extra_id']);
            if (! $extra || ! $extra->is_active) {
                $resultItems[] = [
                    'extra_id' => $selection['extra_id'],
                    'available_quantity' => 0,
                    'requested_quantity' => (int) $selection['quantity'],
                    'is_available' => false,
                ];
                $overallAvailable = false;

                continue;
            }

            $bookedQty = 0;
            foreach ($overlappingBookings as $booking) {
                $pivot = $booking->extras->firstWhere('id', $extra->id)?->pivot;
                if ($pivot) {
                    $bookedQty += (int) $pivot->quantity;
                }
            }

            $availableQty = max(0, (int) $extra->max_quantity - $bookedQty);
            $isAvailable = $availableQty >= (int) $selection['quantity'];
            $overallAvailable = $overallAvailable && $isAvailable;

            $resultItems[] = [
                'extra_id' => $extra->id,
                'available_quantity' => $availableQty,
                'requested_quantity' => (int) $selection['quantity'],
                'is_available' => $isAvailable,
            ];
        }

        return response()->json([
            'available' => $overallAvailable,
            'items' => $resultItems,
        ]);
    }
}
