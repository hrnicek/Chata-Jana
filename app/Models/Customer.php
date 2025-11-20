<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    protected $appends = [
        'name',
    ];

    public function name(): Attribute
    {
        return Attribute::make()
            ->get(fn(Customer $customer): string => $customer->first_name . ' ' . $customer->last_name);
    }

    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class);
    }
}
