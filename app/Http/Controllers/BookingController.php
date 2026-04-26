<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'duration' => 'required|integer|min:30|max:240',
        ]);

        $startTime = Carbon::parse($validated['booking_time']);
        $endTime = (clone $startTime)->addMinutes((int) $validated['duration']);

        return DB::transaction(function () use ($validated, $startTime, $endTime) {
            $station = Station::where('id', $validated['station_id'])->lockForUpdate()->first();

            $overlapCount = Booking::where('station_id', $validated['station_id'])
                ->whereIn('status', ['confirmed', 'charging'])
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->where(function ($q) use ($startTime, $endTime) {
                        $q->where('booking_time', '<', $endTime)
                        ->whereRaw('DATE_ADD(booking_time, INTERVAL duration MINUTE) > ?', [$startTime]);
                    });
                })
                ->count();

            if ($overlapCount >= $station->total_charging_points) {
                return redirect()->back()->withErrors(['booking_time' => 'The outlets are full during this time slot. Please select another time.']);
            }

            Booking::create([
                'user_id' => Auth::id(),
                'station_id' => $validated['station_id'],
                'booking_time' => $startTime,
                'duration' => $validated['duration'],
                'status' => 'confirmed',
            ]);

            return redirect()->route('bookings.index')->with('success', 'Booking successfully!');
        });
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
        $station = $booking->station;
        $bookingTime = Carbon::parse($booking->booking_time);

        if (now()->lessThan($bookingTime->copy()->subMinutes(5))) {
            return redirect()->back()->with('error', 'Too early to start charging. You can start charging 5 minutes before the booking time.');
        }

        $currentChargingCount = Booking::where('station_id', $booking->station_id)
            ->where('status', 'charging')
            ->count();

        if ($currentChargingCount >= $station->total_charging_points) {
            return redirect()->back()->with('error', 'All charging slots are currently occupied. Please wait for the previous user to finish.');
        }

        $booking->update([
            'status' => 'charging',
            'started_at' => now(),
        ]);

        return view('bookings.status', compact('booking'));
    }

    //Stop Charging/
    public function stopCharging(Request $request, Booking $booking)
    {
        $request->validate([
            'kwh_charged'    => 'required|numeric|min:0',
            'amount_charged' => 'required|numeric|min:0',
        ]);

        $booking->update([
            'status' => 'completed',
            'ended_at' => now(),
            'kwh_charged' => $request->kwh_charged,
            'amount_charged' => $request->amount_charged,
        ]);

        return redirect()->route('payment.show', $booking->id);
    }
}
