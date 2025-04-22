@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Profile Header -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Cover Photo -->
        <div class="h-48 bg-gradient-to-r from-blue-500 to-purple-600 relative">
            <div class="absolute bottom-0 left-0 right-0 p-4">
                <div class="flex items-end space-x-4">
                    <!-- Profile Picture -->
                    <div class="relative">
                        <img src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random' }}" 
                             alt="Profile Picture" 
                             class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                        <button class="absolute bottom-0 right-0 bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    <!-- Profile Info -->
                    <div class="text-white mb-4">
                        <h1 class="text-2xl font-bold">{{ auth()->user()->name }}</h1>
                        <p class="text-sm opacity-90">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Navigation -->
        <div class="border-b">
            <nav class="flex space-x-8 px-4">
                <a href="#about" class="py-4 px-2 border-b-2 border-blue-500 text-blue-500 font-medium">About</a>
                <a href="#trips" class="py-4 px-2 text-gray-500 hover:text-gray-700 font-medium">Trips</a>
                <a href="#photos" class="py-4 px-2 text-gray-500 hover:text-gray-700 font-medium">Photos</a>
                <a href="#settings" class="py-4 px-2 text-gray-500 hover:text-gray-700 font-medium">Settings</a>
            </nav>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <!-- Left Column -->
        <div class="md:col-span-1 space-y-6">
            <!-- About Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">About</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Bio</h3>
                        <p class="mt-1">{{ auth()->user()->bio ?? 'No bio added yet.' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Location</h3>
                        <p class="mt-1">{{ auth()->user()->location ?? 'No location set' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Joined</h3>
                        <p class="mt-1">{{ auth()->user()->created_at->format('F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Email</h3>
                        <p class="mt-1">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Phone</h3>
                        <p class="mt-1">{{ auth()->user()->phone ?? 'Not provided' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="md:col-span-2 space-y-6">
            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Recent Activity</h2>
                <div id="recent-activities" class="space-y-4">
                    <div class="flex justify-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                    </div>
                </div>
            </div>
            <!-- Upcoming Trips -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Upcoming Trips</h2>
                <div id="upcoming-trips" class="space-y-4">
                    <div class="flex justify-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .profile-header {
        background-size: cover;
        background-position: center;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('js/profile.js') }}"></script>
@endpush
@endsection
