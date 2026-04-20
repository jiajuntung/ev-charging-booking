<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'station_id', 'booking_time', 'duration', 'status', 'started_at', 'ended_at'];
    protected $casts = ['booking_time' => 'datetime', 'started_at' => 'datetime', 'ended_at' => 'datetime'];

    /*Update Booking Model*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function getEndAndAttribute()
    {
        return $this->booking_time->addMinutes($this->duration);
    }
}
