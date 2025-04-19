@extends('layouts.app')

@section('title', 'Welcome to TripPlanner')

@section('content')
<div class="flex min-h-screen flex-col">
    <!-- Header -->
    <header class="sticky top-0 z-50 w-full border-b bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/60">
        <div class="container mx-auto flex h-20 items-center justify-between px-4 sm:px-6 lg:px-8">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="text-primary text-md">Trip</span><span class="text-black text-xl">Planner</span>
            </a>

            <!-- Navigation -->
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                    Login
                </a>
                <a href="{{ route('register') }}" 
                   class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 transition-colors">
                    Sign Up
                </a>
            </div>
        </div>
    </header>
    
    <main class="flex-1">
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-white py-20 sm:py-24 lg:py-32">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center text-center">
                    <h1 class="text-5xl font-extrabold tracking-tight text-blue-600 sm:text-6xl lg:text-7xl">
                        Plan Your Next Adventure
                    </h1>
                    <p class="mt-6 max-w-2xl text-lg leading-relaxed text-gray-600">
                        Discover amazing destinations, connect with fellow travelers, and create unforgettable memories 
                        with our comprehensive trip planning platform.
                    </p>
                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <a href="{{ route('register') }}" 
                           class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200">
                            Get Started
                            <svg class="ml-2 -mr-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="{{ route('register.organizer') }}" 
                           class="inline-flex items-center rounded-lg border border-blue-200 bg-white px-6 py-3 text-sm font-semibold text-blue-600 shadow-sm hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200">
                            Become an Organizer
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Features Section -->
        <section class="bg-blue-50 py-20 sm:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-extrabold tracking-tight text-blue-600 sm:text-5xl">
                        How It Works
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Simple steps to start your journey
                    </p>
                </div>

                <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Discover -->
                    <div class="flex flex-col items-center rounded-2xl bg-white p-8 shadow-sm ring-1 ring-blue-100">
                        <div class="rounded-full bg-blue-100 p-4 mb-4">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Discover</h3>
                        <p class="mt-4 text-center text-gray-600">
                            Browse through our curated selection of trips from verified organizers
                        </p>
                    </div>

                    <!-- Connect -->
                    <div class="flex flex-col items-center rounded-2xl bg-white p-8 shadow-sm ring-1 ring-blue-100">
                        <div class="rounded-full bg-blue-100 p-4 mb-4">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Connect</h3>
                        <p class="mt-4 text-center text-gray-600">
                            Join group chats with fellow travelers and experienced organizers
                        </p>
                    </div>

                    <!-- Experience -->
                    <div class="flex flex-col items-center rounded-2xl bg-white p-8 shadow-sm ring-1 ring-blue-100">
                        <div class="rounded-full bg-blue-100 p-4 mb-4">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Experience</h3>
                        <p class="mt-4 text-center text-gray-600">
                            Enjoy your trip and share your experiences with the community
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200">
        <div class="container mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="TripPlanner" class="h-12 w-auto">
                </div>
                <p class="text-sm text-gray-500">
                    © {{ date('Y') }} TripPlanner. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</div>
@endsection