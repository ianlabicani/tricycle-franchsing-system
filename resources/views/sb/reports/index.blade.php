@extends('sb.shell')

@section('sb-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('sb.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Reports & Analytics</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Reports & Analytics</h1>
        <p class="text-gray-600 mt-2">System statistics and performance metrics</p>
    </div>

    <!-- Application Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm font-medium">Total Apps</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $applicationStats['total'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm font-medium">Completed</p>
            <p class="text-2xl font-bold text-green-600 mt-1">{{ $applicationStats['completed'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm font-medium">Pending</p>
            <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $applicationStats['pending'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm font-medium">Approved</p>
            <p class="text-2xl font-bold text-blue-600 mt-1">{{ $applicationStats['approved'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm font-medium">Rejected</p>
            <p class="text-2xl font-bold text-red-600 mt-1">{{ $applicationStats['rejected'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm font-medium">For Renewal</p>
            <p class="text-2xl font-bold text-purple-600 mt-1">{{ $applicationStats['renewal'] }}</p>
        </div>
    </div>

    <!-- Payment & Inspection Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Payment Stats -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Payment Statistics</h2>
            <div class="space-y-3">
                <div class="flex items-center justify-between pb-3 border-b">
                    <span class="text-gray-600">Total Payments</span>
                    <span class="font-bold text-gray-800">{{ $paymentStats['count'] }}</span>
                </div>
                <div class="flex items-center justify-between pb-3 border-b">
                    <span class="text-gray-600">Total Amount Collected</span>
                    <span class="font-bold text-green-600">₱{{ number_format($paymentStats['total'], 2) }}</span>
                </div>
                <div class="flex items-center justify-between pb-3 border-b">
                    <span class="text-gray-600">Verified Amount</span>
                    <span class="font-bold text-gray-800">₱{{ number_format($paymentStats['verified'], 2) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Pending Amount</span>
                    <span class="font-bold text-yellow-600">₱{{ number_format($paymentStats['pending'], 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Inspection Stats -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Inspection Statistics</h2>
            <div class="space-y-3">
                <div class="flex items-center justify-between pb-3 border-b">
                    <span class="text-gray-600">Total Inspections</span>
                    <span class="font-bold text-gray-800">{{ $inspectionStats['total'] }}</span>
                </div>
                <div class="flex items-center justify-between pb-3 border-b">
                    <span class="text-gray-600">Completed</span>
                    <span class="font-bold text-green-600">{{ $inspectionStats['completed'] }}</span>
                </div>
                <div class="flex items-center justify-between pb-3 border-b">
                    <span class="text-gray-600">Scheduled</span>
                    <span class="font-bold text-blue-600">{{ $inspectionStats['scheduled'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Pass Rate</span>
                    @php
                        $passRate = $inspectionStats['completed'] > 0
                            ? round(($inspectionStats['passed'] / $inspectionStats['completed']) * 100)
                            : 0;
                    @endphp
                    <span class="font-bold text-gray-800">{{ $passRate }}%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Reports -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Applications Report -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Application Reports</h3>
                <i class="fas fa-file-alt text-2xl text-blue-600"></i>
            </div>
            <p class="text-gray-600 text-sm mb-4">View detailed application statistics and trends</p>
            <a href="{{ route('sb.reports.show', 'applications') }}" class="block w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-semibold text-center">
                <i class="fas fa-chart-line mr-2"></i>View Details
            </a>
        </div>

        <!-- Payments Report -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Payment Reports</h3>
                <i class="fas fa-money-bill-wave text-2xl text-green-600"></i>
            </div>
            <p class="text-gray-600 text-sm mb-4">View payment history and verification status</p>
            <a href="{{ route('sb.reports.show', 'payments') }}" class="block w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition font-semibold text-center">
                <i class="fas fa-chart-line mr-2"></i>View Details
            </a>
        </div>

        <!-- Inspections Report -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Inspection Reports</h3>
                <i class="fas fa-clipboard-check text-2xl text-purple-600"></i>
            </div>
            <p class="text-gray-600 text-sm mb-4">View inspection records and results</p>
            <a href="{{ route('sb.reports.show', 'inspections') }}" class="block w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition font-semibold text-center">
                <i class="fas fa-chart-line mr-2"></i>View Details
            </a>
        </div>
    </div>

@endsection
