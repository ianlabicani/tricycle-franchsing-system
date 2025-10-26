@extends('driver.shell')

@section('driver-content')

    <!-- Dashboard Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Franchise Application Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome back, {{ Auth::user()->name }}!</p>
    </div>

    @if(!$activeApplication)
        <!-- No Active Application -->
        <div class="bg-white rounded-xl shadow-lg p-12 text-center mb-8">
            <div class="max-w-md mx-auto">
                <div class="bg-blue-100 rounded-full p-6 w-24 h-24 mx-auto mb-6 flex items-center justify-center">
                    <i class="fas fa-file-alt text-blue-600 text-5xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">No Active Application</h2>
                <p class="text-gray-600 mb-8">You don't have any active franchise application. Start your application process now!</p>
                <a href="{{ route('driver.application.create') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Create New Application
                </a>
            </div>
        </div>

        <!-- Application Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Applications</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_applications'] }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-4">
                        <i class="fas fa-file-alt text-blue-600 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">In Progress</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['in_progress'] }}</p>
                    </div>
                    <div class="bg-yellow-100 rounded-full p-4">
                        <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Completed</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['completed'] }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-4">
                        <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Completed Application (when no active) -->
        @if($latestApprovedApplication)
    @else
        <!-- Application Progress Tracker -->
        @php
            $progressSteps = [
                'pending_review' => 1,
                'incomplete' => 1,
                'for_scheduling' => 2,
                'inspection_scheduled' => 2,
                'inspection_pending' => 2,
                'inspection_failed' => 2,
                'for_treasury' => 3,
                'for_approval' => 4,
                'approved' => 5,
                'released' => 5,
                'completed' => 5,
            ];
            $currentStep = $progressSteps[$activeApplication->status] ?? 1;
        @endphp

        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Application Progress - {{ $activeApplication->application_no }}</h2>

            <!-- Progress Steps -->
            <div class="flex items-center justify-between mb-4">
                @foreach(['Documents', 'Inspection', 'Payment', 'Approval', 'Release'] as $index => $step)
                    @if($index > 0)
                        <div class="flex-1 h-1 {{ $currentStep > $index ? 'bg-green-500' : 'bg-gray-300' }} -mx-2"></div>
                    @endif
                    <div class="flex flex-col items-center flex-shrink-0">
                        <div class="w-12 h-12 rounded-full {{ $currentStep > $index + 1 ? 'bg-green-500' : ($currentStep === $index + 1 ? 'bg-blue-500 animate-pulse' : 'bg-gray-300') }} text-white flex items-center justify-center font-bold mb-2">
                            @if($currentStep > $index + 1)
                                <i class="fas fa-check"></i>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <p class="text-sm font-semibold {{ $currentStep >= $index + 1 ? 'text-gray-800' : 'text-gray-500' }}">{{ $step }}</p>
                        <p class="text-xs {{ $currentStep > $index + 1 ? 'text-green-600' : ($currentStep === $index + 1 ? 'text-blue-600' : 'text-gray-400') }}">
                            {{ $currentStep > $index + 1 ? 'Done' : ($currentStep === $index + 1 ? 'Active' : 'Pending') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Status</p>
                        <h3 class="text-xl font-bold mt-2">{{ $activeApplication->status_label }}</h3>
                        <p class="text-blue-100 text-xs mt-1">Step {{ $currentStep }} of 5</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <i class="fas fa-tasks text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm">Application</p>
                        <h3 class="text-lg font-bold mt-2">{{ $activeApplication->application_no }}</h3>
                        <p class="text-purple-100 text-xs mt-1">{{ ucfirst($activeApplication->franchise_type) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <i class="fas fa-file-alt text-2xl"></i>
                    </div>
                </div>
            </div>

            @if($activeApplication->latestInspection)
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm">Inspection</p>
                            <h3 class="text-lg font-bold mt-2">{{ $activeApplication->latestInspection->status === 'scheduled' ? $activeApplication->latestInspection->scheduled_date->format('M d') : ucfirst($activeApplication->latestInspection->status) }}</h3>
                            <p class="text-green-100 text-xs mt-1">{{ $activeApplication->latestInspection->result ? ucfirst($activeApplication->latestInspection->result) : 'Scheduled' }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-clipboard-check text-2xl"></i>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-gradient-to-br from-gray-400 to-gray-500 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-100 text-sm">Inspection</p>
                            <h3 class="text-lg font-bold mt-2">Pending</h3>
                            <p class="text-gray-100 text-xs mt-1">Not scheduled</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-clipboard-check text-2xl"></i>
                        </div>
                    </div>
                </div>
            @endif

            @if($activeApplication->latestPayment)
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm">Payment</p>
                            <h3 class="text-xl font-bold mt-2">₱{{ number_format($activeApplication->latestPayment->total_amount, 0) }}</h3>
                            <p class="text-orange-100 text-xs mt-1">{{ ucfirst($activeApplication->latestPayment->status) }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-money-bill-wave text-2xl"></i>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-gradient-to-br from-gray-400 to-gray-500 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-100 text-sm">Payment</p>
                            <h3 class="text-lg font-bold mt-2">Pending</h3>
                            <p class="text-gray-100 text-xs mt-1">Not required yet</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-money-bill-wave text-2xl"></i>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left: Current Status & Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Current Action Required -->
                @include('driver.partials.dashboard-status', ['application' => $activeApplication])

                <!-- Vehicle Info -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Vehicle Information</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-sm text-gray-600">Plate Number</p>
                            <p class="font-bold text-gray-800">{{ $activeApplication->plate_number ?? 'N/A' }}</p>
                        </div>
                        <div class="border-l-4 border-green-500 pl-4">
                            <p class="text-sm text-gray-600">Make</p>
                            <p class="font-bold text-gray-800">{{ $activeApplication->make ?? 'N/A' }}</p>
                        </div>
                        <div class="border-l-4 border-purple-500 pl-4">
                            <p class="text-sm text-gray-600">Color</p>
                            <p class="font-bold text-gray-800">{{ $activeApplication->color ?? 'N/A' }}</p>
                        </div>
                        <div class="border-l-4 border-orange-500 pl-4">
                            <p class="text-sm text-gray-600">Year</p>
                            <p class="font-bold text-gray-800">{{ $activeApplication->year_model ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t">
                        <p class="text-sm text-gray-600 mb-1">Route</p>
                        <p class="font-bold text-gray-800">{{ $activeApplication->route ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Right: Quick Actions -->
            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
                    <div class="space-y-3">
                        <a href="{{ route('driver.application.show', $activeApplication) }}" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition font-semibold flex items-center justify-center">
                            <i class="fas fa-eye mr-2"></i>View Application
                        </a>
                        <a href="{{ route('driver.application') }}" class="w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white py-3 rounded-lg hover:from-purple-600 hover:to-purple-700 transition font-semibold flex items-center justify-center">
                            <i class="fas fa-list mr-2"></i>All Applications
                        </a>
                        <a href="{{ route('driver.help') }}" class="w-full bg-gradient-to-r from-gray-500 to-gray-600 text-white py-3 rounded-lg hover:from-gray-600 hover:to-gray-700 transition font-semibold flex items-center justify-center">
                            <i class="fas fa-question-circle mr-2"></i>Help & Support
                        </a>
                    </div>
                </div>

                <!-- Application Summary -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Summary</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between pb-2 border-b">
                            <span class="text-gray-600">Submitted</span>
                            <span class="font-semibold">{{ $activeApplication->date_submitted ? $activeApplication->date_submitted->format('M d, Y') : 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between pb-2 border-b">
                            <span class="text-gray-600">Type</span>
                            <span class="font-semibold">{{ ucfirst($activeApplication->franchise_type) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status</span>
                            <span class="font-semibold text-blue-600">{{ $activeApplication->status_label }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Latest Approved Application -->
    @if($latestApprovedApplication)
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-check-circle text-green-600 mr-2"></i>Latest Approved Application
            </h2>

            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl shadow-lg border-2 border-green-200 overflow-hidden">
                <!-- Header Banner -->
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">{{ $latestApprovedApplication->application_no }}</h3>
                            <p class="text-green-100">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Approved on {{ $latestApprovedApplication->date_approved?->format('F d, Y') ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 rounded-lg backdrop-blur-sm">
                                <i class="fas fa-medal text-yellow-300 text-3xl mr-3"></i>
                                <div class="text-left">
                                    <p class="text-xs text-green-100">Status</p>
                                    <p class="text-lg font-bold">{{ $latestApprovedApplication->status === 'released' ? 'Released' : 'Approved' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Vehicle Information -->
                        <div class="bg-white rounded-xl p-5 shadow-md">
                            <div class="flex items-center mb-4">
                                <div class="bg-green-100 rounded-full p-3 mr-3">
                                    <i class="fas fa-taxi text-green-600 text-xl"></i>
                                </div>
                                <h4 class="font-bold text-gray-800">Vehicle Details</h4>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-gray-600">Plate Number</p>
                                    <p class="font-bold text-gray-800">{{ $latestApprovedApplication->plate_number ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Make & Model</p>
                                    <p class="font-bold text-gray-800">{{ $latestApprovedApplication->make ?? 'N/A' }}</p>
                                </div>
                                <div class="flex justify-between">
                                    <div>
                                        <p class="text-xs text-gray-600">Color</p>
                                        <p class="font-semibold text-gray-800">{{ $latestApprovedApplication->color ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600">Year</p>
                                        <p class="font-semibold text-gray-800">{{ $latestApprovedApplication->year_model ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Approval Information -->
                        <div class="bg-white rounded-xl p-5 shadow-md">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 rounded-full p-3 mr-3">
                                    <i class="fas fa-user-check text-blue-600 text-xl"></i>
                                </div>
                                <h4 class="font-bold text-gray-800">Approval Details</h4>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-gray-600">Approved By</p>
                                    <p class="font-bold text-gray-800">{{ $latestApprovedApplication->approvedBy?->name ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Date Approved</p>
                                    <p class="font-bold text-gray-800">{{ $latestApprovedApplication->date_approved?->format('M d, Y') ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Franchise Type</p>
                                    <p class="font-semibold text-gray-800">{{ ucfirst($latestApprovedApplication->franchise_type) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment & Inspection -->
                        <div class="bg-white rounded-xl p-5 shadow-md">
                            <div class="flex items-center mb-4">
                                <div class="bg-purple-100 rounded-full p-3 mr-3">
                                    <i class="fas fa-file-invoice-dollar text-purple-600 text-xl"></i>
                                </div>
                                <h4 class="font-bold text-gray-800">Transaction Info</h4>
                            </div>
                            <div class="space-y-3">
                                @if($latestApprovedApplication->latestPayment)
                                    <div>
                                        <p class="text-xs text-gray-600">Payment Amount</p>
                                        <p class="font-bold text-gray-800">₱{{ number_format($latestApprovedApplication->latestPayment->total_amount, 2) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600">Payment Status</p>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                            {{ $latestApprovedApplication->latestPayment->status === 'verified' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($latestApprovedApplication->latestPayment->status) }}
                                        </span>
                                    </div>
                                @else
                                    <div>
                                        <p class="text-xs text-gray-600">Payment</p>
                                        <p class="font-semibold text-gray-500">No payment record</p>
                                    </div>
                                @endif

                                @if($latestApprovedApplication->latestInspection)
                                    <div>
                                        <p class="text-xs text-gray-600">Inspection Result</p>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                            {{ $latestApprovedApplication->latestInspection->result === 'passed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            {{ ucfirst($latestApprovedApplication->latestInspection->result ?? 'N/A') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Route Information -->
                    @if($latestApprovedApplication->route)
                        <div class="mt-6 bg-white rounded-xl p-5 shadow-md">
                            <div class="flex items-center mb-3">
                                <div class="bg-orange-100 rounded-full p-2 mr-2">
                                    <i class="fas fa-route text-orange-600"></i>
                                </div>
                                <h4 class="font-bold text-gray-800">Assigned Route</h4>
                            </div>
                            <p class="text-gray-700 font-semibold">{{ $latestApprovedApplication->route }}</p>
                        </div>
                    @endif

                    <!-- Action Button -->
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('driver.application.show', $latestApprovedApplication) }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg hover:from-green-700 hover:to-emerald-700 transition font-semibold shadow-lg">
                            <i class="fas fa-eye mr-2"></i>View Full Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif

@endsection
