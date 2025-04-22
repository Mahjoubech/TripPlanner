<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities with pagination and search functionality.
     */
    public function index(Request $request)
    {
        $activities = Activity::query()
            ->latest();

        if ($request->has('search') && $request->search) {
            $search = $request->input('search');
            $activities->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->orWhere('difficulty', 'like', '%' . $search . '%');
            });
        }

        return view('organizer.activity.activity', ['activities' => $activities->paginate(5)]);
    }

    /**
     * Show the form for creating a new activity.
     */
    public function create()
    {
        return view('organizer.activity.addActivity');
    }

    /**
     * Store a newly created activity in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:50',
            'description' => 'required|min:10|max:500',
            'location' => 'required|max:100',
            'duration' => 'required|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'price' => 'required|numeric|min:0',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);

        $validatedData['organizer_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('activities', 'public');
            $validatedData['image'] = $imagePath;
        }

        Activity::create($validatedData);

        return redirect()->route('activity.index')->with([
            'message' => 'Activity created successfully!',
            'type' => 'success',
        ]);
    }

    /**
     * Display the specified activity.
     */
    public function show(Activity $activity)
    {
        return view('organizer.activity.activityDetail', compact('activity'));
    }

    /**
     * Show the form for editing the specified activity.
     */
    public function edit(Activity $activity)
    {
        if (Auth::id() !== $activity->organizer_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('organizer.activity.editActivity', compact('activity'));
    }

    /**
     * Update the specified activity in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        if (Auth::id() !== $activity->organizer_id) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'name' => 'required|min:3|max:50',
            'description' => 'required|min:10|max:500',
            'location' => 'required|max:100',
            'duration' => 'required|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($activity->image) {
                Storage::disk('public')->delete($activity->image);
            }

            $imagePath = $request->file('image')->store('activities', 'public');
            $validatedData['image'] = $imagePath;
        }

        $activity->update($validatedData);

        return redirect()->route('activity.index')->with([
            'message' => 'Activity updated successfully!',
            'type' => 'success',
        ]);
    }

    /**
     * Remove the specified activity from storage.
     */
    public function destroy(Activity $activity)
    {
        if (Auth::id() !== $activity->organizer_id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the image if it exists
        if ($activity->image) {
            Storage::disk('public')->delete($activity->image);
        }

        $activity->delete();

        return redirect()->route('activity.index')->with([
            'message' => 'Activity deleted successfully!',
            'type' => 'success',
        ]);
    }
}