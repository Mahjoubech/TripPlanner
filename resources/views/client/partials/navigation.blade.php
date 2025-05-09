<div class="rounded-lg border border-gray-200 bg-white shadow-sm">
    <div class="p-4">
        <nav class="space-y-1">
            <a href="" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium bg-blue-50 text-blue-600">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100">
                <i class="fas fa-heart"></i>
                <span>Favorites</span>
            </a>
            <a href="" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100">
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