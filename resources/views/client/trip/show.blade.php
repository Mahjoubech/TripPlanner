@extends('layouts.app')

@section('title', 'Trip Details')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar (same as dashboard) -->
    <header class="sticky top-0 z-50 w-full border-b bg-white/95 backdrop-blur">
        <div class="container mx-auto flex h-16 items-center justify-between px-4">
            <div class="flex items-center gap-4">
                <button type="button" class="md:hidden rounded-md p-2 text-gray-500 hover:bg-gray-100" id="mobile-menu-button">
                    <i class="fas fa-bars h-5 w-5"></i>
                </button>

                <a href="{{ route('client.dashboard') }}" class="flex items-center gap-2 font-bold text-lg">
                    <span class="text-blue-600">Trip</span>Planner
                </a>

                <div class="hidden md:flex relative max-w-sm">
                    <i class="fas fa-search absolute left-2 top-2.5 h-4 w-4 text-gray-400"></i>
                    <input type="text" placeholder="Search trips..." class="pl-8 w-[300px] rounded-md border border-gray-300 py-2 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('client.messages') }}" class="relative p-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-comment h-5 w-5"></i>
                    <span class="absolute -top-1 -right-1 h-5 w-5 rounded-full bg-blue-600 text-xs text-white flex items-center justify-center">3</span>
                </a>

                <a href="{{ route('client.notifications') }}" class="relative p-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-bell h-5 w-5"></i>
                    <span class="absolute -top-1 -right-1 h-5 w-5 rounded-full bg-blue-600 text-xs text-white flex items-center justify-center">5</span>
                </a>

                <a href="{{ route('client.profile') }}" class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name=John+Doe" alt="User" class="h-full w-full object-cover">
                </a>
            </div>
        </div>
    </header>

    <div class="container mx-auto py-6 space-y-6 px-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('client.dashboard') }}" class="rounded-md p-2 text-gray-500 hover:bg-gray-100">
                <i class="fas fa-arrow-left h-5 w-5"></i>
            </a>
            <h1 class="text-2xl font-bold">Paris Weekend Getaway</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="md:col-span-2 space-y-6">
                <div class="relative rounded-lg overflow-hidden h-[300px] md:h-[400px]">
                    <img src="https://via.placeholder.com/800x400" alt="Paris Weekend Getaway" class="h-full w-full object-cover">
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
                                <h2 class="text-xl font-bold">Paris Weekend Getaway</h2>
                                <div class="flex items-center mt-1 text-gray-500">
                                    <i class="fas fa-map-marker-alt h-4 w-4 mr-1"></i>
                                    Paris, France
                                </div>
                            </div>
                            <div class="flex items-center gap-1 bg-blue-50 text-blue-700 px-2 py-1 rounded-md">
                                <i class="fas fa-star h-4 w-4 text-yellow-400"></i>
                                <span class="font-medium">4.8</span>
                                <span class="text-xs text-gray-500">(42 reviews)</span>
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
                        <p>Experience the magic of Paris with our weekend getaway package. Visit iconic landmarks like the Eiffel Tower, Louvre Museum, and Notre-Dame Cathedral. Enjoy authentic French cuisine and immerse yourself in the romantic atmosphere of the City of Light.</p>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                            <div class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-calendar-alt h-5 w-5 text-blue-600 mb-2"></i>
                                <span class="text-sm font-medium">Duration</span>
                                <span class="text-sm">3 days</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-users h-5 w-5 text-blue-600 mb-2"></i>
                                <span class="text-sm font-medium">Group Size</span>
                                <span class="text-sm">Max 20</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-language h-5 w-5 text-blue-600 mb-2"></i>
                                <span class="text-sm font-medium">Language</span>
                                <span class="text-sm">English</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-dollar-sign h-5 w-5 text-blue-600 mb-2"></i>
                                <span class="text-sm font-medium">Price</span>
                                <span class="text-sm">$599</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="font-medium text-lg mb-2">Highlights</h3>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle h-5 w-5 text-blue-600 mt-0.5"></i>
                                    <span>Skip-the-line access to the Eiffel Tower</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle h-5 w-5 text-blue-600 mt-0.5"></i>
                                    <span>Guided tour of the Louvre Museum</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle h-5 w-5 text-blue-600 mt-0.5"></i>
                                    <span>Seine River cruise at sunset</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle h-5 w-5 text-blue-600 mt-0.5"></i>
                                    <span>Walking tour of Montmartre</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle h-5 w-5 text-blue-600 mt-0.5"></i>
                                    <span>Authentic French cuisine experience</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div id="itinerary-content" class="trip-detail-content p-6 space-y-6 hidden">
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <h3 class="font-medium">Day 1: Arrival and Welcome Dinner</h3>
                                <p class="text-sm text-gray-600">Arrive in Paris and check into your hotel. Meet your fellow travelers and guide for a welcome dinner at a local restaurant.</p>
                                <hr class="my-4">
                            </div>
                            <div class="space-y-2">
                                <h3 class="font-medium">Day 2: Iconic Landmarks Tour</h3>
                                <p class="text-sm text-gray-600">Visit the Eiffel Tower with skip-the-line access, explore the Louvre Museum, and enjoy a Seine River cruise.</p>
                                <hr class="my-4">
                            </div>
                            <div class="space-y-2">
                                <h3 class="font-medium">Day 3: Free Day and Departure</h3>
                                <p class="text-sm text-gray-600">Spend the morning exploring Paris at your own pace. Optional visit to Montmartre or shopping on Champs-Élysées before departure.</p>
                            </div>
                        </div>
                    </div>

                    <div id="accommodation-content" class="trip-detail-content p-6 space-y-4 hidden">
                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div class="rounded-md overflow-hidden w-24 h-24 shrink-0">
                                    <img src="https://via.placeholder.com/96" alt="Hotel" class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <h3 class="font-medium">Hôtel Le Marais</h3>
                                    <div class="flex items-center gap-1 mt-1">
                                        <i class="fas fa-star h-3 w-3 text-yellow-400"></i>
                                        <i class="fas fa-star h-3 w-3 text-yellow-400"></i>
                                        <i class="fas fa-star h-3 w-3 text-yellow-400"></i>
                                        <i class="fas fa-star h-3 w-3 text-yellow-400"></i>
                                        <i class="fas fa-star h-3 w-3 text-yellow-400"></i>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2">
                                        Charming boutique hotel in the heart of Le Marais district, featuring comfortable rooms with modern amenities.
                                    </p>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        <span class="inline-flex items-center rounded-full border border-gray-200 px-2.5 py-0.5 text-xs font-medium">WiFi</span>
                                        <span class="inline-flex items-center rounded-full border border-gray-200 px-2.5 py-0.5 text-xs font-medium">Breakfast</span>
                                        <span class="inline-flex items-center rounded-full border border-gray-200 px-2.5 py-0.5 text-xs font-medium">Pool</span>
                                        <span class="inline-flex items-center rounded-full border border-gray-200 px-2.5 py-0.5 text-xs font-medium">Spa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="transport-content" class="trip-detail-content p-6 space-y-4 hidden">
                        <div class="space-y-4">
                            <div class="p-4 border rounded-lg">
                                <h3 class="font-medium">Outbound</h3>
                                <div class="flex items-center justify-between mt-2">
                                    <div class="text-sm">
                                        <p class="font-medium">10:00 AM</p>
                                        <p class="text-gray-500">New York (JFK)</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="text-xs text-gray-500">7h 30m</div>
                                        <div class="w-24 h-px bg-gray-300 my-1 relative">
                                            <div class="absolute -top-1 left-1/2 transform -translate-x-1/2 w-2 h-2 rounded-full bg-blue-600"></div>
                                        </div>
                                        <div class="text-xs text-gray-500">Direct</div>
                                    </div>
                                    <div class="text-sm text-right">
                                        <p class="font-medium">5:30 PM</p>
                                        <p class="text-gray-500">Paris (CDG)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 border rounded-lg">
                                <h3 class="font-medium">Return</h3>
                                <div class="flex items-center justify-between mt-2">
                                    <div class="text-sm">
                                        <p class="font-medium">2:15 PM</p>
                                        <p class="text-gray-500">Paris (CDG)</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="text-xs text-gray-500">8h 15m</div>
                                        <div class="w-24 h-px bg-gray-300 my-1 relative">
                                            <div class="absolute -top-1 left-1/2 transform -translate-x-1/2 w-2 h-2 rounded-full bg-blue-600"></div>
                                        </div>
                                        <div class="text-xs text-gray-500">Direct</div>
                                    </div>
                                    <div class="text-sm text-right">
                                        <p class="font-medium">10:30 PM</p>
                                        <p class="text-gray-500">New York (JFK)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 border rounded-lg">
                                <h3 class="font-medium">Local Transport</h3>
                                <p class="text-sm text-gray-600 mt-2">
                                    Private coach transportation between the airport, hotel, and all activities is included in
                                    your package.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                    <div class="p-6 border-b">
                        <h2 class="text-lg font-bold">Comments</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex gap-4">
                                <div class="h-10 w-10 rounded-full bg-gray-200 overflow-hidden shrink-0">
                                    <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&size=40" alt="Sarah Johnson" class="h-full w-full object-cover">
                                </div>
                                <div class="space-y-1 flex-1">
                                    <div class="flex items-center gap-2">
                                        <span class="font-medium">Sarah Johnson</span>
                                        <span class="text-xs text-gray-500">April 10, 2023</span>
                                    </div>
                                    <p class="text-sm">This trip was absolutely amazing! The Eiffel Tower at night was breathtaking.</p>
                                    <div class="flex items-center gap-2">
                                        <button type="button" class="flex items-center gap-1 rounded-md px-2 py-1 text-xs text-gray-500 hover:bg-gray-100">
                                            <i class="far fa-heart h-4 w-4"></i>
                                            <span>5</span>
                                        </button>
                                        <button type="button" class="flex items-center gap-1 rounded-md px-2 py-1 text-xs text-gray-500 hover:bg-gray-100">
                                            <i class="far fa-comment h-4 w-4"></i>
                                            <span>Reply</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex gap-4">
                                <div class="h-10 w-10 rounded-full bg-gray-200 overflow-hidden shrink-0">
                                    <img src="https://ui-avatars.com/api/?name=Michael+Chen&size=40" alt="Michael Chen" class="h-full w-full object-cover">
                                </div>
                                <div class="space-y-1 flex-1">
                                    <div class="flex items-center gap-2">
                                        <span class="font-medium">Michael Chen</span>
                                        <span class="text-xs text-gray-500">March 28, 2023</span>
                                    </div>
                                    <p class="text-sm">Great organization and wonderful guide. Highly recommend!</p>
                                    <div class="flex items-center gap-2">
                                        <button type="button" class="flex items-center gap-1 rounded-md px-2 py-1 text-xs text-gray-500 hover:bg-gray-100">
                                            <i class="far fa-heart h-4 w-4"></i>
                                            <span>3</span>
                                        </button>
                                        <button type="button" class="flex items-center gap-1 rounded-md px-2 py-1 text-xs text-gray-500 hover:bg-gray-100">
                                            <i class="far fa-comment h-4 w-4"></i>
                                            <span>Reply</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 border-t">
                        <button type="button" class="w-full rounded-md border border-gray-300 px-4 py-2 text-sm font-medium hover:bg-gray-50">
                            Load More Comments
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                    <div class="p-6 border-b">
                        <h2 class="text-lg font-bold">Reserve Your Spot</h2>
                        <p class="text-sm text-gray-500">8 spots left out of 20</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span>Price per person</span>
                                <span class="font-medium">$599</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Departure date</span>
                                <span class="font-medium">May 15, 2023</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Duration</span>
                                <span class="font-medium">3 days</span>
                            </div>
                            <hr>
                            <div class="flex justify-between items-center font-medium">
                                <span>Total</span>
                                <span class="text-lg">$599</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 border-t">
                        <a href="{{ route('client.trip.payment', 'trip1') }}" class="block w-full rounded-md bg-blue-600 px-4 py-2 text-center font-medium text-white hover:bg-blue-700">
                            Reserve Now
                        </a>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                    <div class="p-6 border-b">
                        <h2 class="text-lg font-bold">Organiser</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=Adventure+Tours&size=48" alt="Adventure Tours" class="h-full w-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-medium">Adventure Tours</h3>
                                <div class="flex items-center gap-1 mt-1">
                                    <i class="fas fa-star h-3 w-3 text-yellow-400"></i>
                                    <span class="text-sm">4.9 (120 reviews)</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-4">
                            Professional tour operator with over 10 years of experience organizing trips worldwide.
                        </p>
                        <button type="button" class="mt-4 w-full rounded-md border border-gray-300 px-4 py-2 text-sm font-medium hover:bg-gray-50">
                            View Profile
                        </button>
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
                        <p class="text-sm text-gray-500 mt-2 text-center">Paris, France</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {

    // === Trip detail tabs ===
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

    // === Like button toggle ===
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

    // === Share button click ===
    const shareButton = document.getElementById('share-button');
    if (shareButton) {
        shareButton.addEventListener('click', () => {
            navigator.clipboard.writeText(window.location.href)
                .then(() => {
                    showToast('Link copied', 'Trip link has been copied to clipboard');
                });
        });
    }

    // === Mobile menu toggle ===
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // === Toast display ===
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

            // Remove on close
            toast.querySelector('button').addEventListener('click', () => {
                toast.remove();
            });

            // Auto-remove after 5 seconds
            setTimeout(() => {
                toast.remove();
            }, 5000);
        }
    }
});
</script>
@endsection
