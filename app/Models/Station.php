<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = ['name', 'address', 'total_charging_points', 'image', 'is_available'];
    
    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function availableSlots(): int
    {
        $active = $this->bookings()
            ->whereIn('status', ['confirmed', 'charging'])
            ->whereRaw('DATE_ADD(booking_time, INTERVAL duration MINUTE) > NOW()')
            ->count();

        return max(0, $this->total_charging_points - $active);
    }
}
