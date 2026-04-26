<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'station_id', 'booking_time', 'duration', 'status', 'started_at', 'ended_at', 'kwh_charged', 'amount_charged'];
    protected $casts = ['booking_time' => 'datetime', 'started_at' => 'datetime', 'ended_at' => 'datetime'];

    /*Each booking belongs to one user*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /*Each booking belongs to one station*/
    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function getEndTimeAttribute()
    {
        return $this->booking_time->addMinutes($this->duration);
    }
}
