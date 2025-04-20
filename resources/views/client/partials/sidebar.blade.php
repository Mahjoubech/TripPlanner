<div class="hidden md:block md:col-span-3 space-y-6">
    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="p-4 border-b">
            <h3 class="text-lg font-medium">Profile</h3>
        </div>
        <div class="p-4 flex flex-col items-center text-center">
            <div class="h-20 w-20 rounded-full bg-gray-200 mb-4 overflow-hidden">
                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api' }}/?name={{ Auth::user()->name }}" alt="User" class="h-full w-full object-cover">
            </div>
            <h3 class="font-medium text-lg">{{ Auth::user()->name }}</h3>
            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
            <div class="mt-4 w-full">
                <a href="{{route('profile.profile')}}" class="block w-full rounded-md border border-gray-300 px-4 py-2 text-center text-sm font-medium hover:bg-gray-50">
                    View Profile
                </a>
            </div>
        </div>
    </div>

    @include('client.partials.navigation')
</div>