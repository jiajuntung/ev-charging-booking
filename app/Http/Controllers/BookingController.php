<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    //Show all bookings/
    public function index() 
    {
        $bookings = Auth::user()->bookings()->with('station')->get();
        return view('bookings.index', compact('bookings'));
    }

    //Store Booking/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'station_id'=>'required|exists:stations,id',
            'booking_time'=>'required|date|after:now',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'station_id' => $validated['station_id'],
            'booking_time' => $validated['booking_time'],
            'status' => 'confirmed',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking successfully!');
    }

    //Cancel Booking/
    public function destroy(Booking $booking)
    {
        /*Check if the user is authorized to delete the booking*/
        Gate::authorize('delete', $booking);
        
        $booking->delete();
        return redirect()->back()->with('success', 'Booking cancelled successfully!');
    }

    //Show Booking Status/
    public function showStatus(Booking $booking)
    {
        return view('bookings.status', compact('booking'));
    }

    //Start Charging/
    public function startCharging(Booking $booking)
    {
        $booking->update([
            'status' => 'charging',
            'started_at' => now(),
        ]);

        return view('bookings.status', compact('booking'));
    }

    //Stop Charging/
    public function stopCharging(Booking $booking)
    {
        $booking->update([
            'status' => 'completed',
            'ended_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Charging Finished!');
    } 
}
