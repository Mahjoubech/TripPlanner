<div id="responsive-nav" class="hidden mt-16 fixed inset-0 bg-black bg-opacity-50 z-40">
    <div class="absolute top-0 left-0 w-64 h-full bg-white shadow-md rounded-r-lg">
        <div class="p-4">
            <nav class="space-y-1">
                <a href="{{route('organizer.dashboard')}}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium bg-blue-50 text-blue-600">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100">
                    <i class="fas fa-heart"></i>
                    <span>Favorites</span>
                </a>
                <a href="{{route('profile.profile')}}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </nav>
        </div>
        <div class="p-4 border-t">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-red-600 hover:bg-gray-100">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</div>