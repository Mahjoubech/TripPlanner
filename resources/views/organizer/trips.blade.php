@extends('layouts.organizer')

@section('title', 'Create New Trip')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white">Create New Trip</h1>
        <p class="mt-1 text-sm text-gray-400">Create a new trip package with activities, hotels, and transport</p>
    </div>

    <form action="{{ route('organizer.trips.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6 space-y-4">
            <h2 class="text-lg font-semibold text-white">Basic Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Trip Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="mt-1 w-full rounded-lg border border-gray-700 bg-gray-800 px-4 py-2 text-white focus:border-white focus:ring-white" 
                           placeholder="Enter trip name"
                           required>
                </div>

                <!-- Trip Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-300">Trip Type</label>
                    <select id="type" 
                            name="type" 
                            class="mt-1 w-full rounded-lg border border-gray-700 bg-gray-800 px-4 py-2 text-white focus:border-white focus:ring-white">
                        <option value="adventure">Adventure</option>
                        <option value="cultural">Cultural</option>
                        <option value="relaxation">Relaxation</option>
                        <option value="family">Family</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Start Date -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-300">Start Date</label>
                    <input type="date" 
                           id="start_date" 
                           name="start_date" 
                           class="mt-1 w-full rounded-lg border border-gray-700 bg-gray-800 px-4 py-2 text-white focus:border-white focus:ring-white"
                           required>
                </div>

                <!-- End Date -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-300">End Date</label>
                    <input type="date" 
                           id="end_date" 
                           name="end_date" 
                           class="mt-1 w-full rounded-lg border border-gray-700 bg-gray-800 px-4 py-2 text-white focus:border-white focus:ring-white"
                           required>
                </div>

                <!-- Group Size -->
                <div>
                    <label for="max_participants" class="block text-sm font-medium text-gray-300">Max Participants</label>
                    <input type="number" 
                           id="max_participants" 
                           name="max_participants" 
                           class="mt-1 w-full rounded-lg border border-gray-700 bg-gray-800 px-4 py-2 text-white focus:border-white focus:ring-white"
                           min="1" 
                           required>
                </div>
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-300">Price per Person (USD)</label>
                <input type="number" 
                       id="price" 
                       name="price" 
                       class="mt-1 w-full rounded-lg border border-gray-700 bg-gray-800 px-4 py-2 text-white focus:border-white focus:ring-white"
                       min="0" 
                       step="0.01" 
                       required>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                <textarea id="description" 
                          name="description" 
                          rows="4" 
                          class="mt-1 w-full rounded-lg border border-gray-700 bg-gray-800 px-4 py-2 text-white focus:border-white focus:ring-white"
                          placeholder="Describe your trip package"
                          required></textarea>
            </div>
        </div>

        <!-- Hotel Selection -->
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6 space-y-4">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-white">Hotels</h2>
                <button type="button" 
                        x-data 
                        @click="$dispatch('open-modal', 'add-hotel')"
                        class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700">
                    Add Hotel
                </button>
            </div>

            <div class="border border-gray-800 rounded-lg divide-y divide-gray-800" id="selected-hotels">
                <!-- Selected hotels will be added here dynamically -->
            </div>
        </div>

        <!-- Activities Selection -->
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6 space-y-4">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-white">Activities</h2>
                <button type="button" 
                        x-data 
                        @click="$dispatch('open-modal', 'add-activity')"
                        class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700">
                    Add Activity
                </button>
            </div>

            <div class="border border-gray-800 rounded-lg divide-y divide-gray-800" id="selected-activities">
                <!-- Selected activities will be added here dynamically -->
            </div>
        </div>

        <!-- Transport Selection -->
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6 space-y-4">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-white">Transport</h2>
                <button type="button" 
                        x-data 
                        @click="$dispatch('open-modal', 'add-transport')"
                        class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700">
                    Add Transport
                </button>
            </div>

            <div class="border border-gray-800 rounded-lg divide-y divide-gray-800" id="selected-transport">
                <!-- Selected transport options will be added here dynamically -->
            </div>
        </div>

        <!-- Trip Images -->
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6 space-y-4">
            <h2 class="text-lg font-semibold text-white">Trip Images</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="image-preview">
                <label class="flex flex-col items-center justify-center h-40 border-2 border-dashed border-gray-700 rounded-lg cursor-pointer hover:border-white">
                    <div class="flex flex-col items-center justify-center pt-7">
                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500">Click to upload</p>
                    </div>
                    <input type="file" 
                           name="images[]" 
                           class="hidden" 
                           accept="image/*" 
                           multiple 
                           @change="handleImageUpload($event)">
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" 
                    class="px-6 py-3 text-sm font-medium text-white bg-white/10 rounded-lg hover:bg-white/20">
                Create Trip
            </button>
        </div>
    </form>
</div>

<!-- Modals -->
<div x-data="modals" @keydown.escape.window="closeAllModals()">
    <!-- Hotel Selection Modal -->
    <template x-teleport="body">
        <div x-show="isModalOpen('add-hotel')" 
             class="fixed inset-0 z-50 overflow-y-auto" 
             aria-labelledby="modal-title" 
             role="dialog" 
             aria-modal="true">
            <!-- Modal content -->
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-black/75 transition-opacity" 
                     aria-hidden="true"
                     @click="closeModal('add-hotel')"></div>

                <!-- Modal panel -->
                <div class="relative inline-block align-bottom bg-gray-900 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium leading-6 text-white" id="modal-title">
                            Select Hotels
                        </h3>
                        <div class="mt-4 space-y-4">
                            <!-- Hotel search and list will be populated here -->
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-800">
                        <button type="button" 
                                class="w-full inline-flex justify-center rounded-lg border border-transparent px-4 py-2 bg-white/10 text-base font-medium text-white hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white sm:ml-3 sm:w-auto sm:text-sm"
                                @click="closeModal('add-hotel')">
                            Add Selected
                        </button>
                        <button type="button" 
                                class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-800 px-4 py-2 bg-gray-900 text-base font-medium text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                @click="closeModal('add-hotel')">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Similar modals for Activities and Transport -->
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('modals', () => ({
        openModals: new Set(),
        
        isModalOpen(name) {
            return this.openModals.has(name);
        },
        
        openModal(name) {
            this.openModals.add(name);
        },
        
        closeModal(name) {
            this.openModals.delete(name);
        },
        
        closeAllModals() {
            this.openModals.clear();
        }
    }));
});

function handleImageUpload(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('image-preview');
    
    // Process each selected file
    for (const file of files) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.createElement('div');
                preview.className = 'relative';
                preview.innerHTML = `
                    <img src="${e.target.result}" class="h-40 w-full object-cover rounded-lg">
                    <button type="button" 
                            class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full hover:bg-red-600"
                            onclick="this.parentElement.remove()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                `;
                previewContainer.insertBefore(preview, previewContainer.firstChild);
            };
            reader.readAsDataURL(file);
        }
    }
}
</script>
@endpush