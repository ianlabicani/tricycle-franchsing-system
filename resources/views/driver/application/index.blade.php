@extends('driver.shell')

@section('driver-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('driver.dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Applications</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Franchise Application</h1>
                <p class="text-gray-600 mt-2">Submit and track your franchise application</p>
            </div>
            @if(empty($applications) || $applications->isEmpty())
            <a href="{{ route('driver.application.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i>New Application
            </a>
            @endif
        </div>
    </div>

    @if(isset($applications) && $applications->isEmpty())
    <!-- No Applications State -->
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <div class="max-w-md mx-auto">
            <div class="bg-blue-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-file-alt text-blue-600 text-5xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-3">No Applications Yet</h2>
            <p class="text-gray-600 mb-6">You haven't submitted any franchise applications. Ready to get started?</p>
            <a href="{{ route('driver.application.create') }}" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i>Create Your First Application
            </a>
            <div class="mt-8 pt-8 border-t">
                <h3 class="font-bold text-gray-800 mb-3">Before You Start:</h3>
                <div class="text-left space-y-2">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-500"></i>
                        <span class="text-gray-700 text-sm">Ensure you have uploaded all required documents</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-500"></i>
                        <span class="text-gray-700 text-sm">Have your vehicle information ready</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-500"></i>
                        <span class="text-gray-700 text-sm">Choose your preferred route</span>
                    </div>
                </div>
                <a href="{{ route('driver.requirements') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-700 font-semibold text-sm">
                    <i class="fas fa-arrow-right mr-1"></i>Upload Requirements First
                </a>
            </div>
        </div>
    </div>
    @else

    <!-- Application Status Card -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Application Status</h2>
                <p class="text-blue-100 mb-4">Your application is currently under review</p>
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-blue-100 text-sm">Application ID</p>
                        <p class="text-xl font-bold">FR-2025-0123</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-blue-100 text-sm">Submitted On</p>
                        <p class="text-xl font-bold">Oct 4, 2025</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-blue-100 text-sm">Status</p>
                        <p class="text-xl font-bold">Pending Inspection</p>
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

            <!-- Application Form -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Application Details</h2>

                <div class="space-y-6">
                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Personal Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" value="Juan Dela Cruz" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                                <input type="text" value="January 15, 1985" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                                <input type="text" value="+63 912 345 6789" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="text" value="juan.delacruz@email.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                                <input type="text" value="123 Main Street, Barangay Centro, City, Province" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Vehicle Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Plate Number</label>
                                <input type="text" value="ABC-1234" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Engine Number</label>
                                <input type="text" value="EN123456789" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Chassis Number</label>
                                <input type="text" value="CH987654321" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Year Model</label>
                                <input type="text" value="2020" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Make/Brand</label>
                                <input type="text" value="Honda" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                                <input type="text" value="Blue" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Route Preference -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Route Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Preferred Route</label>
                                <input type="text" value="Route A (Church - Market - Terminal)" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Operating Hours</label>
                                <input type="text" value="6:00 AM - 8:00 PM" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t flex space-x-3">
                    @if(isset($applications) && $applications->isNotEmpty())
                        <a href="{{ route('driver.application.show', $applications->first()->id) }}" class="flex-1 bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold text-center">
                            <i class="fas fa-eye mr-2"></i>View Details
                        </a>
                        <a href="{{ route('driver.application.edit', $applications->first()->id) }}" class="flex-1 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition font-semibold text-center">
                            <i class="fas fa-edit mr-2"></i>Edit Application
                        </a>
                    @else
                        <button class="flex-1 bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                            <i class="fas fa-eye mr-2"></i>View Details
                        </button>
                        <button class="flex-1 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition font-semibold">
                            <i class="fas fa-edit mr-2"></i>Edit Application
                        </button>
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
                                <h3 class="font-bold text-gray-800">Requirements Submitted</h3>
                                <p class="text-sm text-gray-600 mt-1">All required documents uploaded and verified</p>
                                <p class="text-xs text-gray-500 mt-2">October 1, 2025 - 9:30 AM</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Application Form Submitted</h3>
                                <p class="text-sm text-gray-600 mt-1">Application form completed and submitted</p>
                                <p class="text-xs text-gray-500 mt-2">October 4, 2025 - 2:15 PM</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Inspection Scheduled</h3>
                                <p class="text-sm text-gray-600 mt-1">Waiting for vehicle inspection on Oct 12, 2025</p>
                                <p class="text-xs text-gray-500 mt-2">In Progress</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-white font-bold">
                                4
                            </div>
                            <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-600">Payment Processing</h3>
                                <p class="text-sm text-gray-500 mt-1">Pending inspection completion</p>
                            </div>
                        </div>

                        <!-- Step 5 -->
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-white font-bold">
                                5
                            </div>
                            <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-600">Final Approval</h3>
                                <p class="text-sm text-gray-500 mt-1">Pending all requirements completion</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Quick Stats -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Application Summary</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Status</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">In Progress</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Progress</span>
                        <span class="font-bold text-gray-800">60%</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Steps Completed</span>
                        <span class="font-bold text-gray-800">3 / 5</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Est. Completion</span>
                        <span class="font-bold text-gray-800">Oct 20, 2025</span>
                    </div>
                </div>
            </div>

            <!-- Required Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Required Actions</h2>

                <div class="space-y-3">
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-3 rounded">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mt-1"></i>
                            <div>
                                <p class="font-semibold text-yellow-800 text-sm">Attend Inspection</p>
                                <p class="text-yellow-700 text-xs mt-1">Oct 12, 2025 at 10:00 AM</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                            <div>
                                <p class="font-semibold text-blue-800 text-sm">Prepare Payment</p>
                                <p class="text-blue-700 text-xs mt-1">After inspection approval</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Need Assistance?</h2>

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

    @endif

@endsection
