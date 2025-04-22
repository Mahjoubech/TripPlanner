@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Discover Trips</h1>
            <p class="mt-1 text-sm text-gray-500">Find and book your next adventure</p>
        </div>

        <!-- Search and Filter -->
        @include('client.partials.trip_search')

        <!-- Trips Grid -->
        <div id="tripContainer" class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($trips as $trip)
                @include('client.partials.trip_card', ['trip' => $trip])
            @endforeach
        </div>

        <!-- Loading State -->
        <div id="loadingState" class="hidden">
            <div class="flex justify-center items-center h-32">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
            </div>
        </div>

        <!-- No Results State -->
        <div id="noResults" class="hidden text-center py-12">
            <i class="fas fa-search text-gray-400 text-4xl mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900">No trips found</h3>
            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize search functionality
    const searchInput = document.getElementById('tripSearch');
    const tripContainer = document.getElementById('tripContainer');
    const loadingState = document.getElementById('loadingState');
    const noResults = document.getElementById('noResults');

    // Show/hide loading state
    function toggleLoading(show) {
        loadingState.classList.toggle('hidden', !show);
        tripContainer.classList.toggle('hidden', show);
    }

    // Show/hide no results state
    function toggleNoResults(show) {
        noResults.classList.toggle('hidden', !show);
        tripContainer.classList.toggle('hidden', show);
    }

    // Initial state
    toggleLoading(false);
    toggleNoResults(false);
});
</script>
@endpush 