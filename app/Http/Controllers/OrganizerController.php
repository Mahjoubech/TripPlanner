<?php

namespace App\Http\Controllers;
use App\Models\Trip;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    
    public function dashboard()
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to access the dashboard.');
        }
    
        // Statistics
        $totalTrips = Trip::where('organizer_id', $user->id)->count();
        $totalBookings = Booking::whereHas('trip', function ($query) use ($user) {
            $query->where('organizer_id', $user->id);
        })->count();
        $totalRevenue = Booking::whereHas('trip', function ($query) use ($user) {
            $query->where('organizer_id', $user->id);
        })->sum('total_price');
        $pendingTrips = Trip::where('organizer_id', $user->id)->where('status', 'pending')->count();
    
        // Chart Data
        $revenueData = [5000, 8000, 12000, 15000, 20000]; // Example data
        $bookingLabels = ['Paris', 'Rome', 'London', 'Barcelona'];
        $bookingData = [150, 120, 90, 75];
        $satisfactionData = [65, 20, 10, 5]; // Example satisfaction percentages
    
        return view('organizer.dashboard', compact(
            'totalTrips', 'totalBookings', 'totalRevenue', 'pendingTrips',
            'revenueData', 'bookingLabels', 'bookingData', 'satisfactionData'
        ));
    }
    public function pending()
    {
        return view('organizer.pending');
    }

    public function organizerTrips()
    {
        return view('organizer.organizer-trips');
    }

   

    public function bookings()
    {
        return view('organizer.bookings');
    }

  
    public function addTrip(){
        return view('organizer.addTrips');
    }
    public function profile()
    {
        return view('organizer.profile.profile');
    }
}