@extends('layouts.organizer')

@section('title', 'Edit Transport')

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
</style>
@endpush

@section('content')
<div class="container mx-auto py-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Transport</h1>
            <p class="text-gray-600 mt-1">Update the details for your transport</p>
        </div>
        <a href="{{ route('transport.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to All Transports
        </a>
    </div>

    <!-- Transport Form -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('transport.update', $transport->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <!-- Basic Information -->
                    <h2 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Basic Information</h2>

                    <div class="form-group">
                        <label for="type" class="form-label">Transport Type <span class="text-red-500">*</span></label>
                        <input type="text" id="type" name="type" class="form-input" value="{{ old('type', $transport->type) }}" required>
                        @error('type')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="company" class="form-label">Company <span class="text-red-500">*</span></label>
                        <input type="text" id="company" name="company" class="form-input" value="{{ old('company', $transport->company) }}" required>
                        @error('company')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="details" class="form-label">Details</label>
                        <textarea id="details" name="details" rows="6" class="form-input">{{ old('details', $transport->details) }}</textarea>
                        @error('details')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <!-- Transport Details -->
                    <h2 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Transport Details</h2>

                    <div class="form-group">
                        <label for="capacity" class="form-label">Capacity <span class="text-red-500">*</span></label>
                        <input type="number" id="capacity" name="capacity" class="form-input" value="{{ old('capacity', $transport->capacity) }}" required>
                        @error('capacity')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="features" class="form-label">Features (comma-separated)</label>
                        <textarea id="features" name="features" rows="4" class="form-input" placeholder="e.g., WiFi, Air Conditioning, Reclining Seats">{{ old('features', is_array($transport->features) ? implode(', ', $transport->features) : '') }}</textarea>
                        @error('features')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Transport Image</label>
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
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                        <div class="text-sm text-gray-500 mt-2">Leave blank to keep the current image</div>
                        
                        <!-- Preview Section -->
                        <div id="image-preview-container" class="mt-4">
                            <img id="image-preview" src="{{ $transport->image ? asset('storage/' . $transport->image) : '/api/placeholder/150/150' }}" 
                                 alt="Image Preview" class="rounded-lg shadow-md w-full h-40 object-cover">
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
                    Update Transport
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