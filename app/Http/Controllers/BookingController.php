<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Trip;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * List all bookings for the logged-in user.
     */
    public function index()
    {
        $bookings = Auth::user()->bookings()->with('trip', 'payment')->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Store a new booking (reservation).
     */
    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
        ]);

        $trip = Trip::findOrFail($request->trip_id);

        // Prevent double booking
        if (Auth::user()->bookings()->where('trip_id', $trip->id)->exists()) {
            return back()->with('error', 'You have already reserved this trip.');
        }

        // Check if spots are available
        if ($trip->bookings()->count() >= $trip->max_participants) {
            return back()->with('error', 'No spots left for this trip.');
        }

        if (Auth::user()->bookings()->where('trip_id', $trip->id)->exists()) {
            return back()->with('error', 'You have already reserved this trip.');
        }
        
        // Proceed with booking logic
        Booking::create([
            'user_id' => Auth::id(),
            'trip_id' => $trip->id,
            'status' => 'confirmed',
            'participants' => $request->participants,
            'total_price' => $trip->price * $request->participants,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);
        
        return back()->with('success', 'Trip reserved successfully!');

        // Redirect to payment page or show a message
        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Reservation successful! Please proceed to payment.');
    }

    /**
     * Show a single booking.
     */
    public function show($id)
    {
        $booking = Auth::user()->bookings()->with('trip', 'payment')->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Cancel a booking.
     */
    public function destroy($id)
    {
        $booking = Auth::user()->bookings()->findOrFail($id);
        $booking->delete();
        return back()->with('success', 'Booking cancelled.');
    }

    /**
     * Mark booking as paid after PayPal payment.
     */
    public function markPaid(Request $request, $id)
    {
        $booking = Auth::user()->bookings()->findOrFail($id);
        $booking->update([
            'status' => 'paid',
        ]);
        return redirect()->route('bookings.show', $booking->id)->with('success', 'Payment successful!');
    }
}