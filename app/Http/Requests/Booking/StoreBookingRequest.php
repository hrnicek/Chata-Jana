<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'end_date' => ['required', 'date_format:Y-m-d', 'after:start_date'],
            'customer.first_name' => ['required', 'string', 'max:255'],
            'customer.last_name' => ['required', 'string', 'max:255'],
            'customer.email' => ['required', 'email', 'max:255'],
            'customer.phone' => ['required', 'string', 'max:50'],
            'customer.note' => ['nullable', 'string', 'max:2000'],
            'accommodation_total' => ['nullable', 'numeric', 'min:0'],
            'grand_total' => ['nullable', 'numeric', 'min:0'],
            'addons_total' => ['nullable', 'numeric', 'min:0'],
            'addons' => ['nullable', 'array'],
            'addons.*.extra_id' => ['required_without:addons.*.service_id', 'integer', 'exists:services,id'],
            'addons.*.service_id' => ['required_without:addons.*.extra_id', 'integer', 'exists:services,id'],
            'addons.*.quantity' => ['required_with:addons', 'integer', 'min:0'],
        ];
    }
}
