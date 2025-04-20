<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TronsportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $transports = Transport::query()
            ->latest();

        if ($request->has('search') && $request->search) {
            $search = $request->input('search');
            $transports->where(function ($query) use ($search) {
                $query->where('type', 'like', '%' . $search . '%')
                    ->orWhere('company', 'like', '%' . $search . '%')
                    ->orWhere('details', 'like', '%' . $search . '%');
            });
        }

        return view('organizer.transport.tronsport', ['transports' => $transports->paginate(5)]);
    }
    public function show(Transport $transport)
    {
        return view('organizer.transport.tronsportDetail', compact('transport'));
    }
    public function create()
    {
        return view('organizer.transport.addTronsport');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:50',
            'company' => 'required|string|max:100',
            'details' => 'nullable|string|max:500',
            'capacity' => 'required|integer|min:1',
            'features' => 'nullable|',
            'features.*' => 'string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to continue.');
        }

        $validatedData['organizer_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('transports', 'public');
            $validatedData['image'] = $imagePath;
        }

        Transport::create($validatedData);

        return redirect()->route('transport.index')->with([
            'message' => 'Transport created successfully!',
            'type' => 'success',
        ]);
    }

    public function edit(Transport $transport)
    {
        $this->authorize('modify', $transport);

        return view('organizer.transport.editTronsport', compact('transport'));
    }

    public function update(Request $request, Transport $transport)
    {
        $this->authorize('modify', $transport);

        $validatedData = $request->validate([
            'type' => 'required|string|max:50',
            'company' => 'required|string|max:100',
            'details' => 'nullable|string|max:500',
            'capacity' => 'required|integer|min:1',
            'features' => 'nullable|',
            'features.*' => 'string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($transport->image) {
                Storage::disk('public')->delete($transport->image);
            }

            $imagePath = $request->file('image')->store('transports', 'public');
            $validatedData['image'] = $imagePath;
        }

        $transport->update($validatedData);

        return redirect()->route('transport.index')->with([
            'message' => 'Transport updated successfully!',
            'type' => 'success',
        ]);
    }

    public function destroy(Transport $transport)
    {
        $this->authorize('modify', $transport);

        if ($transport->image) {
            Storage::disk('public')->delete($transport->image);
        }

        $transport->delete();

        return redirect()->route('transport.index')->with([
            'message' => 'Transport deleted successfully!',
            'type' => 'success',
        ]);
    }
}