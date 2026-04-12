<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = ['name', 'address', 'total_charging_points', 'image'];
    
    /*Update Stations Model*/
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
