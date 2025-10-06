@extends('driver.shell')

@section('driver-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('driver.dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('driver.application') }}" class="hover:text-blue-600">Applications</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Application Details</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Application Details</h1>
                <p class="text-gray-600 mt-2">Application ID: {{ $application->id ?? 'FR-2025-0123' }}</p>
            </div>
            <a href="{{ route('driver.application') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Applications
            </a>
        </div>
    </div>

    <!-- Application Status Card -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Application Status</h2>
                <p class="text-blue-100 mb-4">{{ $application->status ?? 'In Progress' }}</p>
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-blue-100 text-sm">Application ID</p>
                        <p class="text-xl font-bold">{{ $application->id ?? 'FR-2025-0123' }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-blue-100 text-sm">Submitted On</p>
                        <p class="text-xl font-bold">{{ $application->date_submitted ?? 'Oct 4, 2025' }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-blue-100 text-sm">Type</p>
                        <p class="text-xl font-bold">{{ ucfirst($application->franchise_type ?? 'New') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-6">
                <i class="fas fa-file-alt text-6xl"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Application Details -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Application Information</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('driver.application.edit', $application->id ?? 1) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-semibold">
                            <i class="fas fa-download mr-1"></i>Download PDF
                        </button>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Personal Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                                <p class="text-gray-800 font-semibold">{{ Auth::user()->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Date of Birth</label>
                                <p class="text-gray-800 font-semibold">January 15, 1985</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Contact Number</label>
                                <p class="text-gray-800 font-semibold">+63 912 345 6789</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                                <p class="text-gray-800 font-semibold">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 mb-1">Complete Address</label>
                                <p class="text-gray-800 font-semibold">123 Main Street, Barangay Centro, City, Province</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Vehicle Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Plate Number</label>
                                <p class="text-gray-800 font-semibold">ABC-1234</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Engine Number</label>
                                <p class="text-gray-800 font-semibold">EN123456789</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Chassis Number</label>
                                <p class="text-gray-800 font-semibold">CH987654321</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Year Model</label>
                                <p class="text-gray-800 font-semibold">2020</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Make/Brand</label>
                                <p class="text-gray-800 font-semibold">Honda</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Color</label>
                                <p class="text-gray-800 font-semibold">Blue</p>
                            </div>
                        </div>
                    </div>

                    <!-- Route Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Route Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Preferred Route</label>
                                <p class="text-gray-800 font-semibold">Route A (Church - Market - Terminal)</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Operating Hours</label>
                                <p class="text-gray-800 font-semibold">6:00 AM - 8:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Purpose/Remarks -->
                    @if(isset($application->purpose) && $application->purpose)
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Purpose / Remarks</h3>
                        <p class="text-gray-700">{{ $application->purpose }}</p>
                    </div>
                    @endif

                    <!-- Remarks from Admin -->
                    @if(isset($application->remarks) && $application->remarks)
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Admin Remarks</h3>
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                            <p class="text-yellow-800">{{ $application->remarks }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Application Timeline -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Application Timeline</h2>

                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-300"></div>

                    <div class="space-y-6">
                        <!-- Step 1 -->
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Application Submitted</h3>
                                <p class="text-sm text-gray-600 mt-1">Application form completed and submitted</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $application->date_submitted ?? 'October 4, 2025 - 2:15 PM' }}</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Under Review</h3>
                                <p class="text-sm text-gray-600 mt-1">Application is being reviewed by SB Staff</p>
                                <p class="text-xs text-gray-500 mt-2">In Progress</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-white font-bold">
                                3
                            </div>
                            <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-600">Final Approval</h3>
                                <p class="text-sm text-gray-500 mt-1">Pending review completion</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Application Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Application Summary</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Status</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $application->status ?? 'In Progress' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Type</span>
                        <span class="font-bold text-gray-800">{{ ucfirst($application->franchise_type ?? 'New') }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Submitted</span>
                        <span class="font-bold text-gray-800">{{ $application->date_submitted ?? 'Oct 4, 2025' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Processing Time</span>
                        <span class="font-bold text-gray-800">10-15 days</span>
                    </div>
                </div>
            </div>

            <!-- Next Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Next Actions</h2>

                <div class="space-y-3">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                            <div>
                                <p class="font-semibold text-blue-800 text-sm">Wait for Review</p>
                                <p class="text-blue-700 text-xs mt-1">SB Staff is reviewing your application</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Need Help?</h2>

                <div class="space-y-3">
                    <a href="{{ route('driver.help') }}" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-headset text-blue-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Contact Support</p>
                            <p class="text-xs text-gray-500">We're here to help</p>
                        </div>
                    </a>

                    <a href="{{ route('driver.help') }}" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-book text-purple-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Application Guide</p>
                            <p class="text-xs text-gray-500">Step-by-step instructions</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

@endsection
