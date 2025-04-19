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
    .activity-badge {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 6px;
    }
    .scrollable-table {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>
@endpush

@section('content1')
<div class="container mx-auto py-4 ">
    <!-- Dashboard Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome Back, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 mt-1">Here's what's happening with your trips today.</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{route('trips.create')}}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i> New Trip
            </a>
        </div>
    </div>

    <!-- Date Range Selector -->
    <div class="bg-white p-4 rounded-lg shadow-sm mb-6 flex flex-col sm:flex-row justify-between items-center">
        <div class="font-medium text-gray-700 mb-3 sm:mb-0">
            <i class="far fa-calendar-alt mr-2"></i> Overview Period
        </div>
        <div class="flex items-center space-x-2">
            <button class="px-3 py-1 rounded-md bg-blue-50 text-blue-600 text-sm font-medium">Today</button>
            <button class="px-3 py-1 rounded-md hover:bg-gray-100 text-gray-600 text-sm font-medium">Week</button>
            <button class="px-3 py-1 rounded-md hover:bg-gray-100 text-gray-600 text-sm font-medium">Month</button>
            <button class="px-3 py-1 rounded-md hover:bg-gray-100 text-gray-600 text-sm font-medium">Year</button>
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
                <div class="flex items-end">
                    <p class="text-2xl md:text-3xl font-bold text-gray-800">12</p>
                    <span class="ml-2 text-xs font-medium text-green-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 8% <span class="text-gray-500 ml-1">vs last month</span>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Total Bookings -->
        <div class="bg-white rounded-lg shadow-sm p-5 stat-card flex items-center border-l-4 border-green-500">
            <div class="bg-green-100 rounded-full p-3 mr-4">
                <i class="fas fa-ticket-alt text-green-500 text-xl"></i>
            </div>
            <div>
                <h2 class="text-sm font-medium text-gray-500">Total Bookings</h2>
                <div class="flex items-end">
                    <p class="text-2xl md:text-3xl font-bold text-gray-800">320</p>
                    <span class="ml-2 text-xs font-medium text-green-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 12% <span class="text-gray-500 ml-1">vs last month</span>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow-sm p-5 stat-card flex items-center border-l-4 border-yellow-500">
            <div class="bg-yellow-100 rounded-full p-3 mr-4">
                <i class="fas fa-dollar-sign text-yellow-500 text-xl"></i>
            </div>
            <div>
                <h2 class="text-sm font-medium text-gray-500">Total Revenue</h2>
                <div class="flex items-end">
                    <p class="text-2xl md:text-3xl font-bold text-gray-800">$45,000</p>
                    <span class="ml-2 text-xs font-medium text-green-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 5% <span class="text-gray-500 ml-1">vs last month</span>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Pending Trips -->
        <div class="bg-white rounded-lg shadow-sm p-5 stat-card flex items-center border-l-4 border-red-500">
            <div class="bg-red-100 rounded-full p-3 mr-4">
                <i class="fas fa-clock text-red-500 text-xl"></i>
            </div>
            <div>
                <h2 class="text-sm font-medium text-gray-500">Pending Trips</h2>
                <div class="flex items-end">
                    <p class="text-2xl md:text-3xl font-bold text-gray-800">4</p>
                    <span class="ml-2 text-xs font-medium text-red-500 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 2 <span class="text-gray-500 ml-1">new requests</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <!-- Charts Section - Takes 2/3 of the screen on large devices -->
        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-700">Revenue Trend</h3>
                    <div class="flex items-center space-x-2">
                        <button class="text-xs font-medium text-gray-500 hover:text-gray-700">Monthly</button>
                        <span class="text-gray-300">|</span>
                        <button class="text-xs font-medium text-blue-600">Weekly</button>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Bookings Chart -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-700">Bookings Overview</h3>
                    <div class="text-xs text-gray-500">Last 30 days</div>
                </div>
                <div class="h-64">
                    <canvas id="bookingsChart"></canvas>
                </div>
            </div>

            <!-- Top Destinations -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-700">Top Destinations</h3>
                    <a href="#" class="text-blue-600 text-xs font-medium hover:text-blue-800">View All</a>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-md bg-blue-100 flex items-center justify-center mr-3">
                                <i class="fas fa-map-pin text-blue-500"></i>
                            </div>
                            <div>
                                <div class="font-medium">Paris, France</div>
                                <div class="text-xs text-gray-500">160 bookings</div>
                            </div>
                        </div>
                        <div class="text-green-500 text-sm font-medium">+12%</div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-md bg-green-100 flex items-center justify-center mr-3">
                                <i class="fas fa-map-pin text-green-500"></i>
                            </div>
                            <div>
                                <div class="font-medium">Rome, Italy</div>
                                <div class="text-xs text-gray-500">120 bookings</div>
                            </div>
                        </div>
                        <div class="text-green-500 text-sm font-medium">+8%</div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-md bg-yellow-100 flex items-center justify-center mr-3">
                                <i class="fas fa-map-pin text-yellow-500"></i>
                            </div>
                            <div>
                                <div class="font-medium">Barcelona, Spain</div>
                                <div class="text-xs text-gray-500">90 bookings</div>
                            </div>
                        </div>
                        <div class="text-red-500 text-sm font-medium">-3%</div>
                    </div>
                </div>
            </div>

            <!-- Customer Satisfaction -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-700">Customer Satisfaction</h3>
                    <div class="text-xs text-gray-500">Last 30 days</div>
                </div>
                <div class="h-64">
                    <canvas id="satisfactionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Right Sidebar - Takes 1/3 of screen on large devices -->
        <div class="space-y-6">
            <!-- Quick Access -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <h3 class="font-bold text-gray-700 mb-4">Quick Access</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('organizer.pending') }}" class="bg-gray-50 hover:bg-gray-100 p-3 rounded text-center">
                        <i class="fas fa-clock text-blue-500 text-xl mb-1"></i>
                        <div class="text-sm font-medium">Pending</div>
                    </a>
                    <a href="{{ route('hotels.index') }}" class="bg-gray-50 hover:bg-gray-100 p-3 rounded text-center">
                        <i class="fas fa-hotel text-green-500 text-xl mb-1"></i>
                        <div class="text-sm font-medium">Hotels</div>
                    </a>
                    <a href="{{ route('activity.index') }}" class="bg-gray-50 hover:bg-gray-100 p-3 rounded text-center">
                        <i class="fas fa-tasks text-purple-500 text-xl mb-1"></i>
                        <div class="text-sm font-medium">Activities</div>
                    </a>
                    <a href="{{ route('transport.index') }}" class="bg-gray-50 hover:bg-gray-100 p-3 rounded text-center">
                        <i class="fas fa-bus-alt text-yellow-500 text-xl mb-1"></i>
                        <div class="text-sm font-medium">Transport</div>
                    </a>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-700">Recent Activities</h3>
                    <a href="#" class="text-blue-600 text-xs font-medium hover:text-blue-800">View All</a>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="relative mr-3">
                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-plus text-blue-500"></i>
                            </div>
                            <div class="absolute top-0 right-0 -mr-1 h-3 w-3 rounded-full bg-blue-500 border-2 border-white"></div>
                        </div>
                        <div>
                            <div class="font-medium">Trip to Paris Created</div>
                            <div class="text-xs text-gray-500">April 25, 2025 · 10:30 AM</div>
                            <div class="text-xs font-medium text-green-500 mt-1">Completed</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="relative mr-3">
                            <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-check text-green-500"></i>
                            </div>
                            <div class="absolute top-0 right-0 -mr-1 h-3 w-3 rounded-full bg-green-500 border-2 border-white"></div>
                        </div>
                        <div>
                            <div class="font-medium">Booking Approved</div>
                            <div class="text-xs text-gray-500">April 24, 2025 · 3:15 PM</div>
                            <div class="text-xs font-medium text-green-500 mt-1">Completed</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="relative mr-3">
                            <div class="h-8 w-8 rounded-full bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-500"></i>
                            </div>
                            <div class="absolute top-0 right-0 -mr-1 h-3 w-3 rounded-full bg-yellow-500 border-2 border-white"></div>
                        </div>
                        <div>
                            <div class="font-medium">Trip to Rome Pending</div>
                            <div class="text-xs text-gray-500">April 23, 2025 · 9:45 AM</div>
                            <div class="text-xs font-medium text-yellow-500 mt-1">Pending</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Trips -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-700">Upcoming Trips</h3>
                    <a href="#" class="text-blue-600 text-xs font-medium hover:text-blue-800">View Calendar</a>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                        <div class="h-12 w-12 rounded bg-white text-center flex flex-col justify-center mr-3 border border-blue-100">
                            <div class="text-xs font-medium text-gray-500">MAY</div>
                            <div class="text-xl font-bold text-blue-600">10</div>
                        </div>
                        <div>
                            <div class="font-medium">Paris Adventure</div>
                            <div class="text-xs text-gray-500">12 participants · 7 days</div>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="h-12 w-12 rounded bg-white text-center flex flex-col justify-center mr-3 border border-gray-200">
                            <div class="text-xs font-medium text-gray-500">MAY</div>
                            <div class="text-xl font-bold text-gray-600">15</div>
                        </div>
                        <div>
                            <div class="font-medium">Italian Escape</div>
                            <div class="text-xs text-gray-500">8 participants · 5 days</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Table (Full Width) -->
    <div class="bg-white rounded-lg shadow-sm p-5 mt-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
            <h3 class="font-bold text-gray-700">Recent Trip Activities</h3>
            <div class="mt-2 sm:mt-0">
                <div class="relative">
                    <input type="text" placeholder="Search activities..." class="pl-10 pr-4 py-2 border rounded-md text-sm w-full sm:w-64">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                </div>
            </div>
        </div>
        <div class="scrollable-table">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="py-3 px-4 font-medium text-gray-600">Activity</th>
                        <th class="py-3 px-4 font-medium text-gray-600">Trip</th>
                        <th class="py-3 px-4 font-medium text-gray-600">Date</th>
                        <th class="py-3 px-4 font-medium text-gray-600">Status</th>
                        <th class="py-3 px-4 font-medium text-gray-600">User</th>
                        <th class="py-3 px-4 font-medium text-gray-600 text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <div class="rounded-full h-8 w-8 bg-blue-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-plus text-blue-500"></i>
                                </div>
                                <span>Trip to Paris Created</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">Paris Adventure</td>
                        <td class="py-3 px-4">April 25, 2025</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">Completed</span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=John+Smith" alt="John Smith" class="h-6 w-6 rounded-full mr-2">
                                <span>John Smith</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-800">View</a>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <div class="rounded-full h-8 w-8 bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-check text-green-500"></i>
                                </div>
                                <span>Booking Approved</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">Swiss Tour</td>
                        <td class="py-3 px-4">April 24, 2025</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">Completed</span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=Jane+Doe" alt="Jane Doe" class="h-6 w-6 rounded-full mr-2">
                                <span>Jane Doe</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-800">View</a>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <div class="rounded-full h-8 w-8 bg-yellow-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-clock text-yellow-500"></i>
                                </div>
                                <span>Trip to Rome Pending</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">Italian Escape</td>
                        <td class="py-3 px-4">April 23, 2025</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=Robert+Jones" alt="Robert Jones" class="h-6 w-6 rounded-full mr-2">
                                <span>Robert Jones</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-800">View</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-4 flex justify-center sm:justify-between items-center flex-wrap">
            <div class="text-sm text-gray-500 mb-4 sm:mb-0">
                Showing 1 to 3 of 25 entries
            </div>
            <div class="flex space-x-1">
                <a href="#" class="px-3 py-1 rounded bg-gray-100 text-gray-700 hover:bg-gray-200">&laquo;</a>
                <a href="#" class="px-3 py-1 rounded bg-blue-600 text-white hover:bg-blue-700">1</a>
                <a href="#" class="px-3 py-1 rounded bg-gray-100 text-gray-700 hover:bg-gray-200">2</a>
                <a href="#" class="px-3 py-1 rounded bg-gray-100 text-gray-700 hover:bg-gray-200">3</a>
                <a href="#" class="px-3 py-1 rounded bg-gray-100 text-gray-700 hover:bg-gray-200">&raquo;</a>
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
                data: [5000, 8000, 12000, 15000, 20000],
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
                x: { 
                    grid: { display: false },
                    ticks: { color: '#6b7280', font: { size: 10 } }
                },
                y: { 
                    beginAtZero: true,
                    grid: { color: 'rgba(156, 163, 175, 0.1)' },
                    ticks: { 
                        color: '#6b7280', 
                        font: { size: 10 },
                        callback: function(value) {
                            return '$ ' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Bookings Chart
    const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
    const bookingsChart = new Chart(bookingsCtx, {
        type: 'bar',
        data: {
            labels: ['Paris', 'Rome', 'London', 'Barcelona'],
            datasets: [{
                label: 'Bookings',
                data: [150, 120, 90, 75],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(16, 185, 129, 0.7)',
                    'rgba(245, 158, 11, 0.7)',
                    'rgba(239, 68, 68, 0.7)'
                ],
                borderRadius: 5,
                borderWidth: 0
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
                    displayColors: false
                }
            },
            scales: {
                x: { 
                    grid: { display: false },
                    ticks: { color: '#6b7280', font: { size: 10 } }
                },
                y: { 
                    beginAtZero: true,
                    grid: { color: 'rgba(156, 163, 175, 0.1)' },
                    ticks: { color: '#6b7280', font: { size: 10 } }
                }
            }
        }
    });

    // Customer Satisfaction Chart
    const satisfactionCtx = document.getElementById('satisfactionChart').getContext('2d');
    const satisfactionChart = new Chart(satisfactionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Excellent', 'Good', 'Average', 'Poor'],
            datasets: [{
                data: [65, 20, 10, 5],
                backgroundColor: [
                    'rgba(16, 185, 129, 1)',  // Green for Excellent
                    'rgba(59, 130, 246, 1)',  // Blue for Good
                    'rgba(245, 158, 11, 1)',  // Yellow for Average
                    'rgba(239, 68, 68, 1)'    // Red for Poor
                ],
                borderWidth: 0,
                hoverOffset: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: { size: 10 },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
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
                            return context.label + ': ' + context.parsed + '%';
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });
</script>
@endpush