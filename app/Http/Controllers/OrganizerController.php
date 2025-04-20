<?php

namespace App\Http\Controllers;

class OrganizerController extends Controller
{
    public function dashboard()
    {
        return view('organizer.dashboard');
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

    public function messages()
    {
        return view('organizer.messages');
    }

    public function notifications()
    {
        return view('organizer.notifications');
    }

    public function settings()
    {
        return view('organizer.settings');
    }
    public function addTrip(){
        return view('organizer.addTrips');
    }
    public function profile()
    {
        return view('organizer.profile.profile');
    }
}