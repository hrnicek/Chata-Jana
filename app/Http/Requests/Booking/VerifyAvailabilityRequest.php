<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class VerifyAvailabilityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $minLeadDays = (int) config('booking.min_lead_days', 1);
        $earliest = now()->timezone(config('booking.timezone', 'Europe/Prague'))
            ->addDays($minLeadDays)
            ->toDateString();

        return [
            'start_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:' . $earliest],
            'end_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:start_date'],
        ];
    }
}
