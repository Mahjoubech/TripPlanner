@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Left Section with Background Image -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-blue-600">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                {{-- <img src="{{ asset('images/travel-bg.jpg') }}" 
                     alt="Travel Background" 
                     class="w-full h-full object-cover object-center filter grayscale opacity-50"> --}}
                <div class="absolute inset-0 bg-blue-800 bg-opacity-60"></div>
            </div>

            <!-- Content Over Image -->
            <div class="relative z-10 w-full flex flex-col items-center justify-center px-12">
                <div class="max-w-2xl text-center">
                    {{-- <img src="{{ asset('images/logo-white.png') }}" alt="Logo" class="h-16 mx-auto mb-8"> --}}
                    <h1 class="text-5xl font-bold text-white mb-6">Start Your Journey Today</h1>
                    <p class="text-gray-100 text-2xl leading-relaxed mb-8">
                        Join thousands of travelers creating unforgettable memories around the world
                    </p>
                    <div class="mt-8 flex flex-col gap-4">
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-4">
                                <i class="fas fa-map-marker-alt text-white h-6 w-6"></i>
                            </div>
                            <p class="text-xl text-white text-left">Discover amazing destinations</p>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-4">
                                <i class="fas fa-users text-white h-6 w-6"></i>
                            </div>
                            <p class="text-xl text-white text-left">Connect with fellow travelers</p>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-4">
                                <i class="fas fa-heart text-white h-6 w-6"></i>
                            </div>
                            <p class="text-xl text-white text-left">Create memories that last forever</p>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-8 left-8 text-white text-sm">
                    © {{ date('Y') }} TripPlanner. All rights reserved.
                </div>
            </div>
        </div>

        <!-- Right Section with Registration Forms -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 bg-white">
            <!-- Mobile Logo -->
            <div class="lg:hidden mb-8">
                <a href="#" class="flex items-center gap-2 font-bold text-lg">
                    <span class="text-blue-600">Trip</span>Planner
                </a>
            </div>

            <div class="w-full max-w-md">
                <!-- Type Selection -->
                <div class="mb-8 text-center flex justify-center">
                    <a href="{{ route('register') }}" 
                       class="inline-block px-6 py-2 {{ request()->is('register') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500' }}">
                        Client Registration
                    </a>
                    <a href="{{ route('register.organizer') }}" 
                       class="inline-block px-6 py-2 {{ request()->is('register/organizer') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500' }}">
                        Organizer Registration
                    </a>
                </div>

                @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Registration Form Content -->
                @yield('form-content')

                <!-- Social Registration -->
                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="bg-white px-2 text-gray-500">Or continue with</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <a href="" 
                           class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/>
                            </svg>
                            Google
                        </a>

                        <a href="" 
                           class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Facebook
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection