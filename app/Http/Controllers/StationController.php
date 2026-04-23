<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class StationController extends Controller
{

    //Show all stations/
    public function index(Request $request)
    {
        $query = Station::query();

        // Filter by location / station name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Filter by available time slot
        if ($request->filled('time')) {
            $time = $request->time;
            $query->where('is_available', true)
                  ->whereHas('bookings', function ($q) use ($time) {
                      $q->whereIn('status', ['confirmed', 'charging'])
                        ->where('booking_time', '<=', $time)
                        ->whereRaw('DATE_ADD(booking_time, INTERVAL duration MINUTE) > ?', [$time]);
                  }, '<', DB::raw('total_charging_points'));
        }

        $stations = $query->get();
        return view('stations.index', compact('stations'));
    }

    //Show station booking page/
    public function create()
    {
        Gate::authorize('manage-stations');

        return view('stations.create');
    }

    //Create new station/
    public function store(Request $request)
    {
        Gate::authorize('manage-stations');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'total_charging_points' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('stations', 'public');
        }

        Station::create($validated);

        return redirect()->route('stations.index')->with('success', 'Station added successfully!');
    }

    //Update station details/
    public function update(Request $request, Station $station)
    {
        Gate::authorize('manage-stations');
        $validated = $request->validate([
            'address' => 'required|string',
            'total_charging_points' => 'required|integer|min:1',
        ]);
        $station->update($validated);
        return redirect()->route('stations.create')->with('success', "\"{$station->name}\" updated successfully.");
    }

    //Delete a station/
    public function destroy(Station $station)
    {
        Gate::authorize('manage-stations');
        $station->delete();
        return redirect()->route('stations.create')->with('success', "Station \"{$station->name}\" deleted successfully.");
    }

    //Toggle station availability/
    public function toggleAvailability(Station $station)
    {
        Gate::authorize('manage-stations');
        $station->update(['is_available' => !$station->is_available]);
        $status = $station->is_available ? 'available' : 'unavailable';
        return redirect()->route('stations.create')->with('success', "\"{$station->name}\" marked as {$status}.");
    }

    //Show station booking page/
    public function showBook(Station $station)
    {
        return view('stations.book', compact('station'));
    }

    //Show at Dashboard/
    public function dashboard()
    {
        $bookings = auth()->user()->bookings()->where('status', 'completed')->get();

        $totalMinutes = 0;
        foreach ($bookings as $booking) {
            $totalMinutes += $booking->started_at->diffInMinutes($booking->ended_at);
        }

        $totalKwh = $totalMinutes * 0.05;
        $totalCost = $bookings->sum('amount_charged');

        $popularStations = Station::take(10)->get();

        return view('dashboard', compact('popularStations', 'totalKwh', 'totalCost'));
    }
}
