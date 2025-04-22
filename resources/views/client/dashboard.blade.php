@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    @include('client.partials.navbar')
@include('client.partials.responsive_nav')
    <div class="container mx-auto py-6 grid grid-cols-1 md:grid-cols-12 gap-6 px-4">
      
        @include('client.partials.sidebar')

        <div class="md:col-span-6 space-y-6">
            @include('client.partials.trip_search')
            @include('client.partials.trip_tabs')
            @yield('profile')
            
        </div>
       

    
        @include('client.partials.right_sidebar')
    </div>
</div>
@endsection

