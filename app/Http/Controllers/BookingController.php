<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Stations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /*Show all bookings*/
    public function index() 
    {
        $bookings = Auth::user()->bookings()->with('station')->get();
        return view('bookings.index', compact('bookings'));
    }

    /*Store Booking*/
    public function store(Request $request)
    {
        $validated = $request->validate
        ([
            'station_id'=>'required|exists:stations,id',
            'booking_time'=>'required|date|after:now',
        ]);

        /*Create using Eloquent*/
        Booking::create
        ([
            'user_id' => Auth::id(),
            'station_id' => $validated['station_id'],
            'booking_time' => $validated['booking_time'],
            'status' => 'confirmed',
        ]);

        return redirect()->back()->with('success', 'Booking successfully!');
    }

    /*Cancel Booking*/
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->back()->with('success', 'Booking cancelled successfully!');
    }
}
