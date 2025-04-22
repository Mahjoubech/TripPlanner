<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    /**
     * Display a listing of hotels with pagination and search functionality.
     */
    public function index()
    {
        $hotels = Hotel::latest();

        if (request()->has('search')) {
            $search = request()->get('search', '');

            $hotels = $hotels->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%')
                    ->orWhere('country', 'like', '%' . $search . '%');
            });
        }

        return view('organizer.hotels.hotels', ['hotels' => $hotels->paginate(5)]);
    }

    /**
     * Show the form for creating a new hotel.
     */
    public function create()
    {
        return view('organizer.hotels.addHotels');
    }

    /**
     * Store a newly created hotel in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:50',
            'description' => 'required|min:10|max:500',
            'address' => 'required|max:100',
            'city' => 'required|max:50',
            'country' => 'required|max:50',
            'stars' => 'required|integer|min:1|max:5',
            'amenities' => 'required|',
           'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'image.image' => 'The uploaded file must be an image.',
        'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        'image.max' => 'The image size must not exceed 2MB.',
    ]);

        $validatedData['organizer_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hotels', 'public');
            $validatedData['image'] = $imagePath;
        }

        Hotel::create($validatedData);

        return redirect()->route('hotels.index')->with('message', 'Hotel created successfully!')
                                                ->with('type','success');
    }

    /**
     * Display the specified hotel.
     */
    public function show(Hotel $hotel)
    {
        return view('organizer.hotels.hotels', compact('hotel'));
    }
     public function showDetail(Hotel $hotel){
        return view('organizer.hotels.hotelsDetail', compact('hotel'));
     }
    /**
     * Show the form for editing the specified hotel.
     */
    public function edit(Hotel $hotel)
    {
        if (Auth::id() !== $hotel->organizer_id) {
            abort(403);
        }

        return view('organizer.hotels.editHotel', compact('hotel'));
    }

    /**
     * Update the specified hotel in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        if (Auth::id() !== $hotel->organizer_id) {
            abort(403);
        }

        $validatedData = $request->validate([
            'name' => 'required|min:3|max:50',
            'description' => 'required|min:10|max:500',
            'address' => 'required|max:100',
            'city' => 'required|max:50',
            'country' => 'required|max:50',
            'stars' => 'required|integer|min:1|max:5',
            'amenities' => 'required',
           'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'image.image' => 'The uploaded file must be an image.',
        'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        'image.max' => 'The image size must not exceed 2MB.',
    ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hotels', 'public');
            $validatedData['image'] = $imagePath;
        }

        $hotel->update($validatedData);

        return redirect()->route('hotels.index', $hotel->id)->with('message', 'Hotel updated successfully!')
        ->with('type', 'success');
    }

    /**
     * Remove the specified hotel from storage.
     */
    public function destroy(Hotel $hotel)
    {
        if (Auth::id() !== $hotel->organizer_id) {
            abort(403);
        }

        // Delete the image if it exists
        if ($hotel->image) {
            \Storage::disk('public')->delete($hotel->image);
        }

        $hotel->delete();

        return redirect()->route('hotels.index')->with('message', 'Hotel deleted successfully!')
                                                ->with('type', 'success');;
    }
}