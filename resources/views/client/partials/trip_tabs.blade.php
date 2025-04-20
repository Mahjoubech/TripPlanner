<div class="rounded-lg border border-gray-200 bg-white shadow-sm">
    <div class="border-b">
        <div class="flex">
            <button type="button" class="trip-tab w-1/3 py-3 text-center text-sm font-medium border-b-2 border-blue-600 text-blue-600" data-tab="all">All Trips</button>
            <button type="button" class="trip-tab w-1/3 py-3 text-center text-sm font-medium border-b-2 border-transparent hover:text-gray-700" data-tab="trending">Trending</button>
            <button type="button" class="trip-tab w-1/3 py-3 text-center text-sm font-medium border-b-2 border-transparent hover:text-gray-700" data-tab="new">New</button>
        </div>
    </div>

    <!-- All Trips Content -->
    <div id="all-trips-content" class="trip-content p-4 space-y-4">
        @include('client.partials.trip_card', ['type' => 'all'])
    </div>

    <!-- Trending Trips Content -->
    <div id="trending-trips-content" class="trip-content p-4 space-y-4 hidden">
        @include('client.partials.trip_card', ['type' => 'Family Trip'])
    </div>

    <!-- New Trips Content -->
    <div id="new-trips-content" class="trip-content p-4 space-y-4 hidden">
        @include('client.partials.trip_card', ['type' => 'Group Trip'])
    </div>
</div>