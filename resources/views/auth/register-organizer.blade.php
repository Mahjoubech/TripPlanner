@extends('auth.register')

@section('form-content')
<div class="bg-white">
    <h2 class="text-2xl font-bold text-gray-900">Create an Organizer Account</h2>
    <p class="mt-2 text-sm text-gray-600">
        Already have an account? 
        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-700">
            Sign in
        </a>
    </p>

    <form method="POST" action="{{ route('register.organizer') }}" enctype="multipart/form-data" class="mt-8">
        @csrf
        <div class="grid grid-cols-1 gap-6">
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

            <!-- Contact Information -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input id="email" 
                           name="email" 
                           type="email" 
                           value="{{ old('email') }}" 
                           required
                           placeholder="you@example.com"
                           class="mt-1 block w-full rounded-lg border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} px-3 py-3 placeholder-gray-400 focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input id="phone" 
                           name="phone" 
                           type="tel" 
                           value="{{ old('phone') }}"
                           required
                           placeholder="+212 600000000"
                           class="mt-1 block w-full rounded-lg border {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-300' }} px-3 py-3 placeholder-gray-400 focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Legal Information -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="CIN" class="block text-sm font-medium text-gray-700">
                        CIN <span class="text-red-500">*</span>
                    </label>
                    <input id="CIN" 
                           name="CIN" 
                           type="text" 
                           value="{{ old('CIN') }}" 
                           required
                           class="mt-1 block w-full rounded-lg border {{ $errors->has('CIN') ? 'border-red-500' : 'border-gray-300' }} px-3 py-3 placeholder-gray-400 focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                    @error('CIN')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="document_number" class="block text-sm font-medium text-gray-700">
                        Document Number <span class="text-red-500">*</span>
                    </label>
                    <input id="document_number" 
                           name="document_number" 
                           type="text" 
                           value="{{ old('document_number') }}" 
                           required
                           class="mt-1 block w-full rounded-lg border {{ $errors->has('document_number') ? 'border-red-500' : 'border-gray-300' }} px-3 py-3 placeholder-gray-400 focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                    @error('document_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Document Upload -->
            <div>
                <label for="identification_document" class="block text-sm font-medium text-gray-700">
                    Business License/Registration (PDF) <span class="text-red-500">*</span>
                </label>
                <input type="file" 
                       id="identification_document" 
                       name="identification_document" 
                       accept=".pdf" 
                       required
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                @error('identification_document')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Upload a PDF document (max. 2MB). Required for business verification.</p>
            </div>

            <!-- Password -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input id="password" 
                           name="password" 
                           type="password" 
                           required
                           placeholder="Minimum 6 characters"
                           class="mt-1 block w-full rounded-lg border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} px-3 py-3 placeholder-gray-400 focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        Confirm Password <span class="text-red-500">*</span>
                    </label>
                    <input id="password_confirmation" 
                           name="password_confirmation" 
                           type="password" 
                           required
                           placeholder="Confirm your password"
                           class="mt-1 block w-full rounded-lg border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-300' }} px-3 py-3 placeholder-gray-400 focus:border-blue-600 focus:ring-blue-600 sm:text-sm">
                </div>
            </div>
        </div>

        <button type="submit" 
                class="mt-8 flex w-full justify-center rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200">
            Create Organizer Account
        </button>
    </form>
</div>
@endsection