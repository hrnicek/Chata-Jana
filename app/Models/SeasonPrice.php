<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeasonPrice extends Model
{
    /** @use HasFactory<\Database\Factories\SeasonPriceFactory> */
    use HasFactory;

    protected $fillable = [
        'season_id',
        'price_per_night',
        'price_per_week',
        'min_nights',
        'max_nights',
    ];

    protected function casts(): array
    {
        return [
            'price_per_night' => 'decimal:2',
            'price_per_week' => 'decimal:2',
        ];
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
