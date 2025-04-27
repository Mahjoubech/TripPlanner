@extends('layouts.app')

@section('title', $trip->title)

@section('content')
    @include('shared.toast')

    <div class="min-h-screen bg-gray-100">
        @include('client.partials.navbar')

        <!-- Hero Section -->
        <div class="relative h-[400px] md:h-[500px] w-full overflow-hidden">
            @if ($trip->image)
                <img src="{{ asset('storage/' . $trip->image) }}" alt="{{ $trip->title }}" class="h-full w-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10 text-white">
                <div class="container mx-auto">
                    <a href="{{ route('client.dashboard') }}"
                        class="inline-flex items-center gap-2 text-white/80 hover:text-white mb-4 transition">
                        <i class="fas fa-arrow-left h-4 w-4"></i>
                        <span>Back to trips</span>
                    </a>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $trip->title }}</h1>
                    <div class="flex items-center gap-2 text-white/80">
                        <i class="fas fa-map-marker-alt h-4 w-4"></i>
                        <span>{{ $trip->location }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Trip Details Card -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                        <!-- Trip Stats -->
                        <div class="flex flex-wrap justify-between border-b">
                            <div class="flex-1 p-4 md:p-6 flex items-center gap-3 border-r">
                                <div class="bg-blue-50 rounded-full p-2">
                                    <i class="fas fa-calendar-alt text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Duration</p>
                                    <p class="font-semibold">{{ $trip->duration }} days</p>
                                </div>
                            </div>
                            <div class="flex-1 p-4 md:p-6 flex items-center gap-3 border-r">
                                <div class="bg-green-50 rounded-full p-2">
                                    <i class="fas fa-users text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Group Size</p>
                                    <p class="font-semibold">Max {{ $trip->max_participants }}</p>
                                </div>
                            </div>
                            <div class="flex-1 p-4 md:p-6 flex items-center gap-3">
                                <div class="bg-indigo-50 rounded-full p-2">
                                    <i class="fas fa-dollar-sign text-indigo-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Price</p>
                                    <p class="font-semibold">${{ number_format($trip->price, 2) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tabs -->
                        <div class="border-b">
                            <div class="flex">
                                <button type="button"
                                    class="trip-detail-tab w-1/3 py-4 text-center text-sm font-medium border-b-2 border-blue-600 text-blue-600"
                                    data-tab="overview">Overview</button>
                                <button type="button"
                                    class="trip-detail-tab w-1/3 py-4 text-center text-sm font-medium border-b-2 border-transparent hover:text-gray-700"
                                    data-tab="accommodation">Accommodation</button>
                                <button type="button"
                                    class="trip-detail-tab w-1/3 py-4 text-center text-sm font-medium border-b-2 border-transparent hover:text-gray-700"
                                    data-tab="transport">Transport</button>
                            </div>
                        </div>

                        <!-- Tab Contents -->
                        <div id="overview-content" class="trip-detail-content p-6 space-y-6">
                            <div class="prose max-w-none">
                                <p>{{ $trip->description }}</p>
                            </div>

                            @if ($trip->activity && $trip->activity->count())
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold mb-4">Trip Highlights</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        @foreach ($trip->activity as $activity)
                                            <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                                <div class="bg-blue-100 rounded-full p-2 flex-shrink-0">
                                                    <i class="fas fa-check text-blue-600"></i>
                                                </div>
                                                <span class="font-medium text-gray-800">{{ $activity->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div id="accommodation-content" class="trip-detail-content p-6 space-y-8 hidden">
                            <h3 class="text-xl font-semibold mb-4">Where You'll Stay</h3>
                            <div class="space-y-6">
                                @if ($trip->hotels && $trip->hotels->count())
                                    @foreach ($trip->hotels as $hotel)
                                        <div class="flex flex-col md:flex-row items-start gap-4 p-4 bg-gray-50 rounded-lg">
                                            <div class="rounded-lg overflow-hidden w-full md:w-36 h-36 flex-shrink-0">
                                                @if ($hotel->image)
                                                    <img src="{{ asset('storage/' . $hotel->image) }}"
                                                        alt="{{ $hotel->name }}" class="h-full w-full object-cover">
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <h3 class="text-lg font-semibold">{{ $hotel->name }}</h3>
                                                <div class="flex items-center gap-1 mt-1">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <i
                                                            class="fas fa-star h-3 w-3 {{ $i < $hotel->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                                    @endfor
                                                </div>
                                                <p class="text-gray-700 mt-3">{{ $hotel->description }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div id="transport-content" class="trip-detail-content p-6 space-y-6 hidden">
                            <h3 class="text-xl font-semibold mb-4">Transportation Details</h3>
                            <div class="space-y-4">
                                @if ($trip->transports && $trip->transports->count())
                                    @foreach ($trip->transports as $transport)
                                        <div class="p-4 border border-gray-100 rounded-lg shadow-sm bg-white hover:bg-blue-50 transition cursor-pointer"
                                            onclick="showTransportModal({{ $transport->id }})"
                                            id="transport-card-{{ $transport->id }}">
                                            <div class="flex items-center justify-between mb-4">
                                                <div class="flex items-center gap-3">
                                                    @if ($transport->type == 'Flight')
                                                        <div class="bg-blue-100 p-2 rounded-full">
                                                            <i class="fas fa-plane text-blue-600"></i>
                                                        </div>
                                                    @elseif($transport->type == 'Train')
                                                        <div class="bg-green-100 p-2 rounded-full">
                                                            <i class="fas fa-train text-green-600"></i>
                                                        </div>
                                                    @elseif($transport->type == 'Bus')
                                                        <div class="bg-yellow-100 p-2 rounded-full">
                                                            <i class="fas fa-bus text-yellow-600"></i>
                                                        </div>
                                                    @else
                                                        <div class="bg-gray-100 p-2 rounded-full">
                                                            <i class="fas fa-shuttle-van text-gray-600"></i>
                                                        </div>
                                                    @endif
                                                    <h3 class="font-medium">{{ $transport->type }}</h3>
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $transport->duration }}</div>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <div class="text-sm">
                                                    <p class="font-medium text-lg">{{ $transport->departure_time }}</p>
                                                    <p class="text-gray-500">{{ $transport->departure_location }}</p>
                                                </div>
                                                <div class="flex-1 mx-4 flex items-center justify-center">
                                                    <div class="w-full h-0.5 bg-gray-300 relative">
                                                        <div
                                                            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-3 h-3 bg-gray-500 rounded-full">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-sm text-right">
                                                    <p class="font-medium text-lg">{{ $transport->arrival_time }}</p>
                                                    <p class="text-gray-500">{{ $transport->arrival_location }}</p>
                                                </div>
                                            </div>
                                            <!-- Hidden details for JS -->
                                            <div id="transport-details-{{ $transport->id }}" class="hidden"
                                                data-type="{{ $transport->type }}"
                                                data-departure_time="{{ $transport->departure_time }}"
                                                data-departure_location="{{ $transport->departure_location }}"
                                                data-arrival_time="{{ $transport->arrival_time }}"
                                                data-arrival_location="{{ $transport->arrival_location }}"
                                                data-duration="{{ $transport->duration }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                        <div class="p-6 border-b">
                            <h2 class="text-xl font-semibold mb-4">Traveler Reviews</h2>
                            @auth
                                <form action="{{ route('comments.store') }}" method="POST" class="flex items-start gap-3">
                                    @csrf
                                    <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                                    <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                                        alt="{{ auth()->user()->name }}"
                                        class="h-10 w-10 rounded-full object-cover border border-gray-200">
                                    <div class="flex-1 space-y-2">
                                        <textarea name="content"
                                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition"
                                            placeholder="Share your experience..." rows="2" required></textarea>
                                        <button type="submit"
                                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                            Post Review
                                        </button>
                                    </div>
                                </form>
                            @endauth
                        </div>
                        <div class="p-6 space-y-6">
                            @forelse($trip->comments as $comment)
                                <div class="flex items-start gap-3 group">
                                    <img src="{{ $comment->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
                                        alt="{{ $comment->user->name }}"
                                        class="h-10 w-10 rounded-full object-cover border border-gray-200 mt-1">
                                    <div class="flex-1">
                                        <div class="bg-gray-50 rounded-2xl px-4 py-3 relative">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $comment->user->name }}</span>
                                                    <span
                                                        class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                @if (auth()->id() === $comment->user_id)
                                                    <div class="opacity-0 group-hover:opacity-100 transition">
                                                        <button type="button"
                                                            onclick="toggleEditForm({{ $comment->id }})"
                                                            class="text-xs text-blue-600 hover:underline">Edit</button>
                                                        <form action="{{ route('comments.destroy', $comment->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-xs text-red-600 hover:underline ml-2">Delete</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mt-2 text-gray-800" id="comment-content-{{ $comment->id }}">
                                                {{ $comment->content }}
                                            </div>
                                        </div>
                                        @if (auth()->id() === $comment->user_id)
                                            <form action="{{ route('comments.update', $comment->id) }}" method="POST"
                                                class="mt-2 flex gap-2 hidden" id="edit-form-{{ $comment->id }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="content" value="{{ $comment->content }}"
                                                    class="flex-1 rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-300"
                                                    required>
                                                <button type="submit"
                                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Save</button>
                                                <button type="button" onclick="toggleEditForm({{ $comment->id }})"
                                                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="bg-gray-50 rounded-xl p-8 text-center">
                                    <div class="text-gray-400 mb-2">
                                        <i class="fas fa-comment-slash text-4xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-700">No reviews yet</h3>
                                    <p class="text-gray-500 mt-1">Be the first to share your experience!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="lg:sticky lg:top-20">
                    <div class="space-y-6">

                        <!-- Organiser Card -->
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                            <div class="p-6">
                                <h2 class="text-xl font-semibold mb-4">Trip Organizer</h2>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="h-16 w-16 rounded-full bg-blue-50 overflow-hidden border-2 border-blue-100">
                                        @if ($trip->organizer && $trip->organizer->avatar)
                                            <img src="{{ asset('storage/' . $trip->organizer->avatar) }}"
                                                alt="{{ $trip->organizer->name }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-blue-500">
                                                <i class="fas fa-user-circle text-3xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">{{ $trip->organizer->name ?? '' }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">Trip Expert</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Map Card -->
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                            <div class="p-6">
                                <h2 class="text-xl font-semibold mb-4">Location</h2>
                                <div class="bg-blue-50 rounded-lg overflow-hidden">
                                    <div
                                        class="aspect-video bg-gray-200 rounded-md flex items-center justify-center relative">
                                        <i class="fas fa-map-marker-alt text-3xl text-red-500"></i>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                    </div>
                                </div>
                                <p class="text-center text-gray-600 mt-3">{{ $trip->location }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.trip-detail-tab');
            const contents = document.querySelectorAll('.trip-detail-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const target = tab.dataset.tab;

                    // Hide all contents
                    contents.forEach(content => {
                        content.classList.add('hidden');
                    });

                    // Show target content
                    document.getElementById(`${target}-content`).classList.remove('hidden');

                    // Update active tab
                    tabs.forEach(t => {
                        t.classList.remove('border-blue-600', 'text-blue-600');
                        t.classList.add('border-transparent');
                    });
                    tab.classList.add('border-blue-600', 'text-blue-600');
                    tab.classList.remove('border-transparent');
                });
            });
        });

        function toggleEditForm(commentId) {
            const content = document.getElementById(`comment-content-${commentId}`);
            const form = document.getElementById(`edit-form-${commentId}`);

            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
                content.classList.add('hidden');
            } else {
                form.classList.add('hidden');
                content.classList.remove('hidden');
            }
        }

        function showTransportModal(transportId) {
            const transportDetails = document.getElementById(`transport-details-${transportId}`);
            // Implement modal functionality here if needed
            alert(
                `Transport details for ${transportDetails.dataset.type} from ${transportDetails.dataset.departure_location} to ${transportDetails.dataset.arrival_location}`);
        }

        function changeParticipants(delta) {
            const input = document.getElementById('participants');
            let value = parseInt(input.value) || 1;
            value += delta;
            if (value < 1) value = 1;
            input.value = value;
        }

        // Show payment modal and pass participants value
        function showPaymentModal() {
            const participants = document.getElementById('participants').value;
            document.getElementById('modal-participants').value = participants;
            document.getElementById('payment-modal').classList.remove('hidden');
        }

        // Close payment modal
        function closePaymentModal() {
            document.getElementById('payment-modal').classList.add('hidden');
        }
    </script>
@endsection
