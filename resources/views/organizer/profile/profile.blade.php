@extends('layouts.organizer')

@section('title', 'Update Profile')


@push('styles')
<style>
    .form-group {
        margin-bottom: 1.25rem;
    }
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #1F2937;
    }
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #E5E7EB;
        border-radius: 0.5rem;
        background-color: #F3F4F6;
        font-size: 0.875rem;
    }
    .form-input:focus {
        outline: none;
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
    }
    .avatar-upload {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 2rem;
    }
    .avatar-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #E5E7EB;
        margin-bottom: 1rem;
    }
    .avatar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .avatar-edit label {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: #2563EB;
        border-radius: 50%;
        cursor: pointer;
        color: white;
        font-size: 1rem;
        transition: background 0.3s ease;
    }
    .avatar-edit label:hover {
        background: #1D4ED8;
    }
    .avatar-edit input {
        display: none;
    }
    .section-header {
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #E5E7EB;
        padding-bottom: 0.5rem;
    }
    .section-header h2 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1F2937;
    }
    .btn-primary {
        background-color: #2563EB;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        transition: background 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #1D4ED8;
    }
    .btn-secondary {
        background-color: #F3F4F6;
        color: #1F2937;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        border: 1px solid #E5E7EB;
        transition: background 0.3s ease;
    }
    .btn-secondary:hover {
        background-color: #E5E7EB;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto py-8">
    <!-- Page Header -->
    <div class="section-header">
        <h2>Update Profile</h2>
        <p class="text-sm text-gray-500">Manage your personal information and account settings</p>
    </div>

    <!-- Profile Form -->
    <div class="bg-white rounded-lg shadow p-6">
        @if (session('status'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded">
            <p class="text-sm">{{ session('status') }}</p>
        </div>
        @endif

        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
            <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
            <ul class="mt-2 text-sm list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="avatar-upload">
                <div class="avatar-preview">
                    <img id="avatar-preview-image" src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}" alt="Avatar Preview">
                </div>
                <div class="avatar-edit">
                    <input type="file" id="avatar" name="avatar" accept="image/*" />
                    <label for="avatar">
                        <i class="fas fa-camera"></i>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="name" class="form-label">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', Auth::user()->name) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" value="{{ Auth::user()->email }}" class="form-input bg-gray-100" disabled>
                    <div class="text-sm text-gray-500 mt-1">Email cannot be changed</div>
                </div>
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Phone Number <span class="text-red-500">*</span></label>
                <input type="tel" id="phone" name="phone" class="form-input" value="{{ old('phone', Auth::user()->phone) }}" required>
            </div>

            <div class="form-group">
                <label for="bio" class="form-label">Bio</label>
                <textarea id="bio" name="bio" rows="5" class="form-input" placeholder="Tell us a little about yourself...">{{ old('bio', Auth::user()->bio) }}</textarea>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('organizer.dashboard') }}" class="btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Password Update Section -->
    <div class="bg-white rounded-lg shadow mt-8 p-6">
        <div class="section-header">
            <h2>Change Password</h2>
            <p class="text-sm text-gray-500">Ensure your account is using a strong password for security</p>
        </div>

        <form action="{{ route('profile.password') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password <span class="text-red-500">*</span></label>
                    <input type="password" id="current_password" name="current_password" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="new_password" class="form-label">New Password <span class="text-red-500">*</span></label>
                    <input type="password" id="new_password" name="new_password" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password <span class="text-red-500">*</span></label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-input" required>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="btn-primary">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Avatar preview functionality
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('avatar-preview-image').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush