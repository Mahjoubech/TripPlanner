@extends('layouts.organizer')

@section('title', 'Dashboard')

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

@section('content1')
<div class="container mx-auto py-4">
    <!-- Dashboard Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome Back, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 mt-1">Here's what's happening with your trips today.</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('trips.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i> New Trip
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        <!-- Total Trips -->
        <div class="bg-white rounded-lg shadow-sm p-5 stat-card flex items-center border-l-4 border-blue-500">
            <div class="bg-blue-100 rounded-full p-3 mr-4">
                <i class="fas fa-map-marked-alt text-blue-500 text-xl"></i>
            </div>
            <div>
                <h2 class="text-sm font-medium text-gray-500">Total Trips</h2>
                <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $totalTrips }}</p>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white rounded-lg shadow-sm p-5 stat-card flex items-center border-l-4 border-green-500">
            <div class="bg-green-100 rounded-full p-3 mr-4">
                <i class="fas fa-ticket-alt text-green-500 text-xl"></i>
            </div>
            <div>
                <h2 class="text-sm font-medium text-gray-500">Total Bookings</h2>
                <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $totalBookings }}</p>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow-sm p-5 stat-card flex items-center border-l-4 border-yellow-500">
            <div class="bg-yellow-100 rounded-full p-3 mr-4">
                <i class="fas fa-dollar-sign text-yellow-500 text-xl"></i>
            </div>
            <div>
                <h2 class="text-sm font-medium text-gray-500">Total Revenue</h2>
                <p class="text-2xl md:text-3xl font-bold text-gray-800">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>

        <!-- Pending Trips -->
        <div class="bg-white rounded-lg shadow-sm p-5 stat-card flex items-center border-l-4 border-red-500">
            <div class="bg-red-100 rounded-full p-3 mr-4">
                <i class="fas fa-clock text-red-500 text-xl"></i>
            </div>
            <div>
                <h2 class="text-sm font-medium text-gray-500">Pending Trips</h2>
                <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $pendingTrips }}</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-5">
            <h3 class="font-bold text-gray-700 mb-4">Revenue Trend</h3>
            <div class="h-64">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Bookings Chart -->
        <div class="bg-white rounded-lg shadow-sm p-5">
            <h3 class="font-bold text-gray-700 mb-4">Bookings Overview</h3>
            <div class="h-64">
                <canvas id="bookingsChart"></canvas>
            </div>
        </div>

        <!-- Customer Satisfaction Chart -->
        <div class="bg-white rounded-lg shadow-sm p-5">
            <h3 class="font-bold text-gray-700 mb-4">Customer Satisfaction</h3>
            <div class="h-64">
                <canvas id="satisfactionChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                label: 'Revenue',
                data: @json($revenueData), // Pass revenue data from the controller
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#3b82f6',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1f2937',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    bodyFont: { size: 12 },
                    titleFont: { size: 14, weight: 'bold' },
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return '$ ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: { grid: { display: false } },
                y: { beginAtZero: true, grid: { color: 'rgba(156, 163, 175, 0.1)' } }
            }
        }
    });

    // Bookings Chart
    const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
    const bookingsChart = new Chart(bookingsCtx, {
        type: 'bar',
        data: {
            labels: @json($bookingLabels), // Pass booking labels from the controller
            datasets: [{
                label: 'Bookings',
                data: @json($bookingData), // Pass booking data from the controller
                backgroundColor: ['rgba(59, 130, 246, 0.7)', 'rgba(16, 185, 129, 0.7)', 'rgba(245, 158, 11, 0.7)', 'rgba(239, 68, 68, 0.7)'],
                borderRadius: 5,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { x: { grid: { display: false } }, y: { beginAtZero: true } }
        }
    });

    // Customer Satisfaction Chart
    const satisfactionCtx = document.getElementById('satisfactionChart').getContext('2d');
    const satisfactionChart = new Chart(satisfactionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Excellent', 'Good', 'Average', 'Poor'],
            datasets: [{
                data: @json($satisfactionData), // Pass satisfaction data from the controller
                backgroundColor: ['rgba(16, 185, 129, 1)', 'rgba(59, 130, 246, 1)', 'rgba(245, 158, 11, 1)', 'rgba(239, 68, 68, 1)'],
                borderWidth: 0,
                hoverOffset: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, pointStyle: 'circle' } }
            },
            cutout: '70%'
        }
    });
</script>
@endpush