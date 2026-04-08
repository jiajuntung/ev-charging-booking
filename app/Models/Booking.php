<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'station_id', 'booking_time', 'status'];
    
    /*Update Booking Model*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function station()
    {
        return $this->belongsTo(Stations::class);
    }
}
