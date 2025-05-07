<?php
namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch statistics
        $totalUsers = User::count();
        $totalTrips = Trip::count();
        $totalBookings = Trip::withCount('bookings')->get()->sum('bookings_count');
        $totalRevenue = Trip::with('bookings')->get()->sum(function ($trip) {
            return $trip->bookings->sum('total_price');
        });
        $pendingTrips = Trip::where('status', 'pending')->get();
        $users = User::all();

        return view('admin.dashboard', compact('totalUsers', 'totalTrips', 'totalBookings', 'totalRevenue', 'pendingTrips', 'users'));
    }

    public function approveTrip($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->status = 'approved';
        $trip->save();

        return redirect()->back()->with('success', 'Trip approved successfully.');
    }

    public function rejectTrip($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return redirect()->back()->with('success', 'Trip rejected successfully.');
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = true;
        $user->save();

        return redirect()->back()->with('success', 'User blocked successfully.');
    }

    public function unblockUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = false;
        $user->save();

        return redirect()->back()->with('success', 'User unblocked successfully.');
    }
}