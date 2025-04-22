<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Trip;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function getActivities()
    {
        $activities = auth()->user()->recentActivities()
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($activity) {
                return [
                    'description' => $activity->description,
                    'created_at' => $activity->created_at->diffForHumans()
                ];
            });

        return response()->json($activities);
    }

    public function getTrips()
    {
        $trips = auth()->user()->upcomingTrips()
            ->where('start_date', '>=', Carbon::now())
            ->orderBy('start_date')
            ->take(5)
            ->get()
            ->map(function ($trip) {
                return [
                    'destination' => $trip->destination,
                    'start_date' => $trip->start_date->format('M d, Y'),
                    'end_date' => $trip->end_date->format('M d, Y')
                ];
            });

        return response()->json($trips);
    }
} 