@extends('layouts.organizer')

@section('title', 'Transport Details')

@push('styles')
<style>
    .transport-card {
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .transport-card:hover {
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
    
    .badge-bus {
        background-color: #c6f6d5;
        color: #22543d;
    }
    
    .badge-train {
        background-color: #feebc8;
        color: #7b341e;
    }
    
    .badge-plane {
        background-color: #fed7d7;
        color: #822727;
    }
    
    .capacity-tag {
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
    
    .transport-image-container {
        position: relative;
        height: 350px;
        overflow: hidden;
    }
    
    .transport-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .transport-image-container:hover .transport-image {
        transform: scale(1.05);
    }
    
    .transport-header {
        position: relative;
        padding: 2rem;
        color: white;
        background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);
    }
    
    .feature-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        background-color: #ebf5ff;
        color: #3182ce;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto py-8 px-4 md:px-0">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Transport Details</h1>
            <p class="text-gray-600 mt-2">Viewing details for <span class="text-blue-600 font-semibold">{{ $transport->company }} {{ $transport->type }}</span></p>
        </div>
        <a href="{{ route('transport.index') }}" class="back-button mt-4 md:mt-0 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-5 py-2 rounded-lg flex items-center shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i> Back to Transports
        </a>
    </div>

    <!-- Transport Details Card -->
    <div class="transport-card mb-8">
        <!-- Transport Image and Name Header -->
        <div class="relative">
            <div class="transport-image-container">
                <img src="{{ $transport->image ? asset('storage/' .$transport->image) : '/api/placeholder/1200/600' }}" 
                     alt="{{ $transport->company }} {{ $transport->type }}" class="transport-image">
            </div>
            <div class="transport-header absolute bottom-0 left-0 right-0">
                <h2 class="text-3xl font-bold">{{ $transport->company }} {{ $transport->type }}</h2>
                <div class="flex items-center mt-3">
                    <i class="fas fa-map-marker-alt text-red-400 mr-2"></i>
                    <span>ID: {{ $transport->id }}</span>
                </div>
            </div>
        </div>
        
        <!-- Basic Information -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fas fa-info-circle"></i> Basic Information</h3>
            
            <div class="detail-row">
                <div class="detail-label">Details</div>
                <div class="detail-value">{{ $transport->details }}</div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-blue-50 p-4 rounded-lg flex flex-col items-center">
                    <div class="text-blue-500 mb-2"><i class="fas fa-building fa-2x"></i></div>
                    <div class="text-sm text-gray-500">Company</div>
                    <div class="font-semibold text-lg">{{ $transport->company }}</div>
                </div>
                
                <div class="bg-blue-50 p-4 rounded-lg flex flex-col items-center">
                    <div class="text-blue-500 mb-2"><i class="fas fa-bus fa-2x"></i></div>
                    <div class="text-sm text-gray-500">Transport Type</div>
                    <div class="mt-1">
                        <span class="badge {{ $transport->type == 'Bus' ? 'badge-bus' : ($transport->type == 'Train' ? 'badge-train' : 'badge-plane') }}">
                            {{ ucfirst($transport->type) }}
                        </span>
                    </div>
                </div>
                
                <div class="bg-blue-50 p-4 rounded-lg flex flex-col items-center">
                    <div class="text-blue-500 mb-2"><i class="fas fa-users fa-2x"></i></div>
                    <div class="text-sm text-gray-500">Capacity</div>
                    <div class="capacity-tag">{{ $transport->capacity }} seats</div>
                </div>
            </div>
        </div>
        
        <!-- Features Section -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fas fa-star"></i> Features</h3>
            
            <div class="flex flex-wrap">
                @if(is_array($transport->features))
                    @foreach($transport->features as $feature)
                        <span class="feature-badge">
                            <i class="fas fa-check-circle mr-1"></i> {{ $feature }}
                        </span>
                    @endforeach
                @else
                    <div class="detail-value">{{ $transport->features }}</div>
                @endif
            </div>
        </div>
        
        <!-- Organizer Information -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fas fa-user"></i> Organizer Information</h3>
            
            <div class="detail-row">
                <div class="detail-label">Organizer  : </div>
                <div class="detail-value">{{ $transport->organizer->name}}</div>
            </div>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="flex justify-end mt-8">
        <div class="flex space-x-4">
            <a href="{{ route('transport.edit', $transport->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                <i class="fas fa-edit mr-2"></i> Edit Transport
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
@endpush