<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stations extends Model
{
    /*Update Stations Model*/
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
