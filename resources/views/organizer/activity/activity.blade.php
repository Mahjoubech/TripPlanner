@extends('layouts.organizer')

@section('content')
@include('shared.toast')
<div class="bg-white rounded-lg shadow-sm p-5 mt-6">

    <!-- Header: Title and Add Activity Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
        <h3 class="font-bold text-gray-700">Activities</h3>
        <a href="{{ route('activity.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-1"></i> Add Activity
        </a>
    </div>

    <!-- Search Section -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
        <form action="{{ route('activity.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center gap-4">
            <!-- Search Box -->
            <div class="relative flex-grow">
                <input type="text" name="search" placeholder="Search activities by name, location, or difficulty..." 
                       value="{{ request('search') }}" 
                       class="pl-10 pr-4 py-2 border rounded-md w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
            
            <!-- Search Actions -->
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    Search
                </button>
                <a href="{{ route('activity.index') }}" class="px-4 py-2 border border-gray-300 text-gray-600 rounded-md hover:bg-gray-50 transition-colors">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Activities Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-3 px-4 font-medium text-gray-600">Activity</th>
                    <th class="py-3 px-4 font-medium text-gray-600">Location</th>
                    <th class="py-3 px-4 font-medium text-gray-600">Duration (hrs)</th>
                    <th class="py-3 px-4 font-medium text-gray-600">Difficulty</th>
                    <th class="py-3 px-4 font-medium text-gray-600">Price (DH)</th>
                    <th class="py-3 px-4 font-medium text-gray-600 text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <div class="flex items-center">
                            <img src="{{ $activity->image ? asset('storage/' . $activity->image) : '/api/placeholder/50/50' }}" 
                                 alt="{{ $activity->name }}" class="h-10 w-10 rounded-full mr-3 object-cover">
                            <span>{{ $activity->name }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-4">{{ $activity->location }}</td>
                    <td class="py-3 px-4">{{ $activity->duration }}</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 text-sm rounded {{ $activity->difficulty == 'easy' ? 'bg-green-100 text-green-600' : ($activity->difficulty == 'medium' ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }}">
                            {{ ucfirst($activity->difficulty) }}
                        </span>
                    </td>
                    <td class="py-3 px-4">{{ number_format($activity->price, 2) }} DH</td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('activity.show', $activity->id) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('activity.edit', $activity->id) }}" class="text-gray-600 hover:text-gray-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('activity.destroy', $activity->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" 
                                        onclick="return confirm('Are you sure you want to delete this activity?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="border-b">
                    <td colspan="6" class="py-6 px-4 text-center text-gray-500">
                        No activities found. <a href="{{ route('activity.create') }}" class="text-blue-600 hover:underline">Add a new activity</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="text-sm text-gray-500 mb-4 sm:mb-0">
            Showing {{ $activities->firstItem() ?? 0 }} to {{ $activities->lastItem() ?? 0 }} of {{ $activities->total() }} activities
        </div>
        <div>
            {{ $activities->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<!-- Font Awesome (for icons) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
@endsection