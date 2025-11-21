<?php

namespace App\Http\Controllers\Api\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\VerifyCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class VerifyCustomerController extends Controller
{
    public function __invoke(VerifyCustomerRequest $request): JsonResponse
    {
        $data = $request->validated();

        $exists = false;
        $existingId = null;

        if (isset($data['customer']['email'])) {
            $existing = Customer::query()->where('email', $data['customer']['email'])->first();
            if ($existing) {
                $exists = true;
                $existingId = $existing->id;
            }
        }

        return response()->json([
            'valid' => true,
            'exists' => $exists,
            'customer_id' => $existingId,
        ]);
    }
}

