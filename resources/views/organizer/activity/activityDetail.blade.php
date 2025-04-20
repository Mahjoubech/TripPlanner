@extends('layouts.organizer')

@section('title', 'Activity Details')

@push('styles')
<style>
    .activity-card {
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .activity-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.1);
    }
    
    .detail-section {
        padding: 1.5rem;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .detail-section:last-child {
        border-bottom: none;
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }
    
    .section-title i {
        margin-right: 0.75rem;
        color: #4299e1;
    }
    
    .detail-row {
        display: flex;
        margin-bottom: 1rem;
        align-items: flex-start;
    }
    
    .detail-label {
        font-weight: 600;
        color: #4a5568;
        min-width: 140px;
    }
    
    .detail-value {
        color: #2d3748;
        flex: 1;
        line-height: 1.5;
    }
    
    .badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .badge-easy {
        background-color: #c6f6d5;
        color: #22543d;
    }
    
    .badge-medium {
        background-color: #feebc8;
        color: #7b341e;
    }
    
    .badge-hard {
        background-color: #fed7d7;
        color: #822727;
    }
    
    .price-tag {
        font-size: 1.5rem;
        font-weight: 700;
        color: #3182ce;
    }
    
    .back-button {
        transition: all 0.2s ease;
    }
    
    .back-button:hover {
        transform: translateX(-3px);
    }
    
    .activity-image-container {
        position: relative;
        height: 350px;
        overflow: hidden;
    }
    
    .activity-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .activity-image-container:hover .activity-image {
        transform: scale(1.05);
    }
    
    .activity-header {
        position: relative;
        padding: 2rem;
        color: white;
        background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);
    }
</style>
@endpush

@section('content')
<div class="container mx-auto py-8 px-4 md:px-0">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Activity Details</h1>
            <p class="text-gray-600 mt-2">Viewing details for <span class="text-blue-600 font-semibold">{{ $activity->name }}</span></p>
        </div>
        <a href="{{ route('activity.index') }}" class="back-button mt-4 md:mt-0 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-5 py-2 rounded-lg flex items-center shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i> Back to Activities
        </a>
    </div>

    <!-- Activity Details Card -->
    <div class="activity-card mb-8">
        <!-- Activity Image and Name Header -->
        <div class="relative">
            <div class="activity-image-container">
                <img src="{{ $activity->image ? asset('storage/' . $activity->image) : '/api/placeholder/1200/600' }}" 
                     alt="{{ $activity->name }}" class="activity-image">
            </div>
            <div class="activity-header absolute bottom-0 left-0 right-0">
                <h2 class="text-3xl font-bold">{{ $activity->name }}</h2>
                <div class="flex items-center mt-3">
                    <i class="fas fa-map-marker-alt text-red-400 mr-2"></i>
                    <span>{{ $activity->location }}</span>
                </div>
            </div>
        </div>
        
        <!-- Basic Information -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fas fa-info-circle"></i> Basic Information</h3>
            
            <div class="detail-row">
                <div class="detail-label">Description</div>
                <div class="detail-value">{{ $activity->description }}</div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-blue-50 p-4 rounded-lg flex flex-col items-center">
                    <div class="text-blue-500 mb-2"><i class="fas fa-clock fa-2x"></i></div>
                    <div class="text-sm text-gray-500">Duration</div>
                    <div class="font-semibold text-lg">{{ $activity->duration }} hours</div>
                </div>
                
                <div class="bg-blue-50 p-4 rounded-lg flex flex-col items-center">
                    <div class="text-blue-500 mb-2"><i class="fas fa-mountain fa-2x"></i></div>
                    <div class="text-sm text-gray-500">Difficulty Level</div>
                    <div class="mt-1">
                        <span class="badge {{ $activity->difficulty == 'easy' ? 'badge-easy' : ($activity->difficulty == 'medium' ? 'badge-medium' : 'badge-hard') }}">
                            {{ ucfirst($activity->difficulty) }}
                        </span>
                    </div>
                </div>
                
                <div class="bg-blue-50 p-4 rounded-lg flex flex-col items-center">
                    <div class="text-blue-500 mb-2"><i class="fas fa-tag fa-2x"></i></div>
                    <div class="text-sm text-gray-500">Price</div>
                    <div class="price-tag">${{ number_format($activity->price, 2) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
@endpush