@extends('layouts.organizer')

@section('content')
@include('shared.toast')
<div class="bg-white rounded-lg shadow-sm p-5 mt-6">

    <!-- Header: Title and Add Trip Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
        <h3 class="font-bold text-gray-700">Trips</h3>
        <a href="{{ route('trips.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-1"></i> Add Trip
        </a>
    </div>

    <!-- Filter Section -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
        <form action="{{ route('trips.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center gap-4">
            <!-- Search Box -->
            <div class="relative flex-grow">
                <input type="text" name="search" placeholder="Search trips by title or location..." 
                       value="{{ request('search') }}" 
                       class="pl-10 pr-4 py-2 border rounded-md w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <select name="status" class="py-2 px-4 border rounded-md">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="finished" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="posted" {{ request('status') == 'finished' ? 'selected' : '' }}>Finished</option>
                </select>
            </div>

            <!-- Filter Actions -->
            <div class="flex gap-2">
                <button type="submit"  class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    Filter
                </button>
                <a href="{{ route('trips.index') }}" class="px-4 py-2 border border-gray-300 text-gray-600 rounded-md hover:bg-gray-50 transition-colors">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Trips Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-3 px-4 font-medium text-gray-600">Title</th>
                    <th class="py-3 px-4 font-medium text-gray-600">Location</th>
                    <th class="py-3 px-4 font-medium text-gray-600">Duration (days)</th>
                    <th class="py-3 px-4 font-medium text-gray-600">Price (DH)</th>
                    <th class="py-3 px-4 font-medium text-gray-600">Status</th>
                    <th class="py-3 px-4 font-medium text-gray-600 text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trips as $trip)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $trip->title }}</td>
                    <td class="py-3 px-4">{{ $trip->location }}</td>
                    <td class="py-3 px-4">{{ $trip->duration }}</td>
                    <td class="py-3 px-4">{{ number_format($trip->price, 2) }} DH</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 rounded-md text-white text-xs 
                            {{ $trip->status == 'pending' ? 'bg-yellow-500' : ($trip->status == 'finished' ? 'bg-green-500' : 'bg-blue-500') }}">
                            {{ ucfirst($trip->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('trips.show', $trip->id) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('trips.edit', $trip->id) }}" class="text-gray-600 hover:text-gray-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" 
                                        onclick="return confirm('Are you sure you want to delete this trip?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="border-b">
                    <td colspan="6" class="py-6 px-4 text-center text-gray-500">
                        No trips found. <a href="{{ route('trips.create') }}" class="text-blue-600 hover:underline">Add a new trip</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="text-sm text-gray-500 mb-4 sm:mb-0">
            Showing {{ $trips->firstItem() ?? 0 }} to {{ $trips->lastItem() ?? 0 }} of {{ $trips->total() }} trips
        </div>
        <div>
            {{ $trips->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<!-- Font Awesome (for icons) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
@endsection