<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Hotel;
use App\Models\Activity;
use App\Models\Transport;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    /**
     * Display a listing of trips with pagination and search functionality.
     */
    public function index(Request $request)
    {
        $this->updateTripStatuses();
        $trips = Trip::query()
            ->where('organizer_id', Auth::id())
            ->latest();

        if ($request->has('search') && $request->search) {
            $search = $request->input('search');
            $trips->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        return view('organizer.trips.trips', ['trips' => $trips->paginate(5)]);
    }

    /**
     * Show the form for creating a new trip.
     */
    public function create()
    {
        $hotels = Hotel::all();
        $activities = Activity::all();
        $transports = Transport::all();

        return view('organizer.trips.AddTrip', compact('hotels', 'activities', 'transports'));
    }

    /**
     * Store a newly created trip in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:10|max:1000',
            'location' => 'required|max:100',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'required|numeric|min:0',
            'max_participants' => 'required|integer|min:1',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hotels' => 'required|nullable|array',
            'activities' => 'required|nullable|array',
            'transport' => 'required|nullable|exists:transports,id',
        ]);
    
        $validatedData['organizer_id'] = Auth::id();
        $validatedData['status'] = 'pending'; 
    
        $startDate = new \DateTime($validatedData['start_date']);
        $endDate = new \DateTime($validatedData['end_date']);
        $validatedData['duration'] = $startDate->diff($endDate)->days + 1; 
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('trips', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        $trip = Trip::create($validatedData);
    
        if ($request->has('hotels')) {
            $trip->hotels()->sync($request->hotels);
        }
    
        if ($request->has('activities')) {
            $trip->activity()->sync($request->activities);
        }
    
        if ($request->has('transport')) {
            $trip->transports()->sync([$request->transport]);
        }
    
        return redirect()->route('trips.index')->with([
            'message' => 'Trip created successfully!',
            'type' => 'success',
        ]);
    }

    /**
     * Display the specified trip.
     */
    public function show(Trip $trip)
    {
        $trip->load(['organizer', 'activity', 'hotels', 'transports', 'reviews.user']);
        return view('client.trip.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified trip.
     */
    public function edit(Trip $trip)
    {
        if (Auth::id() !== $trip->organizer_id) {
            abort(403, 'Unauthorized action.');
        }

        $trip->load(['hotels', 'activity', 'transports']); // Load relationships
        $hotels = Hotel::all();
        $activities = Activity::all();
        $transports = Transport::all();

        return view('organizer.trips.editTrip', compact('trip', 'hotels', 'activities', 'transports'));
    }

    /**
     * Update the specified trip in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        if (Auth::id() !== $trip->organizer_id) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:10|max:1000',
            'location' => 'required|max:100',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'required|numeric|min:0',
            'max_participants' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hotels' => 'nullable|array',
            'activities' => 'nullable|array',
            'transport' => 'nullable|exists:transports,id',
        ]);

        if ($request->hasFile('image')) {
            if ($trip->image) {
                Storage::disk('public')->delete($trip->image);
            }

            $imagePath = $request->file('image')->store('trips', 'public');
            $validatedData['image'] = $imagePath;
        }

        $trip->update($validatedData);

        if ($request->has('hotels')) {
            $trip->hotels()->sync($request->hotels);
        }

        if ($request->has('activities')) {
            $trip->activity()->sync($request->activities);
        }

        if ($request->has('transport')) {
            $trip->transports()->sync([$request->transport]);
        }

        return redirect()->route('trips.index')->with([
            'message' => 'Trip updated successfully!',
            'type' => 'success',
        ]);
    }

    /**
     * Remove the specified trip from storage.
     */
    public function destroy(Trip $trip)
    {
        if (Auth::id() !== $trip->organizer_id) {
            abort(403, 'Unauthorized action.');
        }

        if ($trip->image) {
            Storage::disk('public')->delete($trip->image);
        }

        $trip->hotels()->detach();
        $trip->activity()->detach();
        $trip->transports()->detach();

        $trip->delete();

        return redirect()->route('trips.index')->with([
            'message' => 'Trip deleted successfully!',
            'type' => 'success',
        ]);
    }

    private function updateTripStatuses()
    {
        $today = now();

        Trip::where('start_date', '>', $today)
            ->update(['status' => 'pending']);

        Trip::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->update(['status' => 'completed']);

        Trip::where('end_date', '<', $today->subDay())
            ->update(['status' => 'finished']);
    }
     /**
     * Fetch trips for AJAX requests
     */
    public function fetchTrips(Request $request)
    {
        try {
            $type = $request->input('type', 'all');
            \Log::info('Fetching trips for type: ' . $type);

            $query = Trip::query();

            switch ($type) {
                case 'all':
                    break;
                case 'completed':
                    $query->where('status', 'completed');
                    break;
                case 'pending':
                    $query->where('status', 'pending');
                    break;
            }

            // Select only necessary fields
            $query->select([
                'id',
                'title',
                'description',
                'location',
                'start_date',
                'end_date',
                'price',
                'status',
                'image',
                'organizer_id'
            ])->with(['organizer:id,name,email']);

            // Get the SQL query and bindings for debugging
            $sql = $query->toSql();
            $bindings = $query->getBindings();
            \Log::info('SQL Query:', ['sql' => $sql, 'bindings' => $bindings]);

            $trips = $query->get();
            \Log::info('Trips count: ' . $trips->count());
            \Log::info('Trips data:', ['trips' => $trips->toArray()]);

            if ($trips->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => "No {$type} trips found"
                ]);
            }

            $html = view('client.partials.trip_card', ['trips' => $trips])->render();
            
            return response()->json([
                'success' => true,
                'html' => $html
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in fetchTrips: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Error fetching trips: ' . $e->getMessage()
            ], 500);
        }
    }
}