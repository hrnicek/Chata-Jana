<?php

namespace App\Http\Controllers\Api\Booking;

use App\Actions\Booking\CreateBookingAction;
use App\Events\BookingPlaced;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\StoreBookingRequest;
use Illuminate\Http\JsonResponse;

class StoreBookingController extends Controller
{
    public function __construct(
        private CreateBookingAction $createBookingAction
    ) {}

    /**
     * Store a new booking.
     */
    public function __invoke(StoreBookingRequest $request): JsonResponse
    {
        try {
            $booking = $this->createBookingAction->execute($request->validated());

            // Dispatch event
            BookingPlaced::dispatch($booking, $booking->customer);

            return response()->json([
                'message' => 'Booking created successfully.',
                'booking' => $booking,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create booking.',
                'error' => $e->getMessage(),
            ], 422);
        }
    }
}
