@extends('auth.register')

@section('form-content')
<div class="bg-white">
    <h2 class="text-2xl font-bold text-gray-900">Create a Client Account</h2>
    <p class="mt-2 text-sm text-gray-600">
        Already have an account? 
        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-700">
            Sign in
        </a>
    </p>

    <form method="POST" action="{{ route('register.client') }}" class="mt-8 space-y-6">
        @csrf
        <div class="space-y-5">
            <!-- Full Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input id="name" 
                       name="name" 
                       type="text" 
                       value="{{ old('name') }}" 
                       required
                       class="mt-1 block w-full rounded-lg border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} px-3 py-3 placeholder-gray-400 focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email Address <span class="text-red-500">*</span>
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
                           placeholder="you@example.com"
                           class="block w-full pl-10 rounded-lg border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} px-3 py-3 placeholder-gray-400 focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">
                    Phone Number <span class="text-red-500">*</span>
                </label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                    </div>
                    <input id="phone" 
                           name="phone" 
                           type="tel" 
                           value="{{ old('phone') }}"
                           required
                           placeholder="+212 600000000"
                           class="block w-full pl-10 rounded-lg border {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-300' }} px-3 py-3 placeholder-gray-400 focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                </div>
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password <span class="text-red-500">*</span>
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
                           placeholder="Minimum 6 characters"
                           class="block w-full pl-10 rounded-lg border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} px-3 py-3 placeholder-gray-400 focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    Confirm Password <span class="text-red-500">*</span>
                </label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input id="password_confirmation" 
                           name="password_confirmation" 
                           type="password" 
                           required
                           placeholder="Confirm your password"
                           class="block w-full pl-10 rounded-lg border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-300' }} px-3 py-3 placeholder-gray-400 focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                </div>
            </div>
        </div>

        <button type="submit" 
                class="mt-6 flex w-full justify-center rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200">
            Create Client Account
        </button>
    </form>
</div>
@endsection