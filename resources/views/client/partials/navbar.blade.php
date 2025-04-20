<header class="sticky top-0 z-50 w-full border-b bg-white/95 backdrop-blur">
    <div class="container mx-auto flex h-16 items-center justify-between px-4">
        <div class="flex items-center gap-4">
            <button type="button" class="md:hidden rounded-md p-2 text-gray-500 hover:bg-gray-100" id="mobile-menu-button">
                <i class="fas fa-bars"></i>
            </button>

            <a href="{{ route('client.dashboard') }}" class="flex items-center gap-2 font-bold text-lg">
                <span class="text-blue-600">Trip</span>Planner
            </a>

            <div class="hidden md:flex relative max-w-sm">
                <i class="fas fa-search absolute left-2 top-2.5 text-gray-400"></i>
                <input type="text" placeholder="Search trips..." class="pl-8 w-[300px] rounded-md border border-gray-300 py-2 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <a href="" class="relative p-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-comment"></i>
                <span class="absolute -top-1 -right-1 h-5 w-5 rounded-full bg-blue-600 text-xs text-white flex items-center justify-center">3</span>
            </a>

            <a href="" class="relative p-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-bell"></i>
                <span class="absolute -top-1 -right-1 h-5 w-5 rounded-full bg-blue-600 text-xs text-white flex items-center justify-center">5</span>
            </a>

            <a href="" class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                <img src="https://ui-avatars.com/api/?name=John+Doe" alt="User" class="h-full w-full object-cover">
            </a>
        </div>
    </div>
</header>