<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Extra extends Model
{
    /** @use HasFactory<\Database\Factories\ExtraFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price_type',
        'price',
        'max_quantity',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function bookings(): BelongsToMany
    {
        return $this->belongsToMany(Booking::class, 'booking_extras')
            ->withPivot(['quantity', 'price_total'])
            ->withTimestamps();
    }
}
