@foreach ($trips as $trip)
<div class="rounded-lg border border-gray-200 bg-white shadow-sm overflow-hidden">
    <div class="flex flex-col md:flex-row">
        <div class="relative md:w-1/3">
            @php
                $imagePath = null;
                if ($trip->image) {
                    $publicPath = public_path('storage/' . $trip->image);
                    if (file_exists($publicPath)) {
                        $imagePath = asset('storage/' . $trip->image);
                        \Log::info('Image found at: ' . $publicPath);
                    } else {
                        \Log::error('Image not found at: ' . $publicPath);
                    }
                }
                $imagePath = $imagePath ?? 'https://via.placeholder.com/800x400?text=No+Image';
            @endphp
            <img src="{{ $imagePath }}" alt="{{ $trip->title }}" class="h-48 md:h-full w-full object-cover" onerror="this.src='https://via.placeholder.com/800x400?text=No+Image'">
            <button type="button" class="absolute top-2 right-2 h-8 w-8 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-gray-600 hover:text-red-500">
                <i class="far fa-heart h-4 w-4"></i>
            </button>
        </div>
        <div class="flex flex-col p-4 md:w-2/3">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="font-semibold text-lg">{{ $trip->title }}</h3>
                    <div class="flex items-center mt-1 text-sm text-gray-500">
                        <i class="fas fa-map-marker-alt h-3 w-3 mr-1"></i>
                        {{ $trip->location }}
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    <i class="fas fa-star h-4 w-4 text-yellow-400"></i>
                    <span class="font-medium">4.5</span>
                    <span class="text-xs text-gray-500">(0)</span>
                </div>
            </div>
            <p class="mt-2 text-sm line-clamp-2">{{ $trip->description }}</p>
            <div class="mt-3 flex flex-wrap gap-2">
                <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">{{ $trip->duration }} days</span>
                <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">{{ $trip->start_date->format('M d') }} - {{ $trip->end_date->format('M d, Y') }}</span>
                <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">{{ $trip->status }}</span>
            </div>
            <div class="mt-auto pt-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="h-6 w-6 rounded-full bg-gray-200 overflow-hidden">
                        <img src="{{ $trip->organizer->avatar ? asset('storage/' . $trip->organizer->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($trip->organizer->name) }}" alt="{{ $trip->organizer->name }}" class="h-full w-full object-cover">
                    </div>
                    <span class="text-sm">{{ $trip->organizer->name }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="text-lg font-bold">${{ number_format($trip->price, 2) }}</div>
                    <span class="text-xs text-gray-500">per person</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-between p-4 border-t">
        <div class="flex items-center gap-4">
            <button type="button" class="flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
                <i class="far fa-heart h-4 w-4"></i>
                <span>0</span>
            </button>
            <button type="button" class="flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
                <i class="far fa-comment h-4 w-4"></i>
                <span>0</span>
            </button>
            <button type="button" class="flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
                <i class="fas fa-share-alt h-4 w-4"></i>
            </button>
        </div>
        <a href="{{ route('trips.show', $trip) }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
            View Details
        </a>
    </div>
</div>
@endforeach