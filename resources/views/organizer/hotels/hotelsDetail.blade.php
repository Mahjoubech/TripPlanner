@extends('layouts.organizer')

@section('title', $hotel->name)

@push('styles')
<style>
    .gallery-image {
        transition: all 0.3s ease;
        height: 200px;
        object-fit: cover;
    }
    .gallery-image:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .star-rating {
        color: #FBBF24;
    }
    .hotel-cover {
        height: 400px;
        object-fit: cover;
        width: 100%;
    }
    @media (max-width: 768px) {
        .hotel-cover {
            height: 250px;
        }
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('hotels.index') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Back to Hotels
        </a>
    </div>

    <!-- Hotel Header with Cover Image -->
    <div class="relative mb-8 rounded-xl overflow-hidden shadow-lg">
        <img src="{{ $hotel->image ? asset('storage/' . $hotel->image) : '/api/placeholder/1200/400' }}" 
             alt="{{ $hotel->name }}" class="hotel-cover">
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $hotel->name }}</h1>
                    <div class="flex items-center mb-2">
                        <div class="star-rating flex mr-3">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $hotel->stars)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-white">{{ $hotel->stars }}-Star Hotel</span>
                    </div>
                    <p class="text-gray-200 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        {{ $hotel->address }}, {{ $hotel->city }}, {{ $hotel->country }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Description and Amenities -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Description -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">About This Hotel</h2>
                <p class="text-gray-600">{{ $hotel->description }}</p>
            </div>

            <!-- Amenities -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Amenities & Services</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach(explode(',', $hotel->amenities) as $amenity)
                        <div class="flex items-center bg-blue-50 text-blue-700 px-4 py-3 rounded-lg">
                            <i class="fas fa-check-circle mr-3"></i>
                            <span>{{ trim($amenity) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

        
        </div>

        <!-- Right Column: Location and Map -->
        <div class="space-y-8">
            <!-- Location Map -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Location</h2>
                <div id="map" class="h-64 w-full rounded-lg" 
                     data-address="{{ $hotel->address }}, {{ $hotel->city }}, {{ $hotel->country }}" 
                     data-name="{{ $hotel->name }}" 
                     data-stars="{{ $hotel->stars }}"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mapElement = document.getElementById('map');
        if (!mapElement) {
            return;
        }

        const map = L.map('map').setView([0, 0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
        }).addTo(map);

        const address = mapElement.dataset.address;
        const hotelName = mapElement.dataset.name;
        const stars = mapElement.dataset.stars;

        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const { lat, lon } = data[0];
                    map.setView([lat, lon], 15);
                    const marker = L.marker([lat, lon]).addTo(map);
                    marker.bindPopup(`<strong>${hotelName}</strong><br>${address}<br>${'⭐'.repeat(stars)}`).openPopup();
                }
            })
            .catch(error => console.error('Failed to load map:', error));
    });
</script>
@endpush