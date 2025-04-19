@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Left Section with Background Image and Organizer Button -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-blue-600">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-blue-800 bg-opacity-60"></div>
            </div>

            <!-- Content Over Image -->
            <div class="relative z-10 w-full flex flex-col items-center justify-center px-12">
                <div class="max-w-2xl text-center">
                    <h1 class="text-5xl font-bold text-white mb-6">Discover Your Next Adventure</h1>
                    <p class="text-gray-100 text-2xl leading-relaxed mb-8">
                        Join thousands of travelers creating unforgettable memories around the world
                    </p>
                    
                    <!-- Feature Points -->
                    <div class="mb-10 flex flex-col gap-4">
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-4">
                                <i class="fas fa-route text-white h-6 w-6"></i>
                            </div>
                            <p class="text-xl text-white text-left">Plan trips with expert guidance</p>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-4">
                                <i class="fas fa-globe text-white h-6 w-6"></i>
                            </div>
                            <p class="text-xl text-white text-left">Explore destinations worldwide</p>
                        </div>
                    </div>
                    
                    <!-- Organizer Button -->
                    <a href="{{ route('register.organizer') }}" 
                       class="inline-block px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-600 transition-all duration-200">
                        Become an Organizer
                    </a>
                </div>
                <div class="absolute bottom-8 left-8 text-white text-sm">
                    © {{ date('Y') }} TripPlanner. All rights reserved.
                </div>
            </div>
        </div>

        
        <!-- Right Section with Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 bg-white">
            <!-- Mobile Logo -->
            <div class="lg:hidden mb-8">
                <a href="#" class="flex items-center gap-2 font-bold text-lg">
                    <span class="text-blue-600">Trip</span>Planner
                </a>
            </div>

            <div class="w-full max-w-md">
                @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="bg-white">
                    <h2 class="text-2xl font-bold text-gray-900">Sign in to your account</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Or 
                        <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-700">
                            create a new account
                        </a>
                    </p>

                    <!-- Social Login Buttons -->
                    <div class="mt-6 space-y-4">
                        <a href="" 
                           class="flex w-full items-center justify-center gap-3 rounded-lg bg-white px-4 py-3 text-gray-700 border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200">
                            <svg class="h-5 w-5" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/>
                            </svg>
                            Continue with Google
                        </a>

                        <a href="" 
                           class="flex w-full items-center justify-center gap-3 rounded-lg bg-white px-4 py-3 text-gray-700 border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200">
                            <svg class="h-5 w-5" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Continue with Facebook
                        </a>
                    </div>

                    <div class="mt-6 relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="bg-white px-2 text-gray-500">Or continue with email</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-6">
                        @csrf
                        
                        <div class="space-y-5">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email address
                                </label>
                                <div class="mt-1 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <input id="email" 
                                           name="email" 
                                           type="email" 
                                           value="{{ old('email') }}"
                                           required
                                           placeholder="name@example.com"
                                           class="block w-full pl-10 appearance-none rounded-lg border border-gray-300 px-3 py-3 placeholder-gray-400 transition-colors focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Password
                                </label>
                                <div class="mt-1 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input id="password" 
                                           name="password" 
                                           type="password"
                                           required
                                           class="block w-full pl-10 appearance-none rounded-lg border border-gray-300 px-3 py-3 placeholder-gray-400 transition-colors focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 sm:text-sm">
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           id="remember" 
                                           name="remember"
                                           class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                                        Remember me
                                    </label>
                                </div>

                                <a href="" 
                                   class="text-sm font-medium text-blue-600 hover:text-blue-700">
                                    Forgot password?
                                </a>
                            </div>
                        </div>

                        <button type="submit" 
                                class="flex w-full justify-center rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200">
                            Sign in
                        </button>
                    </form>

                    <!-- Create Account Links -->
                    <div class="mt-8 space-y-4">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="bg-white px-2 text-gray-500">Don't have an account?</span>
                            </div>
                        </div>

                        <!-- Social Registration Links -->
                        <div class="grid grid-cols-2 gap-4">
                            <a href="" 
                               class="text-center text-sm text-gray-600 hover:text-blue-600 transition-colors">
                                Sign up with Google
                            </a>
                            <a href="" 
                               class="text-center text-sm text-gray-600 hover:text-blue-600 transition-colors">
                                Sign up with Facebook
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection