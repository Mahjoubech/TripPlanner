@extends('layouts.organizer')

@section('content')
@include('shared.toast')
<div class="bg-white rounded-lg shadow-sm p-5 mt-6">

    <!-- Header: Title and Add Hotel Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
        <h3 class="font-bold text-gray-700">Hotels</h3>
        <a href="{{route('hotels.create')}}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-1"></i> Add Hotel
        </a>
    </div>

    <!-- Search Section -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
        <form action="{{ route('hotels.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center gap-4">
            <!-- Search Box -->
            <div class="relative flex-grow">
                <input type="text" name="search" placeholder="Search hotels by name, city or country..." 
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
                <a href="{{ route('hotels.index') }}" class="px-4 py-2 border border-gray-300 text-gray-600 rounded-md hover:bg-gray-50 transition-colors">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Hotels Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-3 px-4 font-medium text-gray-600">Hotel</th>
                    <th class="py-3 px-4 font-medium text-gray-600">City</th>
                    <th class="py-3 px-4 font-medium text-gray-600">Country</th>
                    <th class="py-3 px-4 font-medium text-gray-600">Stars</th>
                    <th class="py-3 px-4 font-medium text-gray-600">Address</th>
                    <th class="py-3 px-4 font-medium text-gray-600 text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($hotels as $hotel)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <div class="flex items-center">
                            <img src="{{ $hotel->image ? asset('storage/' . $hotel->image) : '/api/placeholder/50/50' }}" 
                                 alt="{{ $hotel->name }}" class="h-10 w-10 rounded-full mr-3 object-cover">
                            <span>{{ $hotel->name }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-4">{{ $hotel->city }}</td>
                    <td class="py-3 px-4">{{ $hotel->country }}</td>
                    <td class="py-3 px-4">
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $hotel->stars)
                                    <i class="fas fa-star text-yellow-400"></i>
                                @else
                                    <i class="far fa-star text-yellow-400"></i>
                                @endif
                            @endfor
                        </div>
                    </td>
                    <td class="py-3 px-4">{{ $hotel->address }}</td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('hotels.show', $hotel->id) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('hotels.edit', $hotel->id) }}" class="text-gray-600 hover:text-gray-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" 
                                        onclick="return confirm('Are you sure you want to delete this hotel?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="border-b">
                    <td colspan="6" class="py-6 px-4 text-center text-gray-500">
                        No hotels found. <a href="{{ route('hotels.create') }}" class="text-blue-600 hover:underline">Add a new hotel</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="text-sm text-gray-500 mb-4 sm:mb-0">
            Showing {{ $hotels->firstItem() ?? 0 }} to {{ $hotels->lastItem() ?? 0 }} of {{ $hotels->total() }} hotels
        </div>
        <div>
            {{ $hotels->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<!-- Font Awesome (for icons) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
@endsection