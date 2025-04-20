@extends('layouts.organizer')

@section('title', 'Trip Details - ' . $trip->title)

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="container mx-auto py-6 space-y-6 px-4">
        <!-- Header with breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-gray-200">
            <div class="flex items-center gap-2">
                <a href="{{ route('trips.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li>
                            <a href="{{ route('trips.index') }}" class="text-gray-500 hover:text-blue-600">Trips</a>
                        </li>
                        <li class="text-gray-400">/</li>
                        <li class="text-gray-900 font-medium truncate max-w-xs">{{ $trip->title }}</li>
                    </ol>
                </nav>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('trips.edit', $trip->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    <i class="fas fa-edit mr-1"></i> Edit Trip
                </a>
                <form action="{{ route('trips.destroy', $trip->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                        <i class="fas fa-trash mr-1"></i> Delete
                    </button>
                </form>
               
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Trip Header and Image -->
                <div class="rounded-xl overflow-hidden bg-white shadow-sm border border-gray-200">
                    <div class="relative h-[400px]">
                        <img src="{{ $trip->image ? asset('storage/' . $trip->image) : 'https://via.placeholder.com/800x400?text=No+Image' }}" 
                             alt="{{ $trip->title }}" class="h-full w-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                            <div class="flex items-center gap-2 text-white mb-2">
                                <span class="bg-{{ $trip->status === 'pending' ? 'yellow' : ($trip->status === 'posted' ? 'green' : 'gray') }}-500 text-white px-3 py-1 rounded-full text-xs font-medium uppercase">
                                    {{ $trip->status }}
                                </span>
                                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                                    ${{ number_format($trip->price, 2) }}
                                </span>
                            </div>
                            <h1 class="text-3xl font-bold text-white">{{ $trip->title }}</h1>
                            <div class="flex items-center gap-3 mt-2 text-white">
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    <span>{{ $trip->location }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar mr-1"></i>
                                    <span>{{ \Carbon\Carbon::parse($trip->start_date)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($trip->end_date)->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trip Overview -->
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-4 text-blue-600">Overview</h2>
                        <div class="prose max-w-none text-gray-600">
                            {{ $trip->description }}
                        </div>
                    </div>
                </div>

                <!-- Trip Hotels, Activities and Transport Tabs -->
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="border-b border-gray-200">
                        <div class="flex overflow-x-auto">
                            <button class="tab-button active px-6 py-3 text-blue-600 border-b-2 border-blue-600 font-medium" 
                                    data-tab="hotels">
                                <i class="fas fa-hotel mr-2"></i> Hotels
                            </button>
                            <button class="tab-button px-6 py-3 text-gray-500 hover:text-blue-600 font-medium" 
                                    data-tab="activities">
                                <i class="fas fa-hiking mr-2"></i> Activities
                            </button>
                            <button class="tab-button px-6 py-3 text-gray-500 hover:text-blue-600 font-medium" 
                                    data-tab="transport">
                                <i class="fas fa-bus mr-2"></i> Transport
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <!-- Hotels Tab -->
                        <div id="hotels-tab" class="tab-content">
                            @if($trip->hotels->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($trip->hotels as $hotel)
                                    <div class="flex border rounded-lg overflow-hidden">
                                        <div class="w-1/3 bg-gray-200">
                                            @if($hotel->image)
                                                <img src="{{ asset('storage/' . $hotel->image) }}" alt="{{ $hotel->name }}" class="h-full w-full object-cover">
                                            @else
                                                <div class="h-full w-full flex items-center justify-center bg-gray-200">
                                                    <i class="fas fa-hotel text-3xl text-gray-400"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="w-2/3 p-4">
                                            <h3 class="font-bold text-lg">{{ $hotel->name }}</h3>
                                            <div class="flex items-center text-yellow-500 my-1">
                                                @for($i = 0; $i < $hotel->stars; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            </div>
                                            <p class="text-sm text-gray-600 mb-2">{{ $hotel->location }}</p>
                                            <p class="text-sm text-gray-500">{{ Str::limit($hotel->description, 80) }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <i class="fas fa-hotel text-5xl mb-3 opacity-30"></i>
                                    <p>No hotels added to this trip yet.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Activities Tab -->
                        <div id="activities-tab" class="tab-content hidden">
                            @if($trip->activity->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($trip->activity as $activity)
                                    <div class="flex border rounded-lg overflow-hidden">
                                        <div class="w-1/3 bg-gray-200">
                                            @if($activity->image)
                                                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->name }}" class="h-full w-full object-cover">
                                            @else
                                                <div class="h-full w-full flex items-center justify-center bg-gray-200">
                                                    <i class="fas fa-hiking text-3xl text-gray-400"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="w-2/3 p-4">
                                            <h3 class="font-bold text-lg">{{ $activity->name }}</h3>
                                            <p class="text-sm text-gray-600 mb-2">
                                                <i class="fas fa-clock mr-1"></i> {{ $activity->duration }} hours
                                            </p>
                                            <p class="text-sm text-gray-500">{{ Str::limit($activity->description, 80) }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <i class="fas fa-hiking text-5xl mb-3 opacity-30"></i>
                                    <p>No activities added to this trip yet.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Transport Tab -->
                        <div id="transport-tab" class="tab-content hidden">
                            @if($trip->transports->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($trip->transports as $transport)
                                    <div class="flex border rounded-lg overflow-hidden">
                                        <div class="w-1/3 bg-gray-200">
                                            @if($transport->image)
                                                <img src="{{ asset('storage/' . $transport->image) }}" alt="{{ $transport->name }}" class="h-full w-full object-cover">
                                            @else
                                                <div class="h-full w-full flex items-center justify-center bg-gray-200">
                                                    <i class="fas fa-bus text-3xl text-gray-400"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="w-2/3 p-4">
                                            <h3 class="font-bold text-lg">{{ $transport->name }}</h3>
                                            <p class="text-sm text-gray-600 mb-2">
                                                <i class="fas fa-users mr-1"></i> {{ $transport->capacity }} people
                                            </p>
                                            <p class="text-sm text-gray-500">{{ Str::limit($transport->description, 80) }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <i class="fas fa-bus text-5xl mb-3 opacity-30"></i>
                                    <p>No transport added to this trip yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Location Map -->
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-4 text-blue-600">Location</h2>
                        <div id="map" class="h-72 w-full rounded-lg border border-gray-300"></div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-4 text-blue-600">Comments</h2>
                        <form action="" method="POST" class="mb-6">
                            @csrf
                            <div class="mb-4">
                                <textarea name="comment" rows="3" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Add a comment or note about this trip..."></textarea>
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                Add Comment
                            </button>
                        </form>
                        
                        <div class="space-y-4">
                            @if(isset($trip->comments) && $trip->comments->count() > 0)
                                @foreach($trip->comments as $comment)
                                <div class="border-b border-gray-200 pb-4">
                                    <div class="flex items-start gap-3">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-center mb-1">
                                                <p class="font-medium">{{ $comment->user->name ?? 'Anonymous' }}</p>
                                                <p class="text-xs text-gray-500">{{ isset($comment->created_at) ? $comment->created_at->diffForHumans() : 'N/A' }}</p>
                                            </div>
                                            <p class="text-gray-600">{{ $comment->content ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <i class="far fa-comment-dots text-5xl mb-3 opacity-30"></i>
                                    <p>No comments yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Trip Status & Actions -->
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-bold text-blue-600">Trip Status</h2>
                            <span class="px-3 py-1 rounded-full text-xs font-medium uppercase bg-{{ $trip->status === 'pending' ? 'yellow' : ($trip->status === 'posted' ? 'green' : 'gray') }}-100 text-{{ $trip->status === 'pending' ? 'yellow' : ($trip->status === 'posted' ? 'green' : 'gray') }}-800">
                                {{ $trip->status }}
                            </span>
                        </div>
                        <div class="space-y-4">
                            <a href="#" class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded-md hover:bg-blue-700 transition-colors">
                                <i class="fas fa-user-plus mr-1"></i> Manage Participants
                            </a>
                            <a href="#" class="block w-full px-4 py-2 bg-green-600 text-white text-center rounded-md hover:bg-green-700 transition-colors">
                                <i class="fas fa-chart-line mr-1"></i> View Trip Statistics
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Trip Details -->
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="p-6">
                        <h2 class="text-lg font-bold text-blue-600 mb-4">Trip Details</h2>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Duration</p>
                                    <p class="font-medium">{{ $trip->duration }} days</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Price</p>
                                    <p class="font-medium">${{ number_format($trip->price, 2) }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Max Participants</p>
                                    <p class="font-medium">{{ $trip->max_participants }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Created</p>
                                    <p class="font-medium">{{ $trip->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Like Counter -->
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-bold text-blue-600">Engagement</h2>
                            <div class="flex items-center gap-1">
                                <button id="like-button" class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 hover:bg-red-100 transition-colors">
                                    <i class="far fa-heart text-gray-600 hover:text-red-600"></i>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-500 text-sm">Likes</span>
                                <span id="like-count" class="font-bold text-xl">{{ $trip->likes_count ?? 0 }}</span>
                            </div>
                            <div class="flex flex-col items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-500 text-sm">Views</span>
                                <span class="font-bold text-xl">{{ $trip->views_count ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Organizer Info -->
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="p-6">
                        <h2 class="text-lg font-bold text-blue-600 mb-4">Organizer</h2>
                        <div class="flex items-center gap-3">
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="font-medium">{{ $trip->organizer->name ?? 'Unknown' }}</p>
                                <p class="text-sm text-gray-500">{{ $trip->organizer->email ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-xl font-bold mb-4">Delete Trip</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this trip? This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                Cancel
            </button>
            <form action="{{ route('trips.destroy', $trip->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // === Initialize Map ===
    const mapElement = document.getElementById('map');
    @php
        $lat = $trip->latitude ?? 0;
        $lng = $trip->longitude ?? 0;
        $hasCoords = is_numeric($lat) && is_numeric($lng) && ($lat != 0 || $lng != 0);
    @endphp
    
    if (mapElement) {
        if (@json($hasCoords)) {
            try {
                const map = L.map('map').setView([{{ $lat }}, {{ $lng }}], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                L.marker([{{ $lat }}, {{ $lng }}]).addTo(map)
                    .bindPopup('{{ $trip->location }}')
                    .openPopup();
            } catch (e) {
                console.error("Error initializing map:", e);
                mapElement.innerHTML = '<div class="text-center text-gray-400 py-12">Error loading map. Please try again later.</div>';
            }
        } else {
            mapElement.innerHTML = '<div class="text-center text-gray-400 py-12">No map location available for this trip.</div>';
        }
    }

    // === Tab Switching Logic ===
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            
            // Remove active class from all buttons and add to clicked button
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'text-blue-600', 'border-b-2', 'border-blue-600');
                btn.classList.add('text-gray-500');
            });
            button.classList.add('active', 'text-blue-600', 'border-b-2', 'border-blue-600');
            button.classList.remove('text-gray-500');
            
            // Hide all tab contents and show the selected one
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            document.getElementById(`${tabId}-tab`).classList.remove('hidden');
        });
    });

    // === Delete Modal Functions ===
    window.confirmDelete = function() {
        document.getElementById('delete-modal').classList.remove('hidden');
    }
    
    window.closeDeleteModal = function() {
        document.getElementById('delete-modal').classList.add('hidden');
    }
});
</script>
@endsection