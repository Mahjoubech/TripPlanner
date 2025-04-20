 <!-- Header/Navbar -->
 <header class="bg-white shadow sticky top-0 z-30  ">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center">
            <button id="mobileMenuButton" class="md:hidden mr-3 text-gray-600 hover:text-gray-800">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <div class="flex items-center space-x-4">
            <!-- Search Bar -->
            <div class="hidden md:block relative">
                <form action="" method="GET">
                    <input type="text" name="query" placeholder="Search..." 
                        class="bg-gray-100 rounded-full py-2 px-4 pr-10 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white">
                    <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Mobile Search Toggle -->
            <button id="searchToggle" class="md:hidden text-gray-600 hover:text-gray-800">
                <i class="fas fa-search"></i>
            </button>

            <!-- Notifications -->
            <div class="relative">
                <button id="notificationToggle" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                    <i class="fas fa-bell"></i>
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-0.5 text-xs font-bold text-white bg-red-500 rounded-full">3</span>
                </button>
                <!-- Notification Dropdown -->
                <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-50">
                    <div class="px-4 py-2 font-medium border-b">Notifications</div>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 border-b">
                        <div class="font-medium">New booking request</div>
                        <div class="text-sm text-gray-600">John Doe requested a trip to Paris</div>
                        <div class="text-xs text-gray-500 mt-1">2 hours ago</div>
                    </a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 border-b">
                        <div class="font-medium">Hotel confirmation</div>
                        <div class="text-sm text-gray-600">Ritz Hotel confirmed reservation #12345</div>
                        <div class="text-xs text-gray-500 mt-1">Yesterday</div>
                    </a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                        <div class="font-medium">Payment received</div>
                        <div class="text-sm text-gray-600">$1,200 payment received for Trip #4562</div>
                        <div class="text-xs text-gray-500 mt-1">2 days ago</div>
                    </a>
                    <div class="px-4 py-2 text-center border-t">
                        <a href="{{ route('organizer.notifications') }}" class="text-sm text-blue-600 hover:text-blue-800">View all notifications</a>
                    </div>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="profileToggle" class="flex items-center focus:outline-none">
                    <img id="headerProfileImage" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="Profile" class="h-8 w-8 rounded-full object-cover">
                    <span class="hidden md:inline-block ml-2 font-medium">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down ml-1 text-xs hidden md:inline-block"></i>
                </button>
                <!-- Profile Dropdown -->
                <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                    <a href="{{ route('profile.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    <a href="{{ route('organizer.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-cog mr-2"></i> Settings
                    </a>
                    <div class="border-t border-gray-100"></div>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();" 
                       class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Search (Hidden by default) -->
    <div id="mobileSearchBar" class="hidden md:hidden px-4 py-2 bg-gray-50">
        <form action="" method="GET" class="relative">
            <input type="text" name="query" placeholder="Search..." 
                class="bg-white rounded-md py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-500 hover:text-gray-700">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</header>
