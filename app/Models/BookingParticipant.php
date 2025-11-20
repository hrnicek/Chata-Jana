<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingParticipant extends Model
{
    public function booking(): Booking
    {
        return $this->belongsTo(Booking::class);
    }
}
