@extends('layouts.app')

@section('title', $trip->title)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    @include('client.partials.navbar')

    <div class="container mx-auto py-6 space-y-6 px-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('client.dashboard') }}" class="rounded-md p-2 text-gray-500 hover:bg-gray-100">
                <i class="fas fa-arrow-left h-5 w-5"></i>
            </a>
            <h1 class="text-2xl font-bold">{{ $trip->title }}</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="md:col-span-2 space-y-6">
                <div class="relative rounded-lg overflow-hidden h-[300px] md:h-[400px]">
                    <img src="{{ $trip->image ? asset('storage/' . $trip->image) : 'https://via.placeholder.com/800x400' }}" 
                         alt="{{ $trip->title }}" 
                         class="h-full w-full object-cover">
                    <div class="absolute bottom-4 right-4 flex gap-2">
                        <button type="button" id="like-button" class="h-10 w-10 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-gray-700 hover:text-red-500">
                            <i class="far fa-heart h-5 w-5"></i>
                        </button>
                        <button type="button" id="share-button" class="h-10 w-10 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-gray-700 hover:text-blue-500">
                            <i class="fas fa-share-alt h-5 w-5"></i>
                        </button>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-bold">{{ $trip->title }}</h2>
                                <div class="flex items-center mt-1 text-gray-500">
                                    <i class="fas fa-map-marker-alt h-4 w-4 mr-1"></i>
                                    {{ $trip->location }}
                                </div>
                            </div>
                            <div class="flex items-center gap-1 bg-blue-50 text-blue-700 px-2 py-1 rounded-md">
                                <i class="fas fa-star h-4 w-4 text-yellow-400"></i>
                                <span class="font-medium">{{ number_format($trip->reviews->avg('rating'), 1) }}</span>
                                <span class="text-xs text-gray-500">({{ $trip->reviews->count() }} reviews)</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-t">
                        <div class="flex">
                            <button type="button" class="trip-detail-tab w-1/4 py-3 text-center text-sm font-medium border-b-2 border-blue-600 text-blue-600" data-tab="overview">Overview</button>
                            <button type="button" class="trip-detail-tab w-1/4 py-3 text-center text-sm font-medium border-b-2 border-transparent hover:text-gray-700" data-tab="itinerary">Itinerary</button>
                            <button type="button" class="trip-detail-tab w-1/4 py-3 text-center text-sm font-medium border-b-2 border-transparent hover:text-gray-700" data-tab="accommodation">Accommodation</button>
                            <button type="button" class="trip-detail-tab w-1/4 py-3 text-center text-sm font-medium border-b-2 border-transparent hover:text-gray-700" data-tab="transport">Transport</button>
                        </div>
                    </div>

                    <div id="overview-content" class="trip-detail-content p-6 space-y-4">
                        <p>{{ $trip->description }}</p>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                            <div class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-calendar-alt h-5 w-5 text-blue-600 mb-2"></i>
                                <span class="text-sm font-medium">Duration</span>
                                <span class="text-sm">{{ $trip->duration }} days</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-users h-5 w-5 text-blue-600 mb-2"></i>
                                <span class="text-sm font-medium">Group Size</span>
                                <span class="text-sm">Max {{ $trip->max_participants }}</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-language h-5 w-5 text-blue-600 mb-2"></i>
                                <span class="text-sm font-medium">Language</span>
                                <span class="text-sm">English</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-dollar-sign h-5 w-5 text-blue-600 mb-2"></i>
                                <span class="text-sm font-medium">Price</span>
                                <span class="text-sm">${{ number_format($trip->price, 2) }}</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="font-medium text-lg mb-2">Highlights</h3>
                            <ul class="space-y-2">
                                @foreach($trip->activity as $activity)
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle h-5 w-5 text-blue-600 mt-0.5"></i>
                                    <span>{{ $activity->name }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div id="itinerary-content" class="trip-detail-content p-6 space-y-6 hidden">
                        <div class="space-y-6">
                            @foreach($trip->activity as $index => $activity)
                            <div class="space-y-2">
                                <h3 class="font-medium">Day {{ $index + 1 }}: {{ $activity->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $activity->description }}</p>
                                <hr class="my-4">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="accommodation-content" class="trip-detail-content p-6 space-y-4 hidden">
                        <div class="space-y-4">
                            @foreach($trip->hotels as $hotel)
                            <div class="flex items-start gap-4">
                                <div class="rounded-md overflow-hidden w-24 h-24 shrink-0">
                                    <img src="{{ $hotel->image ? asset('storage/' . $hotel->image) : 'https://via.placeholder.com/96' }}" 
                                         alt="{{ $hotel->name }}" 
                                         class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <h3 class="font-medium">{{ $hotel->name }}</h3>
                                    <div class="flex items-center gap-1 mt-1">
                                        @for($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star h-3 w-3 {{ $i < $hotel->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2">{{ $hotel->description }}</p>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach($hotel->amenities as $amenity)
                                        <span class="inline-flex items-center rounded-full border border-gray-200 px-2.5 py-0.5 text-xs font-medium">{{ $amenity }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="transport-content" class="trip-detail-content p-6 space-y-4 hidden">
                        <div class="space-y-4">
                            @foreach($trip->transports as $transport)
                            <div class="p-4 border rounded-lg">
                                <h3 class="font-medium">{{ $transport->type }}</h3>
                                <div class="flex items-center justify-between mt-2">
                                    <div class="text-sm">
                                        <p class="font-medium">{{ $transport->departure_time }}</p>
                                        <p class="text-gray-500">{{ $transport->departure_location }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="text-xs text-gray-500">{{ $transport->duration }}</div>
                                        <div class="w-24 h-px bg-gray-300 my-1 relative">
                                            <div class="absolute -top-1 left-1/2 transform -translate-x-1/2 w-2 h-2 rounded-full bg-blue-600"></div>
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $transport->type }}</div>
                                    </div>
                                    <div class="text-sm text-right">
                                        <p class="font-medium">{{ $transport->arrival_time }}</p>
                                        <p class="text-gray-500">{{ $transport->arrival_location }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                    <div class="p-6 border-b">
                        <h2 class="text-lg font-bold">Comments</h2>
                    </div>
                    <div class="p-6">
                        @auth
                            @if(auth()->user()->hasBookedTrip($trip->id))
                                <form action="{{ route('client.trip.comment', $trip->id) }}" method="POST" class="mb-6">
                                    @csrf
                                    <div class="space-y-4">
                                        <div>
                                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                                            <div class="flex items-center mt-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <button type="button" class="rating-star text-2xl text-gray-300 hover:text-yellow-400" data-rating="{{ $i }}">
                                                        <i class="fas fa-star"></i>
                                                    </button>
                                                @endfor
                                                <input type="hidden" name="rating" id="rating" value="0">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="comment" class="block text-sm font-medium text-gray-700">Your Comment</label>
                                            <textarea id="comment" name="comment" rows="3" 
                                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                      required></textarea>
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="submit" 
                                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Post Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="text-center py-4 text-gray-500">
                                    You need to book this trip to leave a comment.
                                </div>
                            @endif
                        @endauth

                        <div class="space-y-4">
                            @forelse($trip->reviews as $review)
                            <div class="flex gap-4">
                                <div class="h-10 w-10 rounded-full bg-gray-200 overflow-hidden shrink-0">
                                    <img src="{{ $review->user->avatar ? asset('storage/' . $review->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($review->user->name) }}" 
                                         alt="{{ $review->user->name }}" 
                                         class="h-full w-full object-cover">
                                </div>
                                <div class="space-y-1 flex-1">
                                    <div class="flex items-center gap-2">
                                        <span class="font-medium">{{ $review->user->name }}</span>
                                        <span class="text-xs text-gray-500">{{ $review->created_at->format('F d, Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star h-3 w-3 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </div>
                                    <p class="text-sm">{{ $review->comment }}</p>
                                    <div class="flex items-center gap-2">
                                        <button type="button" class="flex items-center gap-1 rounded-md px-2 py-1 text-xs text-gray-500 hover:bg-gray-100">
                                            <i class="far fa-heart h-4 w-4"></i>
                                            <span>{{ $review->likes_count }}</span>
                                        </button>
                                        @if(auth()->id() === $review->user_id)
                                        <form action="{{ route('client.trip.review.delete', $review->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center gap-1 rounded-md px-2 py-1 text-xs text-red-500 hover:bg-red-50">
                                                <i class="far fa-trash-alt h-4 w-4"></i>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4 text-gray-500">
                                No comments yet. Be the first to review this trip!
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                    <div class="p-6 border-b">
                        <h2 class="text-lg font-bold">Reserve Your Spot</h2>
                        <p class="text-sm text-gray-500">{{ $trip->max_participants - $trip->bookings->count() }} spots left out of {{ $trip->max_participants }}</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span>Price per person</span>
                                <span class="font-medium">${{ number_format($trip->price, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Departure date</span>
                                <span class="font-medium">{{ $trip->start_date->format('F d, Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Duration</span>
                                <span class="font-medium">{{ $trip->duration }} days</span>
                            </div>
                            <hr>
                            <div class="flex justify-between items-center font-medium">
                                <span>Total</span>
                                <span class="text-lg">${{ number_format($trip->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 border-t">
                        @if($trip->bookings->where('user_id', auth()->id())->count() > 0)
                            <button disabled class="block w-full rounded-md bg-gray-400 px-4 py-2 text-center font-medium text-white cursor-not-allowed">
                                Already Booked
                            </button>
                        @else
                            <a href="{{ route('client.trip.payment', $trip->id) }}" 
                               class="block w-full rounded-md bg-blue-600 px-4 py-2 text-center font-medium text-white hover:bg-blue-700">
                                Reserve Now
                            </a>
                        @endif
                    </div>
                </div>

                <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                    <div class="p-6 border-b">
                        <h2 class="text-lg font-bold">Organiser</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-full bg-gray-200 overflow-hidden">
                                <img src="{{ $trip->organizer->avatar ? asset('storage/' . $trip->organizer->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($trip->organizer->name) }}" 
                                     alt="{{ $trip->organizer->name }}" 
                                     class="h-full w-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-medium">{{ $trip->organizer->name }}</h3>
                                <div class="flex items-center gap-1 mt-1">
                                    <i class="fas fa-star h-3 w-3 text-yellow-400"></i>
                                    <span class="text-sm">{{ number_format($trip->organizer->average_rating, 1) }} ({{ $trip->organizer->reviews_count }} reviews)</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-4">
                            {{ $trip->organizer->bio ?? 'No bio available' }}
                        </p>
                        <a href="{{ route('client.organizer.profile', $trip->organizer->id) }}" 
                           class="mt-4 block w-full rounded-md border border-gray-300 px-4 py-2 text-center text-sm font-medium hover:bg-gray-50">
                            View Profile
                        </a>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                    <div class="p-6 border-b">
                        <h2 class="text-lg font-bold">Map</h2>
                    </div>
                    <div class="p-6">
                        <div class="aspect-video bg-gray-200 rounded-md flex items-center justify-center">
                            <i class="fas fa-map-marker-alt h-8 w-8 text-gray-400"></i>
                        </div>
                        <p class="text-sm text-gray-500 mt-2 text-center">{{ $trip->location }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Trip detail tabs
    const tabButtons = document.querySelectorAll('.trip-detail-tab');
    const tabContents = document.querySelectorAll('.trip-detail-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tab = button.getAttribute('data-tab');

            tabButtons.forEach(btn => {
                btn.classList.remove('border-blue-600', 'text-blue-600');
                btn.classList.add('border-transparent');
            });

            button.classList.add('border-blue-600', 'text-blue-600');
            button.classList.remove('border-transparent');

            tabContents.forEach(content => {
                content.classList.add('hidden');
            });

            const target = document.getElementById(`${tab}-content`);
            if (target) {
                target.classList.remove('hidden');
            }
        });
    });

    // Rating stars
    const ratingStars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('rating');

    ratingStars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = star.getAttribute('data-rating');
            ratingInput.value = rating;
            
            ratingStars.forEach(s => {
                const sRating = s.getAttribute('data-rating');
                s.classList.toggle('text-yellow-400', sRating <= rating);
                s.classList.toggle('text-gray-300', sRating > rating);
            });
        });

        star.addEventListener('mouseover', () => {
            const rating = star.getAttribute('data-rating');
            ratingStars.forEach(s => {
                const sRating = s.getAttribute('data-rating');
                s.classList.toggle('text-yellow-400', sRating <= rating);
                s.classList.toggle('text-gray-300', sRating > rating);
            });
        });

        star.addEventListener('mouseout', () => {
            const currentRating = ratingInput.value;
            ratingStars.forEach(s => {
                const sRating = s.getAttribute('data-rating');
                s.classList.toggle('text-yellow-400', sRating <= currentRating);
                s.classList.toggle('text-gray-300', sRating > currentRating);
            });
        });
    });

    // Like button
    const likeButton = document.getElementById('like-button');
    if (likeButton) {
        likeButton.addEventListener('click', () => {
            const icon = likeButton.querySelector('i');
            const isLiked = icon.classList.contains('far');
            icon.classList.toggle('far', !isLiked);
            icon.classList.toggle('fas', isLiked);
            icon.classList.toggle('text-red-500', isLiked);
            showToast(isLiked ? 'Added to favorites' : 'Removed from favorites', 
                      isLiked ? 'This trip has been added to your favorites' : 'This trip has been removed from your favorites');
        });
    }

    // Share button
    const shareButton = document.getElementById('share-button');
    if (shareButton) {
        shareButton.addEventListener('click', () => {
            navigator.clipboard.writeText(window.location.href)
                .then(() => {
                    showToast('Link copied', 'Trip link has been copied to clipboard');
                });
        });
    }

    // Toast notification
    function showToast(title, message) {
        const toast = document.createElement('div');
        toast.className = 'bg-white rounded-lg border border-gray-200 shadow-md p-4 mb-4 max-w-md animate-fade-in-down';

        toast.innerHTML = `
            <div class="flex items-start">
                <div class="flex-1">
                    <h3 class="font-medium">${title}</h3>
                    <p class="text-sm text-gray-500">${message}</p>
                </div>
                <button type="button" class="ml-4 text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        const container = document.getElementById('toast-container');
        if (container) {
            container.appendChild(toast);

            toast.querySelector('button').addEventListener('click', () => {
                toast.remove();
            });

            setTimeout(() => {
                toast.remove();
            }, 5000);
        }
    }
});
</script>
@endpush
