@extends('layouts.organizer')

@section('title', 'Add New Trip')
@include('shared.toast')

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
        transition: all 0.3s ease;
    }
    .dropzone:hover {
        border-color: #3B82F6;
        background-color: #EFF6FF;
    }
    .scrollable-container {
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #D1D5DB;
        border-radius: 0.375rem;
        padding: 0.5rem;
        background-color: #F9FAFB;
    }
    
    /* New styles for transport gallery */
    .transport-gallery {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 1rem;
        padding: 1rem 0;
        scrollbar-width: thin;
        scrollbar-color: #D1D5DB #F3F4F6;
    }
    .transport-gallery::-webkit-scrollbar {
        height: 6px;
    }
    .transport-gallery::-webkit-scrollbar-track {
        background: #F3F4F6;
        border-radius: 20px;
    }
    .transport-gallery::-webkit-scrollbar-thumb {
        background-color: #D1D5DB;
        border-radius: 20px;
    }
    .transport-item {
        flex: 0 0 auto;
        width: 120px;
        text-align: center;
        cursor: pointer;
        transition: transform 0.2s;
        padding: 0.5rem;
        border-radius: 0.5rem;
    }
    .transport-item:hover {
        transform: translateY(-5px);
    }
    .transport-item.selected {
        background-color: #EFF6FF;
        border: 2px solid #3B82F6;
    }
    .transport-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 0.5rem;
        margin: 0 auto 0.5rem;
        display: block;
    }
    .transport-name {
        font-size: 0.875rem;
        color: #374151;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    /* Multi-select styles */
    .multi-select-container {
        position: relative;
    }
    .multi-select-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 0.75rem;
        border: 1px solid #D1D5DB;
        border-radius: 0.375rem;
        background-color: #F9FAFB;
        cursor: pointer;
    }
    .multi-select-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 10;
        max-height: 200px;
        overflow-y: auto;
        background-color: white;
        border: 1px solid #D1D5DB;
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: none;
    }
    .multi-select-dropdown.active {
        display: block;
    }
    .multi-select-item {
        padding: 0.5rem 0.75rem;
        cursor: pointer;
    }
    .multi-select-item:hover {
        background-color: #EFF6FF;
    }
    .multi-select-item.selected {
        background-color: #DBEAFE;
    }
    .multi-select-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    .multi-select-tag {
        display: inline-flex;
        align-items: center;
        background-color: #DBEAFE;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
    }
    .multi-select-tag-remove {
        margin-left: 0.25rem;
        cursor: pointer;
    }
    
    /* Calendar styles */
    .date-picker-container {
        position: relative;
    }
    .date-picker-input {
        padding-right: 2.5rem;
        cursor: pointer;
    }
    .date-picker-icon {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6B7280;
        pointer-events: none;
    }
    .date-picker-calendar {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 20;
        background-color: white;
        border: 1px solid #D1D5DB;
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 1rem;
        width: 300px;
        display: none;
    }
    .date-picker-calendar.active {
        display: block;
    }
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    .calendar-nav {
        cursor: pointer;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
    }
    .calendar-nav:hover {
        background-color: #F3F4F6;
    }
    .calendar-month-year {
        font-weight: 500;
    }
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0.25rem;
    }
    .calendar-day-header {
        text-align: center;
        font-size: 0.75rem;
        color: #6B7280;
        padding: 0.25rem;
    }
    .calendar-day {
        aspect-ratio: 1/1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        cursor: pointer;
        border-radius: 0.25rem;
    }
    .calendar-day:hover {
        background-color: #EFF6FF;
    }
    .calendar-day.current {
        background-color: #3B82F6;
        color: white;
    }
    .calendar-day.selected {
        background-color: #DBEAFE;
        color: #1E40AF;
        font-weight: 500;
    }
    .calendar-day.disabled {
        color: #D1D5DB;
        cursor: not-allowed;
    }
    .calendar-day.out-of-month {
        visibility: hidden;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto py-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Add New Trip</h1>
            <p class="text-gray-600 mt-1">Create a new trip package for your customers</p>
        </div>
        <a href="{{ route('trips.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to All Trips
        </a>
    </div>

    <!-- Trip Form -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data" id="tripForm">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <!-- Basic Information -->
                    <h2 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Basic Information</h2>
                    
                    <div class="form-group">
                        <label for="title" class="form-label">Trip Title <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-input @error('title') border-red-500 @enderror" required>
                        @error('title')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">Description <span class="text-red-500">*</span></label>
                        <textarea id="description" name="description" rows="6" class="form-input @error('description') border-red-500 @enderror" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="location" class="form-label">Location <span class="text-red-500">*</span></label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" class="form-input @error('location') border-red-500 @enderror" required>
                        @error('location')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <!-- Trip Details -->
                    <h2 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Trip Details</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="start_date_display" class="form-label">Start Date <span class="text-red-500">*</span></label>
                            <div class="date-picker-container">
                                <input type="text" id="start_date_display" class="form-input date-picker-input @error('start_date') border-red-500 @enderror" placeholder="Select start date" readonly>
                                <input type="hidden" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                <div class="date-picker-icon">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="date-picker-calendar" id="start-date-calendar"></div>
                                @error('start_date')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="end_date_display" class="form-label">End Date <span class="text-red-500">*</span></label>
                            <div class="date-picker-container">
                                <input type="text" id="end_date_display" class="form-input date-picker-input @error('end_date') border-red-500 @enderror" placeholder="Select end date" readonly>
                                <input type="hidden" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                <div class="date-picker-icon">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="date-picker-calendar" id="end-date-calendar"></div>
                                @error('end_date')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="duration" class="form-label">Duration (days)</label>
                        <input type="number" id="duration" name="duration" value="{{ old('duration') }}" class="form-input" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="price" class="form-label">Price <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" min="0" step="0.01" value="{{ old('price') }}" class="form-input @error('price') border-red-500 @enderror" required>
                        @error('price')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="maxmax_participants" class="form-label">Max Participants <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="max_participants" min="0" step="0.01" value="{{ old('max_participants') }}" class="form-input @error('max_participants') border-red-500 @enderror" required>
                        @error('max_participants')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Trip Options -->
            <div class="mt-6">
                <h2 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Trip Options</h2>
                
                <!-- Hotels - Enhanced Multiple Select -->
                <div class="form-group">
                    <label class="form-label">Select Hotels</label>
                    <div class="multi-select-container" id="hotelsMultiSelect">
                        <div class="multi-select-header">
                            <span class="multi-select-placeholder">Select hotels...</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="multi-select-dropdown" id="hotelsDropdown">
                            <div class="p-2">
                                <input type="text" class="form-input" placeholder="Search hotels..." id="hotelsSearch">
                            </div>
                            @foreach ($hotels as $hotel)
                                <div class="multi-select-item" data-value="{{ $hotel->id }}" data-label="{{ $hotel->name }}">
                                    <input type="checkbox" id="hotel_{{ $hotel->id }}" name="hotels[]" value="{{ $hotel->id }}" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" {{ in_array($hotel->id, old('hotels', [])) ? 'checked' : '' }} hidden>
                                    <label for="hotel_{{ $hotel->id }}" class="ml-2 text-gray-700">{{ $hotel->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="multi-select-tags" id="hotelsTags"></div>
                    </div>
                    @error('hotels')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Activities - Enhanced Multiple Select -->
                <div class="form-group mt-4">
                    <label class="form-label">Select Activities</label>
                    <div class="multi-select-container" id="activitiesMultiSelect">
                        <div class="multi-select-header">
                            <span class="multi-select-placeholder">Select activities...</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="multi-select-dropdown" id="activitiesDropdown">
                            <div class="p-2">
                                <input type="text" class="form-input" placeholder="Search activities..." id="activitiesSearch">
                            </div>
                            @foreach ($activities as $activity)
                                <div class="multi-select-item" data-value="{{ $activity->id }}" data-label="{{ $activity->name }}">
                                    <input type="checkbox" id="activity_{{ $activity->id }}" name="activities[]" value="{{ $activity->id }}" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" {{ in_array($activity->id, old('activities', [])) ? 'checked' : '' }} hidden>
                                    <label for="activity_{{ $activity->id }}" class="ml-2 text-gray-700">{{ $activity->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="multi-select-tags" id="activitiesTags"></div>
                    </div>
                    @error('activities')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Transport - Enhanced Gallery View -->
                <div class="form-group mt-4">
                    <label class="form-label">Select Transport</label>
                    <div class="transport-gallery" id="transportGallery">
                        @foreach ($transports as $transport)
                            <div class="transport-item" data-transport-id="{{ $transport->id }}">
                                <input type="radio" id="transport_{{ $transport->id }}" name="transport" value="{{ $transport->id }}" class="hidden" {{ old('transport') == $transport->id ? 'checked' : '' }}>
                                <img src="{{ asset('storage/'.$transport->image) }}" class="transport-image" alt="{{ $transport->type }}">
                                <div class="transport-name">{{ $transport->type }}</div>
                            </div>
                        @endforeach
                    </div>
                    @error('transport')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Trip Image -->
            <div class="mt-6">
                <h2 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Trip Image</h2>
                
                <div class="form-group">
                    <label for="image" class="form-label">Featured Image</label>
                    <div class="dropzone" id="imageDropzone">
                        <div class="text-center">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-600">Drag and drop an image here or click to browse</p>
                        </div>
                        <input type="file" id="image" name="image" accept="image/*" class="hidden @error('image') border-red-500 @enderror">
                    </div>
                    <div id="preview-container" class="hidden mt-4">
                        <img id="image-preview" class="w-32 h-32 object-cover rounded-md" alt="Image Preview">
                        <button type="button" id="remove-image" class="mt-2 text-red-500 hover:underline">Remove</button>
                    </div>
                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3 mt-8 pt-5 border-t">
                <button type="button" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Save as Draft
                </button>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                    Create Trip
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from title
document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slug = title.toLowerCase()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');
    document.getElementById('slug').value = slug;
});

// Format date as YYYY-MM-DD for hidden input
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

// Format date as Month DD, YYYY for display
function formatDisplayDate(date) {
    return date.toLocaleDateString('en-US', {
        month: 'long',
        day: 'numeric',
        year: 'numeric'
    });
}

// Calculate duration automatically
function updateDuration() {
    const startDate = document.getElementById('start_date').value;
    const endDate = document.getElementById('end_date').value;
    
    if (startDate && endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        
        if (start <= end) {
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            document.getElementById('duration').value = diffDays;
        }
    }
}

// Image preview handling
function setupImageUpload() {
    const imageDropzone = document.getElementById('imageDropzone');
    const fileInput = document.getElementById('image');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const removeButton = document.getElementById('remove-image');
    
    imageDropzone.addEventListener('click', () => {
        fileInput.click();
    });
    
    imageDropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageDropzone.classList.add('border-blue-500', 'bg-blue-50');
    });
    
    imageDropzone.addEventListener('dragleave', () => {
        imageDropzone.classList.remove('border-blue-500', 'bg-blue-50');
    });
    
    imageDropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        imageDropzone.classList.remove('border-blue-500', 'bg-blue-50');
        
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            updatePreview();
        }
    });
    
    fileInput.addEventListener('change', updatePreview);
    
    function updatePreview() {
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
                imageDropzone.classList.add('hidden');
            };
            
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    
    removeButton.addEventListener('click', () => {
        fileInput.value = '';
        previewContainer.classList.add('hidden');
        imageDropzone.classList.remove('hidden');
    });
}

