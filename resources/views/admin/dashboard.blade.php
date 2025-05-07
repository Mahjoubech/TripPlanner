@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .scrollable-table {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto py-4">
    <!-- Dashboard Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome Back, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 mt-1">Here's an overview of the platform's activity.</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow-sm p-5 stat-card flex items-center border-l-4 border-blue-500">
            <div class="bg-blue-100 rounded-full p-3 mr-4">
                <i class="fas fa-users text-blue-500 text-xl"></i>
            </div>
            <div>
                <h2 class="text-sm font-medium text-gray-500">Total Users</h2>
                <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $totalUsers }}</p>
            </div>
        </div>

        <!-- Total Trips -->
        <div class="bg-white rounded-lg shadow-sm p-5 stat-card flex items-center border-l-4 border-green-500">
            <div class="bg-green-100 rounded-full p-3 mr-4">
                <i class="fas fa-map-marked-alt text-green-500 text-xl"></i>
            </div>
            <div>
                <h2 class="text-sm font-medium text-gray-500">Total Trips</h2>
                <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $totalTrips }}</p>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white rounded-lg shadow-sm p-5 stat-card flex items-center border-l-4 border-yellow-500">
            <div class="bg-yellow-100 rounded-full p-3 mr-4">
                <i class="fas fa-ticket-alt text-yellow-500 text-xl"></i>
            </div>
            <div>
                <h2 class="text-sm font-medium text-gray-500">Total Bookings</h2>
                <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $totalBookings }}</p>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow-sm p-5 stat-card flex items-center border-l-4 border-red-500">
            <div class="bg-red-100 rounded-full p-3 mr-4">
                <i class="fas fa-dollar-sign text-red-500 text-xl"></i>
            </div>
            <div>
                <h2 class="text-sm font-medium text-gray-500">Total Revenue</h2>
                <p class="text-2xl md:text-3xl font-bold text-gray-800">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Approval Section -->
    <div class="bg-white rounded-lg shadow-sm p-5 mt-6">
        <h3 class="font-bold text-gray-700 mb-4">Pending Trip Approvals</h3>
        <div class="scrollable-table">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="py-3 px-4 font-medium text-gray-600">Trip</th>
                        <th class="py-3 px-4 font-medium text-gray-600">Organizer</th>
                        <th class="py-3 px-4 font-medium text-gray-600">Date</th>
                        <th class="py-3 px-4 font-medium text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingTrips as $trip)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $trip->title }}</td>
                            <td class="py-3 px-4">{{ $trip->organizer->name }}</td>
                            <td class="py-3 px-4">{{ $trip->start_date->format('M d, Y') }}</td>
                            <td class="py-3 px-4">
                                <form action="{{ route('admin.approveTrip', $trip->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-600 hover:text-green-800">Approve</button>
                                </form>
                                <form action="{{ route('admin.rejectTrip', $trip->id) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-3 px-4 text-center text-gray-500">No pending trips.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- User Management Section -->
    <div class="bg-white rounded-lg shadow-sm p-5 mt-6">
        <h3 class="font-bold text-gray-700 mb-4">User Management</h3>
        <div class="scrollable-table">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="py-3 px-4 font-medium text-gray-600">Name</th>
                        <th class="py-3 px-4 font-medium text-gray-600">Email</th>
                        <th class="py-3 px-4 font-medium text-gray-600">Status</th>
                        <th class="py-3 px-4 font-medium text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $user->name }}</td>
                            <td class="py-3 px-4">{{ $user->email }}</td>
                            <td class="py-3 px-4">
                                @if($user->is_blocked)
                                    <span class="px-2 py-1 rounded-full text-xs bg-red-100 text-red-800">Blocked</span>
                                @else
                                    <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">Active</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                @if($user->is_blocked)
                                    <form action="{{ route('admin.unblockUser', $user->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-600 hover:text-green-800">Unblock</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.blockUser', $user->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Block</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-3 px-4 text-center text-gray-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection