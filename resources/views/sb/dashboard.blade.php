@extends('sb.shell')

@section('sb-content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">SB Staff Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome back, {{ Auth::user()->name }}</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Pending Applications -->
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm font-medium">Pending Review</p>
                    <h3 class="text-4xl font-bold mt-2">8</h3>
                    <p class="text-yellow-100 text-xs mt-2">Requires Action</p>
                </div>
                <div class="bg-white bg-opacity-20 p-4 rounded-full">
                    <i class="fas fa-clock text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Under Review -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Under Review</p>
                    <h3 class="text-4xl font-bold mt-2">5</h3>
                    <p class="text-blue-100 text-xs mt-2">In Progress</p>
                </div>
                <div class="bg-white bg-opacity-20 p-4 rounded-full">
                    <i class="fas fa-search text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Approved Today -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Approved Today</p>
                    <h3 class="text-4xl font-bold mt-2">3</h3>
                    <p class="text-green-100 text-xs mt-2">This Month: 45</p>
                </div>
                <div class="bg-white bg-opacity-20 p-4 rounded-full">
                    <i class="fas fa-check-circle text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Active Drivers -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Active Drivers</p>
                    <h3 class="text-4xl font-bold mt-2">127</h3>
                    <p class="text-purple-100 text-xs mt-2">+5 this week</p>
                </div>
                <div class="bg-white bg-opacity-20 p-4 rounded-full">
                    <i class="fas fa-users text-3xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Pending Applications -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Pending Applications</h2>
                    <a href="{{ route('sb.applications.index', ['status' => 'submitted']) }}" class="text-purple-600 hover:text-purple-700 text-sm font-semibold">View All</a>
                </div>

                <div class="space-y-3">
                    <!-- Sample Pending Application -->
                    <div class="flex items-center justify-between p-4 bg-yellow-50 border border-yellow-200 rounded-lg hover:shadow-md transition">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('images/municipality-logo.jpg') }}" alt="Avatar" class="h-10 w-10 rounded-full object-cover">
                            <div>
                                <p class="font-semibold text-gray-800">Juan Dela Cruz</p>
                                <p class="text-xs text-gray-500">New Franchise • Submitted 2 hours ago</p>
                            </div>
                        </div>
                        <a href="{{ route('sb.applications.index') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-sm font-semibold">
                            Review
                        </a>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-yellow-50 border border-yellow-200 rounded-lg hover:shadow-md transition">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('images/municipality-logo.jpg') }}" alt="Avatar" class="h-10 w-10 rounded-full object-cover">
                            <div>
                                <p class="font-semibold text-gray-800">Maria Santos</p>
                                <p class="text-xs text-gray-500">Renewal • Submitted 5 hours ago</p>
                            </div>
                        </div>
                        <a href="{{ route('sb.applications.index') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-sm font-semibold">
                            Review
                        </a>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-yellow-50 border border-yellow-200 rounded-lg hover:shadow-md transition">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('images/municipality-logo.jpg') }}" alt="Avatar" class="h-10 w-10 rounded-full object-cover">
                            <div>
                                <p class="font-semibold text-gray-800">Pedro Reyes</p>
                                <p class="text-xs text-gray-500">Amendment • Submitted yesterday</p>
                            </div>
                        </div>
                        <a href="{{ route('sb.applications.index') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-sm font-semibold">
                            Review
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Recent Activity</h2>

                <div class="space-y-4">
                    <div class="flex items-start space-x-3 pb-4 border-b">
                        <div class="bg-green-100 p-2 rounded-full">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-800 font-semibold text-sm">Application Approved</p>
                            <p class="text-gray-600 text-xs mt-1">You approved application FR-000125 for Jose Garcia</p>
                            <p class="text-gray-500 text-xs mt-1">30 minutes ago</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 pb-4 border-b">
                        <div class="bg-blue-100 p-2 rounded-full">
                            <i class="fas fa-eye text-blue-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-800 font-semibold text-sm">Application Reviewed</p>
                            <p class="text-gray-600 text-xs mt-1">Marked application FR-000124 as under review</p>
                            <p class="text-gray-500 text-xs mt-1">1 hour ago</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 pb-4 border-b">
                        <div class="bg-purple-100 p-2 rounded-full">
                            <i class="fas fa-file text-purple-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-800 font-semibold text-sm">New Application Received</p>
                            <p class="text-gray-600 text-xs mt-1">Juan Dela Cruz submitted a new franchise application</p>
                            <p class="text-gray-500 text-xs mt-1">2 hours ago</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="bg-red-100 p-2 rounded-full">
                            <i class="fas fa-times text-red-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-800 font-semibold text-sm">Application Rejected</p>
                            <p class="text-gray-600 text-xs mt-1">Rejected application FR-000120 due to incomplete documents</p>
                            <p class="text-gray-500 text-xs mt-1">3 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>

                <div class="space-y-3">
                    <a href="{{ route('sb.applications.index', ['status' => 'submitted']) }}" class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 text-white py-3 rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition font-semibold flex items-center justify-center space-x-2">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Review Pending</span>
                    </a>

                    <a href="{{ route('sb.applications.index') }}" class="w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white py-3 rounded-lg hover:from-purple-600 hover:to-purple-700 transition font-semibold flex items-center justify-center space-x-2">
                        <i class="fas fa-file-alt"></i>
                        <span>All Applications</span>
                    </a>

                    <a href="{{ route('sb.dashboard') }}" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition font-semibold flex items-center justify-center space-x-2">
                        <i class="fas fa-users"></i>
                        <span>Manage Drivers</span>
                    </a>

                    <a href="{{ route('sb.dashboard') }}" class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition font-semibold flex items-center justify-center space-x-2">
                        <i class="fas fa-chart-bar"></i>
                        <span>View Reports</span>
                    </a>
                </div>
            </div>

            <!-- Application Stats -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">This Month</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Received</span>
                        <span class="font-bold text-gray-800">58</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Approved</span>
                        <span class="font-bold text-green-600">45</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Rejected</span>
                        <span class="font-bold text-red-600">5</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Pending</span>
                        <span class="font-bold text-yellow-600">8</span>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Notifications</h2>

                <div class="space-y-3">
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-3 rounded">
                        <p class="font-semibold text-yellow-800 text-sm">8 Pending Applications</p>
                        <p class="text-yellow-700 text-xs mt-1">Awaiting your review</p>
                    </div>

                    <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded">
                        <p class="font-semibold text-blue-800 text-sm">System Update</p>
                        <p class="text-blue-700 text-xs mt-1">New features available</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
