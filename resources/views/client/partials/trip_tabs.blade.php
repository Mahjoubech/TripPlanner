<div class="flex flex-col items-center">
    <!-- Centered Filter Tabs -->
    <div class="w-full max-w-3xl mx-auto">
        <div class="flex justify-center space-x-4 border-b">
            <button type="button" class="trip-tab border-b-2 border-blue-600 text-blue-600 px-6 py-3 text-sm font-medium transition-all duration-200 hover:bg-blue-50 rounded-t-lg" data-tab="all">
                <i class="fas fa-globe mr-2"></i>
                All Trips
            </button>
            <button type="button" class="trip-tab border-b-2 border-transparent text-gray-500 hover:text-gray-700 px-6 py-3 text-sm font-medium transition-all duration-200 hover:bg-blue-50 rounded-t-lg" data-tab="completed">
                <i class="fas fa-check-circle mr-2"></i>
                Completed Trips
            </button>
            <button type="button" class="trip-tab border-b-2 border-transparent text-gray-500 hover:text-gray-700 px-6 py-3 text-sm font-medium transition-all duration-200 hover:bg-blue-50 rounded-t-lg" data-tab="pending">
                <i class="fas fa-clock mr-2"></i>
                Pending Trips
            </button>
        </div>
    </div>

    <!-- Content Area -->
    <div class="w-full max-w-7xl mx-auto mt-8 px-4">
        <!-- All Trips Content -->
        <div id="all-trips-content" class="trip-content space-y-6">
            <div class="flex justify-center items-center h-32">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            </div>
        </div>

        <!-- Completed Trips Content -->
        <div id="completed-trips-content" class="trip-content space-y-6 hidden">
            <div class="flex justify-center items-center h-32">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            </div>
        </div>

        <!-- Pending Trips Content -->
        <div id="pending-trips-content" class="trip-content space-y-6 hidden">
            <div class="flex justify-center items-center h-32">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            </div>
        </div>
    </div>
</div>