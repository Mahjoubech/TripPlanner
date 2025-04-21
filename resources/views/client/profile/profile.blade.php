{{-- @extends('layouts.app')

@section('title', 'Update Profile')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="container mx-auto py-6 px-4">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('client.dashboard') }}" class="rounded-md p-2 text-gray-500 hover:bg-gray-100">
                    <i class="fas fa-arrow-left h-5 w-5"></i>
                </a>
                <h1 class="text-2xl font-bold">Update Profile</h1>
            </div>
            <button type="submit" form="profile-form" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Save Changes
            </button>
        </div>

        <!-- Profile Update Form with Card Structure -->
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-6 space-y-6">
                        <!-- Card Structure for Profile -->
                        <div class="mt-3">
                            <div class="card bg-white rounded-lg shadow-sm">
                                <div class="px-3 pt-4 pb-2">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="relative">
                                                <div class="h-32 w-32 rounded-full overflow-hidden bg-gray-200 me-3">
                                                    <img id="profile-image-preview" 
                                                         src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}" 
                                                         alt="profile image" 
                                                         class="h-full w-full object-cover">
                                                </div>
                                                <label for="profile-image" class="absolute bottom-0 right-0 h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center cursor-pointer">
                                                    <i class="fas fa-camera"></i>
                                                </label>
                                                <input type="file" id="profile-image" name="profile_image" class="hidden" accept="image/*">
                                            </div>
                                            <div>
                                                <h3 class="text-xl font-bold mb-0">{{ auth()->user()->name }}</h3>
                                                <span class="text-sm text-gray-500">{{ auth()->user()->email }}</span><br>
                                                <span class="text-sm text-gray-500">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                                    {{ auth()->user()->location ?? 'Add your location' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-2 mt-4">
                                        <h5 class="text-lg font-medium"> About: </h5>
                                        <textarea id="about" name="about" rows="3" class="w-full rounded-md border border-gray-300 py-2 px-3 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 mt-2">{{ auth()->user()->about ?? auth()->user()->bio ?? '' }}</textarea>
                                        
                                        <div class="flex justify-start mt-4">
                                            <a href="#" class="font-light text-gray-600 text-sm mr-3"> 
                                                <span class="fas fa-user mr-1"></span> 
                                                {{ auth()->user()->followers()->count() ?? 0 }} Followers
                                            </a>
                                            <a href="#" class="font-light text-gray-600 text-sm mr-3"> 
                                                <span class="fas fa-brain mr-1"></span> 
                                                {{ auth()->user()->question()->count() ?? 0 }} Questions
                                            </a>
                                            <a href="#" class="font-light text-gray-600 text-sm"> 
                                                <span class="fas fa-comment mr-1"></span> 
                                                {{ auth()->user()->reponses()->count() ?? 0 }} Responses
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Personal Information -->
                        <div class="space-y-4 mt-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" class="w-full rounded-md border border-gray-300 py-2 px-3 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="w-full rounded-md border border-gray-300 py-2 px-3 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone ?? '' }}" class="w-full rounded-md border border-gray-300 py-2 px-3 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                    <input type="text" id="location" name="location" value="{{ auth()->user()->location ?? '' }}" class="w-full rounded-md border border-gray-300 py-2 px-3 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-6 py-4 flex justify-end rounded-b-lg">
                        <div class="flex gap-2">
                            <a href="{{ route('client.dashboard') }}" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Cancel
                            </a>
                            <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('profile-image').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('profile-image-preview').src = event.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection --}}