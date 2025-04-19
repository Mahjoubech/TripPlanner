<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Organizer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        @media (max-width: 768px) {
            .sidebar-hidden {
                transform: translateX(-100%);
            }
        }
        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.3s ease;
            display: none;
        }
        /* Fix content width on mobile */
        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100">
    <!-- Sidebar Overlay (Mobile only) -->
    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 z-40 md:hidden"></div>

    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Mobile Menu Toggle -->
        <div class="md:hidden fixed bottom-4 right-4 z-50">
            <button id="sidebarToggle" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed sidebar-transition md:sticky top-0 w-64 bg-gray-900 text-white h-screen flex flex-col z-50 transform -translate-x-full md:translate-x-0">
            <div class="p-6 flex items-center justify-between">
                <a href="{{ route('organizer.dashboard') }}" class="text-2xl font-bold">
                    <span class="text-blue-500">Trip</span>Planner
                </a>
                <button id="closeSidebar" class="md:hidden text-gray-300 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="px-4 py-2">
                <div class="bg-gray-800 rounded-lg p-3 flex items-center">
                    <img id="sidebarProfileImage" src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api' }}/?name={{ Auth::user()->name }}" alt="Profile" class="h-16 w-16  rounded-full mr-3 object-cover">
                    <div>
                        <div class="font-medium">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-400">Organizer</div>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 mt-6 space-y-1 overflow-y-auto">
                <a href="{{ route('organizer.dashboard') }}" class="block px-4 py-2 rounded-md text-sm font-medium {{ Request::routeIs('organizer.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                <a href="{{ route('trips.index') }}" class="block px-4 py-2 rounded-md text-sm font-medium {{ Request::routeIs('trips.index') || Request::routeIs('trips.create') || Request::routeIs('trips.show') || Request::routeIs('trips.edit')? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-clock mr-2"></i> Trips
                </a>
                <a href="{{ route('hotels.index') }}" class="block px-4 py-2 rounded-md text-sm font-medium {{ Request::routeIs('hotels.index') || Request::routeIs('hotels.create') || Request::routeIs('hotels.show')|| Request::routeIs('hotels.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-hotel mr-2"></i> Hotels
                </a>
                <a href="{{ route('activity.index') }}" class="block px-4 py-2 rounded-md text-sm font-medium {{ Request::routeIs('activity.index')  || Request::routeIs('activity.create') || Request::routeIs('activity.show')|| Request::routeIs('activity.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-tasks mr-2"></i> Activities
                </a>
                <a href="{{ route('transport.index') }}" class="block px-4 py-2 rounded-md text-sm font-medium {{ Request::routeIs('transport.index')  || Request::routeIs('transport.create') || Request::routeIs('transport.show')|| Request::routeIs('transport.edit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-bus-alt mr-2"></i> Transportation
                </a>
                <a href="{{ route('profile.profile') }}" class="block px-4 py-2 rounded-md text-sm font-medium {{ Request::routeIs('profile.profile') || Request::routeIs('profile.updatePassword') || Request::routeIs('profile.updatePassword') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
            </nav>

            <div class="p-4 border-t border-gray-800">
                <a href="{{ route('logout') }}" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                class="block px-4 py-2 rounded-md text-sm font-medium text-red-500 hover:bg-gray-800 hover:text-white">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </aside>
    
        <!-- Main Content -->
        <div class="flex-1 flex flex-col main-content">
            @include('layouts.header')
            <!-- Page Content -->
            <main class="container mx-auto px-4 py-6 lg:ml-10 md:ml-0 flex-grow">
                @yield('content1')
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white py-4 border-t">
                <div class="container mx-auto px-4 text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} TripPlanner. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    <script>
        // Show/hide sidebar overlay
        function toggleSidebarOverlay(show) {
            const overlay = document.getElementById('sidebarOverlay');
            if (show) {
                overlay.style.display = 'block';
            } else {
                overlay.style.display = 'none';
            }
        }
        
        // Handle mobile menu button click
        document.getElementById('mobileMenuButton')?.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.remove('-translate-x-full');
            toggleSidebarOverlay(true);
        });

        // Handle close sidebar button
        document.getElementById('closeSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.add('-translate-x-full');
            toggleSidebarOverlay(false);
        });

        // Handle sidebar toggle button
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const isHidden = sidebar.classList.contains('-translate-x-full');
            sidebar.classList.toggle('-translate-x-full');
            toggleSidebarOverlay(isHidden);
        });

        // Handle overlay click to close sidebar
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.add('-translate-x-full');
            toggleSidebarOverlay(false);
        });

        // Search toggle for mobile
        document.getElementById('searchToggle')?.addEventListener('click', function() {
            const searchBar = document.getElementById('mobileSearchBar');
            searchBar.classList.toggle('hidden');
        });

        // Dropdown toggles
        document.getElementById('notificationToggle')?.addEventListener('click', function() {
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.classList.toggle('hidden');
            document.getElementById('profileDropdown')?.classList.add('hidden');
        });

        document.getElementById('profileToggle')?.addEventListener('click', function() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
            document.getElementById('notificationDropdown')?.classList.add('hidden');
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const notificationToggle = document.getElementById('notificationToggle');
            const profileToggle = document.getElementById('profileToggle');
            const notificationDropdown = document.getElementById('notificationDropdown');
            const profileDropdown = document.getElementById('profileDropdown');

            if (notificationToggle && notificationDropdown && 
                !notificationToggle.contains(event.target) && 
                !notificationDropdown.contains(event.target)) {
                notificationDropdown.classList.add('hidden');
            }

            if (profileToggle && profileDropdown && 
                !profileToggle.contains(event.target) && 
                !profileDropdown.contains(event.target)) {
                profileDropdown.classList.add('hidden');
            }
        });

        // Update profile image if available
        function updateProfileImage() {
            const profileImageUrl = "{{ Auth::user()->profile_photo ?? '' }}";
            if (profileImageUrl) {
                const headerImage = document.getElementById('headerProfileImage');
                const sidebarImage = document.getElementById('sidebarProfileImage');
                
                if (headerImage) headerImage.src = profileImageUrl;
                if (sidebarImage) sidebarImage.src = profileImageUrl;
            }
        }

        // Call when page loads
        document.addEventListener('DOMContentLoaded', function() {
            updateProfileImage();
        });
    </script>

    @stack('scripts')
</body>
</html>