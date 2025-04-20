@extends('layouts.app')

@section('title', 'Application Under Review')

@section('content')
<div class="min-h-screen flex flex-col bg-white">
    <!-- Header -->
    <header class="w-full border-b border-gray-200 bg-white">
        <div class="container mx-auto flex h-16 items-center justify-between px-6">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/logo.svg') }}" alt="TripPlanner" class="h-8 w-auto">
            </a>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 border border-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content - Simple Layout -->
    <main class="flex-1 py-12">
        <div class="container mx-auto px-6 max-w-4xl">
            <!-- Simple Pending Header -->
            <div class="text-center mb-10">
                <svg class="h-16 w-16 mx-auto text-gray-900 mb-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="3" width="18" height="18" stroke="currentColor" stroke-width="2" />
                    <path d="M12 8V12L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="square" />
                </svg>
                
                <h1 class="text-3xl font-bold text-gray-900 mb-4">
                    Application Under Review
                </h1>
                <p class="text-lg text-gray-600">
                    Thank you for applying as an organizer. Our team is currently reviewing your application.
                </p>
            </div>
            
            <!-- Simple Status Bar -->
            <div class="mb-12">
                <div class="flex mb-2">
                    <div class="bg-black h-4 w-1/3"></div>
                    <div class="bg-gray-200 h-4 w-2/3"></div>
                </div>
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Submitted</span>
                    <span class="font-medium">Under Review</span>
                    <span>Approved</span>
                </div>
            </div>

            <!-- Simple Info Section -->
            <div class="border-t border-b border-gray-200 py-8 mb-12">
                <p class="text-center text-gray-600 mb-6">
                    Estimated review time: <span class="font-medium">1-3 business days</span>
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Verification Items -->
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-4 text-lg">Current Process:</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center text-gray-600">
                                <svg class="h-5 w-5 text-gray-900 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7" stroke-width="2" stroke-linecap="square"/>
                                </svg>
                                ID Verification
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="h-5 w-5 text-gray-900 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7" stroke-width="2" stroke-linecap="square"/>
                                </svg>
                                Business License Check
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 12h12" stroke-width="2" stroke-linecap="square"/>
                                </svg>
                                Email Confirmation
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 12h12" stroke-width="2" stroke-linecap="square"/>
                                </svg>
                                Dashboard Access
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Support Info -->
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-4 text-lg">Need Assistance?</h3>
                        <p class="text-gray-600 mb-3">
                            Our support team is here to help with any questions you might have about your application.
                        </p>
                        <p class="text-gray-600">
                            Contact us at: 
                            <a href="mailto:support@tripplanner.com" class="text-gray-900 hover:underline">
                                cherkaouielmahjoub50@gmail.com
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" 
                   class="px-8 py-3 border border-transparent text-base font-medium text-white bg-black hover:bg-gray-900">
                    Return to Home
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="px-8 py-3 border border-gray-300 text-base font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="container mx-auto px-6 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="TripPlanner" class="h-8 w-auto">
                </div>
                <p class="text-sm text-gray-500">
                    © {{ date('Y') }} TripPlanner. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</div>
@endsection