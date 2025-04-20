@extends('layouts.organizer')

@section('title', 'Add New Hotel')

@push('styles')
<style>
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #374151;
    }
    .form-input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #D1D5DB;
        border-radius: 0.375rem;
        background-color: #F9FAFB;
    }
    .form-input:focus {
        outline: none;
        border-color: #3B82F6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
    }
    .form-error {
        color: #DC2626;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    .dropzone {
        border: 2px dashed #D1D5DB;
        border-radius: 0.5rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        background-color: #F9FAFB;
    }
    .dropzone:hover {
        border-color: #3B82F6;
        background-color: #EFF6FF;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto py-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Add New Hotel</h1>
            <p class="text-gray-600 mt-1">Provide the details for your new hotel</p>
        </div>
        <a href="{{ route('hotels.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to All Hotels
        </a>
    </div>

    <!-- Hotel Form -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <!-- Basic Information -->
                    <h2 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Basic Information</h2>

                    <div class="form-group">
                        <label for="name" class="form-label">Hotel Name <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description <span class="text-red-500">*</span></label>
                        <textarea id="description" name="description" rows="6" class="form-input" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Address <span class="text-red-500">*</span></label>
                        <input type="text" id="address" name="address" class="form-input" value="{{ old('address') }}" required>
                        @error('address')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="city" class="form-label">City <span class="text-red-500">*</span></label>
                        <input type="text" id="city" name="city" class="form-input" value="{{ old('city') }}" required>
                        @error('city')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="country" class="form-label">Country <span class="text-red-500">*</span></label>
                        <input type="text" id="country" name="country" class="form-input" value="{{ old('country') }}" required>
                        @error('country')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <!-- Hotel Details -->
                    <h2 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Hotel Details</h2>

                    <div class="form-group">
                        <label for="stars" class="form-label">Stars <span class="text-red-500">*</span></label>
                        <select id="stars" name="stars" class="form-input" required>
                            <option value="5" {{ old('stars') == 5 ? 'selected' : '' }}>5 Stars</option>
                            <option value="4" {{ old('stars') == 4 ? 'selected' : '' }}>4 Stars</option>
                            <option value="3" {{ old('stars') == 3 ? 'selected' : '' }}>3 Stars</option>
                            <option value="2" {{ old('stars') == 2 ? 'selected' : '' }}>2 Stars</option>
                            <option value="1" {{ old('stars') == 1 ? 'selected' : '' }}>1 Star</option>
                        </select>
                        @error('stars')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="amenities" class="form-label">Amenities <span class="text-red-500">*</span></label>
                        <textarea id="amenities" name="amenities" rows="4" class="form-input" placeholder="Comma-separated values, e.g., Free WiFi, Pool, Gym" required>{{ old('amenities') }}</textarea>
                        @error('amenities')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Hotel Image</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50 text-center">
                            <div class="flex flex-col items-center space-y-2">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                <p class="text-gray-500">Drag and drop an image here or</p>
                                <label class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                    Browse
                                    <input type="file" id="image" name="image" accept="image/*" class="hidden">
                                </label>
                            </div>
                        </div>
                        @error('image')
                            <div class="form-error mt-2">{{ $message }}</div>
                        @enderror
                        <div class="text-sm text-gray-500 mt-2">Upload a high-quality image of the hotel</div>
                    
                        <!-- Preview Section -->
                        <div id="image-preview-container" class="mt-4 hidden">
                            <img id="image-preview" src="#" alt="Image Preview" class="rounded-lg shadow-md w-full h-40 object-cover">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3 mt-8 pt-5 border-t">
                <button type="reset" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Reset
                </button>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                    Add Hotel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const fileInput = document.getElementById('image');
    const previewContainer = document.getElementById('image-preview-container');
    const imagePreview = document.getElementById('image-preview');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                imagePreview.src = event.target.result;
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush



