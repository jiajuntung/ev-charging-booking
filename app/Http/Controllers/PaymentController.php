<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show(Booking $booking)
    {
        abort_if($booking->user_id !== Auth::id(), 403);
        return view('bookings.payment', compact('booking'));
    }

    public function pay(Request $request, Booking $booking)
    {
        abort_if($booking->user_id !== Auth::id(), 403);

        $request->validate([
            'payment_method' => 'required|in:tng,fpx,card',
        ]);

        return redirect()->route('payment.success', [
            'booking' => $booking->id,
            'method' => $request->payment_method,
        ]);
    }

    public function success(Request $request, Booking $booking)
    {
        abort_if($booking->user_id !== Auth::id(), 403);

        $paymentMethod = $request->query('method');

        return view('bookings.payment-success', compact('booking', 'paymentMethod'));
    }
}