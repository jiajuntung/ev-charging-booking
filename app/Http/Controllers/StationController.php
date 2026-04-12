<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StationController extends Controller
{

    //Show all stations/
    public function index()
    {
        $stations = Station::all();
        return view('stations.index', compact('stations'));
    }

    //Show station booking page/
    public function create()
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        return view('stations.create');
    }

    //Create new station/
    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

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
        $totalCost = $totalMinutes * 0.05;

        $popularStations = Station::take(10)->get();

        return view('dashboard', compact('popularStations', 'totalKwh', 'totalCost'));
    }
}