// Transport Gallery Selection
function setupTransportGallery() {
    const transportItems = document.querySelectorAll('.transport-item');
    
    transportItems.forEach(item => {
        const radio = item.querySelector('input[type="radio"]');
        
        // Initialize selected state
        if (radio.checked) {
            item.classList.add('selected');
        }
        
        item.addEventListener('click', () => {
            // Remove selected class from all items
            transportItems.forEach(i => i.classList.remove('selected'));
            
            // Add selected class to clicked item
            item.classList.add('selected');
            
            // Check the radio button
            radio.checked = true;
        });
    });
}

// Function to setup multi-select dropdown
function setupMultiSelect(containerId, itemType) {
    const container = document.getElementById(containerId);
    const header = container.querySelector('.multi-select-header');
    const dropdown = container.querySelector('.multi-select-dropdown');
    const items = dropdown.querySelectorAll('.multi-select-item');
    const tagsContainer = container.querySelector('.multi-select-tags');
    const placeholder = header.querySelector('.multi-select-placeholder');
    const searchInput = dropdown.querySelector('input[type="text"]');
    
    // Toggle dropdown
    header.addEventListener('click', () => {
        dropdown.classList.toggle('active');
        if (dropdown.classList.contains('active')) {
            searchInput.focus();
        }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!container.contains(e.target)) {
            dropdown.classList.remove('active');
        }
    });
    
    // Search functionality
    searchInput.addEventListener('input', () => {
        const searchValue = searchInput.value.toLowerCase();
        
        items.forEach(item => {
            const label = item.getAttribute('data-label').toLowerCase();
            if (label.includes(searchValue)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
    
    // Item selection
    items.forEach(item => {
        const checkbox = item.querySelector('input[type="checkbox"]');
        const value = item.getAttribute('data-value');
        const label = item.getAttribute('data-label');
        
        // Initialize selected state and tags
        if (checkbox.checked) {
            item.classList.add('selected');
            addTag(value, label);
        }
        
        item.addEventListener('click', () => {
            checkbox.checked = !checkbox.checked;
            
            if (checkbox.checked) {
                item.classList.add('selected');
                addTag(value, label);
            } else {
                item.classList.remove('selected');
                removeTag(value);
            }
            
            updatePlaceholder();
        });
    });
    
    // Function to add a tag
    function addTag(value, label) {
        const tag = document.createElement('div');
        tag.classList.add('multi-select-tag');
        tag.setAttribute('data-value', value);
        tag.innerHTML = `
            ${label}
            <span class="multi-select-tag-remove" data-value="${value}">&times;</span>
        `;
        tagsContainer.appendChild(tag);
        
        // Add event listener to remove tag
        const removeBtn = tag.querySelector('.multi-select-tag-remove');
        removeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            removeTag(value);
            
            // Uncheck the checkbox
            const checkbox = Array.from(items).find(item => item.getAttribute('data-value') === value).querySelector('input[type="checkbox"]');
            checkbox.checked = false;
            
            // Remove selected class
            Array.from(items).find(item => item.getAttribute('data-value') === value).classList.remove('selected');
            
            updatePlaceholder();
        });
    }
    
    // Function to remove a tag
    function removeTag(value) {
        const tag = tagsContainer.querySelector(`.multi-select-tag[data-value="${value}"]`);
        if (tag) {
            tagsContainer.removeChild(tag);
        }
    }
    
    // Function to update placeholder text
    function updatePlaceholder() {
        const selectedCount = tagsContainer.querySelectorAll('.multi-select-tag').length;
        
        if (selectedCount === 0) {
            placeholder.textContent = `Select ${itemType}...`;
        } else {
            placeholder.textContent = `${selectedCount} ${itemType} selected`;
        }
    }
    
    // Initial placeholder update
    updatePlaceholder();
}

// Function to setup date picker
function setupDatePicker(displayId, hiddenId, calendarId, isStartDate) {
    const displayInput = document.getElementById(displayId);
    const hiddenInput = document.getElementById(hiddenId);
    const calendar = document.getElementById(calendarId);
    
    // Create calendar instance
    let currentDate = new Date();
    let selectedDate = hiddenInput.value ? new Date(hiddenInput.value) : null;
    
    // If it's start date and no date is selected, set today as default
    if (isStartDate && !selectedDate) {
        selectedDate = new Date();
        hiddenInput.value = formatDate(selectedDate);
        displayInput.value = formatDisplayDate(selectedDate);
    }
    
    // Toggle calendar
    displayInput.addEventListener('click', () => {
        calendar.classList.toggle('active');
        
        if (calendar.classList.contains('active')) {
            renderCalendar();
        }
    });
    
    // Close calendar when clicking outside
    document.addEventListener('click', (e) => {
        if (!displayInput.contains(e.target) && !calendar.contains(e.target)) {
            calendar.classList.remove('active');
        }
    });
    
    // Function to render calendar
    function renderCalendar() {
        // Clear existing calendar
        calendar.innerHTML = '';
        
        // Get current month and year
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        
        // Create calendar header
        const header = document.createElement('div');
        header.classList.add('calendar-header');
        
        const prevBtn = document.createElement('div');
        prevBtn.classList.add('calendar-nav');
        prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
        prevBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });
        
        const monthYearText = document.createElement('div');
        monthYearText.classList.add('calendar-month-year');
        monthYearText.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;
        
        const nextBtn = document.createElement('div');
        nextBtn.classList.add('calendar-nav');
        nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
        nextBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });
        
        header.appendChild(prevBtn);
        header.appendChild(monthYearText);
        header.appendChild(nextBtn);
        
        calendar.appendChild(header);
        
        // Create weekday headers
        const weekdays = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
        const daysGrid = document.createElement('div');
        daysGrid.classList.add('calendar-grid');
        
        weekdays.forEach(day => {
            const dayHeader = document.createElement('div');
            dayHeader.classList.add('calendar-day-header');
            dayHeader.textContent = day;
            daysGrid.appendChild(dayHeader);
        });
        
        // Calculate first day of the month
        const firstDay = new Date(year, month, 1);
        const startingDay = firstDay.getDay(); // 0 = Sunday, 1 = Monday, etc.
        
        // Calculate how many days in the month
        const lastDay = new Date(year, month + 1, 0);
        const totalDays = lastDay.getDate();
        
        // Create empty cells for days before the first of the month
        for (let i = 0; i < startingDay; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.classList.add('calendar-day', 'out-of-month');
            daysGrid.appendChild(emptyDay);
        }
        
        // Create days of the month
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        const minDate = isStartDate ? today : new Date(document.getElementById('start_date').value);
        minDate.setHours(0, 0, 0, 0);
        
        for (let day = 1; day <= totalDays; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('calendar-day');
            dayCell.textContent = day;
            
            const currentCellDate = new Date(year, month, day);
            currentCellDate.setHours(0, 0, 0, 0);
            
            // Check if the day is today
            if (currentCellDate.getTime() === today.getTime()) {
                dayCell.classList.add('current');
            }
            
            // Check if the day is selected
            if (selectedDate && currentCellDate.getTime() === selectedDate.getTime()) {
                dayCell.classList.add('selected');
            }
            
            // Check if the day is before minimum allowed date
            if (currentCellDate < minDate) {
                dayCell.classList.add('disabled');
            } else {
                dayCell.addEventListener('click', () => {
                    selectedDate = new Date(year, month, day);
                    hiddenInput.value = formatDate(selectedDate);
                    displayInput.value = formatDisplayDate(selectedDate);
                    calendar.classList.remove('active');
                    
                    // If this is the start date, update the minimum date for end date
                    if (isStartDate) {
                        const endDateDisplay = document.getElementById('end_date_display');
                        const endDate = document.getElementById('end_date');
                        
                        // If end date is before start date, reset it
                        if (endDate.value && new Date(endDate.value) < selectedDate) {
                            endDate.value = '';
                            endDateDisplay.value = '';
                        }
                    }
                    
                    // Update duration
                    updateDuration();
                });
            }
            
            daysGrid.appendChild(dayCell);
        }
        
        calendar.appendChild(daysGrid);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    setupImageUpload();
    
    setupTransportGallery();
    
    setupMultiSelect('hotelsMultiSelect', 'hotels');
    
    setupMultiSelect('activitiesMultiSelect', 'activities');
    
    setupDatePicker('start_date_display', 'start_date', 'start-date-calendar', true);
    setupDatePicker('end_date_display', 'end_date', 'end-date-calendar', false);
    
    const today = new Date();
    const formattedToday = formatDate(today);
    document.getElementById('start_date').value = formattedToday;
    document.getElementById('start_date_display').value = formatDisplayDate(today);
    
    const tripForm = document.getElementById('tripForm');
    if (tripForm) {
        tripForm.addEventListener('submit', function(event) {
            const requiredFields = ['title', 'slug', 'description', 'location', 'start_date', 'end_date', 'price'];
            let isValid = true;
            
            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                } else {
                    input.classList.remove('border-red-500');
                }
            });
            
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);
            
            if (endDate < startDate) {
                isValid = false;
                document.getElementById('end_date_display').classList.add('border-red-500');
                alert('End date must be after start date');
            } else {
                document.getElementById('end_date_display').classList.remove('border-red-500');
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });
    }
    
    const draftButton = document.querySelector('button[type="button"]');
    if (draftButton) {
        draftButton.addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status';
            input.value = 'draft';
            tripForm.appendChild(input);
            tripForm.submit();
        });
    }
    
    updateDuration();
});
</script>
@endpush