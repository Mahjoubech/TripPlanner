<?php

namespace App\Http\Controllers;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('client.dashboard');
    }
    public function profile(){
        return view('client.profile.profile');
    }
}