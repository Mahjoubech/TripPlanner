<?php
$trips = [
    [
        'title' => 'Paris Weekend Getaway',
        'location' => 'Paris, France',
        'rating' => '4.8',
        'reviews' => '42',
        'description' => 'Experience the magic of Paris with our weekend getaway package.',
        'duration' => '3 days',
        'date' => 'May 15 - May 18, 2023',
        'type' => 'Family Tripe',
        'organizer' => 'Adventure Tours',
        'organizer_image' => 'https://ui-avatars.com/api/?name=Adventure+Tours',
        'price' => '599',
        'likes' => '24',
        'comments' => '2',
        'details_url' => '#',
        'image' => 'https://www.scenic.org/wp-content/uploads/2023/04/dino-reichmuth-A5rCN8626Ck-unsplash-scaled.jpeg',
    ],
    [
        'title' => 'Barcelona Adventure',
        'location' => 'Barcelona, Spain',
        'rating' => '4.7',
        'reviews' => '36',
        'description' => 'Discover the vibrant city of Barcelona with its unique architecture.',
        'duration' => '5 days',
        'date' => 'June 10 - June 15, 2023',
        'type' => 'Group Trip',
        'organizer' => 'Adventure Tours',
        'organizer_image' => 'https://ui-avatars.com/api/?name=Adventure+Tours',
        'price' => '799',
        'likes' => '18',
        'comments' => '1',
        'details_url' => '#',
        'image' => 'https://via.placeholder.com/300',
    ],
];
?>
@foreach ($trips as $trip)
<div class="rounded-lg border border-gray-200 bg-white shadow-sm overflow-hidden">
    <div class="flex flex-col md:flex-row">
        <div class="relative md:w-1/3">
            <img src="{{ $trip['image'] }}" alt="{{ $trip['title'] }}" class="h-48 md:h-full w-full object-cover">
            <button type="button" class="absolute top-2 right-2 h-8 w-8 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-gray-600 hover:text-red-500">
                <i class="far fa-heart h-4 w-4"></i>
            </button>
        </div>
        <div class="flex flex-col p-4 md:w-2/3">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="font-semibold text-lg">{{ $trip['title'] }}</h3>
                    <div class="flex items-center mt-1 text-sm text-gray-500">
                        <i class="fas fa-map-marker-alt h-3 w-3 mr-1"></i>
                        {{ $trip['location'] }}
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    <i class="fas fa-star h-4 w-4 text-yellow-400"></i>
                    <span class="font-medium">{{ $trip['rating'] }}</span>
                    <span class="text-xs text-gray-500">({{ $trip['reviews'] }})</span>
                </div>
            </div>
            <p class="mt-2 text-sm line-clamp-2">{{ $trip['description'] }}</p>
            <div class="mt-3 flex flex-wrap gap-2">
                <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">{{ $trip['duration'] }}</span>
                <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">{{ $trip['date'] }}</span>
                <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">{{ $trip['type'] }}</span>
            </div>
            <div class="mt-auto pt-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="h-6 w-6 rounded-full bg-gray-200 overflow-hidden">
                        <img src="{{ $trip['organizer_image'] }}" alt="{{ $trip['organizer'] }}" class="h-full w-full object-cover">
                    </div>
                    <span class="text-sm">{{ $trip['organizer'] }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="text-lg font-bold">${{ $trip['price'] }}</div>
                    <span class="text-xs text-gray-500">per person</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-between p-4 border-t">
        <div class="flex items-center gap-4">
            <button type="button" class="flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
                <i class="far fa-heart h-4 w-4"></i>
                <span>{{ $trip['likes'] }}</span>
            </button>
            <button type="button" class="flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
                <i class="far fa-comment h-4 w-4"></i>
                <span>{{ $trip['comments'] }}</span>
            </button>
            <button type="button" class="flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
                <i class="fas fa-share-alt h-4 w-4"></i>
            </button>
        </div>
        <a href="{{ $trip['details_url'] }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
            View Details
        </a>
    </div>
</div>
@endforeach