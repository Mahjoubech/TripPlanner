<?php

namespace App\Http\Controllers;
use App\Models\Trip;

class ClientController extends Controller
{
   
        public function dashboard()
     {
    $upcomingTrips = Trip::whereHas('bookings', function($q) {
        $q->where('user_id', auth()->id());
    })
    ->where('start_date', '>=', now())
    ->orderBy('start_date')
    ->take(5)
    ->get();

    return view('client.dashboard', compact('upcomingTrips'));
    }
    
    public function profile(){
        return view('client.profile.profile');
    }
}