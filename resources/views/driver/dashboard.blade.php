@extends('driver.shell')

@section('driver-content')

    <!-- Dashboard Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Franchise Application Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome back, {{ Auth::user()->name }}!</p>
    </div>

    <!-- Application Progress Tracker -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Application Progress</h2>

        <div class="relative">
            <!-- Progress Bar -->
            <div class="flex items-center justify-between mb-8">
                <!-- Step 1: Requirements -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center font-bold text-lg mb-2 relative z-10">
                        <i class="fas fa-check"></i>
                    </div>
                    <p class="text-sm font-semibold text-gray-800">Requirements</p>
                    <p class="text-xs text-green-600">Completed</p>
                </div>

                <!-- Connector -->
                <div class="flex-1 h-1 bg-green-500 -mx-4"></div>

                <!-- Step 2: Inspection -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-lg mb-2 relative z-10">
                        2
                    </div>
                    <p class="text-sm font-semibold text-gray-800">Inspection</p>
                    <p class="text-xs text-blue-600">In Progress</p>
                </div>

                <!-- Connector -->
                <div class="flex-1 h-1 bg-gray-300 -mx-4"></div>

                <!-- Step 3: Payment -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-12 h-12 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold text-lg mb-2 relative z-10">
                        3
                    </div>
                    <p class="text-sm font-semibold text-gray-600">Payment</p>
                    <p class="text-xs text-gray-500">Pending</p>
                </div>

                <!-- Connector -->
                <div class="flex-1 h-1 bg-gray-300 -mx-4"></div>

                <!-- Step 4: Application -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-12 h-12 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold text-lg mb-2 relative z-10">
                        4
                    </div>
                    <p class="text-sm font-semibold text-gray-600">Application</p>
                    <p class="text-xs text-gray-500">Pending</p>
                </div>

                <!-- Connector -->
                <div class="flex-1 h-1 bg-gray-300 -mx-4"></div>

                <!-- Step 5: Approval -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-12 h-12 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold text-lg mb-2 relative z-10">
                        5
                    </div>
                    <p class="text-sm font-semibold text-gray-600">Approval</p>
                    <p class="text-xs text-gray-500">Pending</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Application Status -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Application Status</p>
                    <h3 class="text-2xl font-bold mt-2">In Progress</h3>
                    <p class="text-blue-100 text-xs mt-1">Step 2 of 5</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-tasks text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Requirements -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Requirements</p>
                    <h3 class="text-2xl font-bold mt-2">5/5 Uploaded</h3>
                    <p class="text-green-100 text-xs mt-1">All verified</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-file-upload text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Inspection Date -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Inspection Date</p>
                    <h3 class="text-xl font-bold mt-2">Oct 12, 2025</h3>
                    <p class="text-purple-100 text-xs mt-1">10:00 AM - Confirmed</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-calendar-check text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Fees Due -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Total Fees</p>
                    <h3 class="text-2xl font-bold mt-2">₱8,500.00</h3>
                    <p class="text-orange-100 text-xs mt-1">Pending inspection</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-peso-sign text-3xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        <!-- Left Column - Application Details -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Current Task -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Current Task</h2>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">Action Required</span>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-500 text-white rounded-full p-3">
                            <i class="fas fa-clipboard-check text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Vehicle Inspection Scheduled</h3>
                            <p class="text-gray-600 mb-4">Your inspection has been approved and scheduled. Please bring the following on your inspection date:</p>
                            <ul class="list-disc list-inside text-gray-700 space-y-1 mb-4">
                                <li>Original vehicle registration (OR/CR)</li>
                                <li>Valid driver's license</li>
                                <li>Vehicle for physical inspection</li>
                                <li>Previous inspection report (if renewal)</li>
                            </ul>
                            <div class="bg-white p-4 rounded-lg">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-gray-500 text-sm">Date & Time</p>
                                        <p class="text-gray-800 font-bold">October 12, 2025 - 10:00 AM</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Inspector</p>
                                        <p class="text-gray-800 font-bold">Inspector Reyes</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Location</p>
                                        <p class="text-gray-800 font-bold">Main Office Parking Area</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Queue Number</p>
                                        <p class="text-gray-800 font-bold">#15</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submitted Requirements -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Submitted Requirements</h2>
                    <a href="{{ route('driver.requirements') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">View All</a>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Valid Driver's License</p>
                                <p class="text-xs text-gray-500">Uploaded on Oct 1, 2025</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Vehicle OR/CR</p>
                                <p class="text-xs text-gray-500">Uploaded on Oct 1, 2025</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Police Clearance</p>
                                <p class="text-xs text-gray-500">Uploaded on Oct 2, 2025</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Barangay Clearance</p>
                                <p class="text-xs text-gray-500">Uploaded on Oct 2, 2025</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Medical Certificate</p>
                                <p class="text-xs text-gray-500">Uploaded on Oct 3, 2025</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column - Quick Access & Info -->
        <div class="space-y-6">

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>

                <div class="space-y-3">
                    <a href="{{ route('driver.requirements') }}" class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition font-semibold flex items-center justify-center space-x-2">
                        <i class="fas fa-file-upload"></i>
                        <span>Upload Requirements</span>
                    </a>

                    <a href="{{ route('driver.inspection') }}" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition font-semibold flex items-center justify-center space-x-2">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Reschedule Inspection</span>
                    </a>

                    <a href="{{ route('driver.application') }}" class="w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white py-3 rounded-lg hover:from-purple-600 hover:to-purple-700 transition font-semibold flex items-center justify-center space-x-2">
                        <i class="fas fa-file-alt"></i>
                        <span>View Application</span>
                    </a>

                    <a href="{{ route('driver.payments') }}" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-3 rounded-lg hover:from-orange-600 hover:to-orange-700 transition font-semibold flex items-center justify-center space-x-2">
                        <i class="fas fa-wallet"></i>
                        <span>View Fees</span>
                    </a>
                </div>
            </div>

            <!-- Renewal Reminder -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Renewal Reminder</h2>
                    <i class="fas fa-sync-alt text-2xl text-purple-600"></i>
                </div>

                <div class="bg-purple-50 border-l-4 border-purple-500 p-4 rounded">
                    <p class="text-purple-800 font-semibold text-sm mb-2">Next Renewal Due</p>
                    <p class="text-purple-900 text-xl font-bold">March 15, 2026</p>
                    <p class="text-purple-700 text-xs mt-2">159 days remaining</p>
                </div>

                <div class="mt-4 space-y-2">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-bell text-purple-500 mr-2"></i>
                        <span>Auto-reminder enabled</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-envelope text-purple-500 mr-2"></i>
                        <span>Notifications via email</span>
                    </div>
                </div>
            </div>

            <!-- Help & Support -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Help & Support</h2>

                <div class="space-y-3">
                    <a href="#" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-question-circle text-blue-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">FAQ</p>
                            <p class="text-xs text-gray-500">Common questions</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-phone text-green-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Contact Us</p>
                            <p class="text-xs text-gray-500">+63 123 456 7890</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-book text-purple-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Guidelines</p>
                            <p class="text-xs text-gray-500">Application guide</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Notifications -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Notifications</h2>

                <div class="space-y-3">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded">
                        <p class="text-blue-800 font-semibold text-sm">Inspection Scheduled</p>
                        <p class="text-blue-700 text-xs mt-1">2 hours ago</p>
                    </div>

                    <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded">
                        <p class="text-green-800 font-semibold text-sm">Requirements Verified</p>
                        <p class="text-green-700 text-xs mt-1">1 day ago</p>
                    </div>

                    <div class="bg-purple-50 border-l-4 border-purple-500 p-3 rounded">
                        <p class="text-purple-800 font-semibold text-sm">Application Received</p>
                        <p class="text-purple-700 text-xs mt-1">3 days ago</p>
                    </div>

                    <a href="{{ route('driver.notifications') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold block">View All Notifications</a>
                </div>
            </div>

        </div>
    </div>

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Driver Dashboard</h1>
            <p class="text-gray-600 mt-2">Welcome back, {{ Auth::user()->name }}!</p>
        </div>

        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Today's Earnings -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Today's Earnings</p>
                        <h3 class="text-3xl font-bold mt-2">₱850.00</h3>
                        <p class="text-green-100 text-xs mt-1">+15% from yesterday</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-peso-sign text-3xl"></i>
                    </div>
                </div>
            </div>

            <!-- Trips Completed -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Trips Today</p>
                        <h3 class="text-3xl font-bold mt-2">24</h3>
                        <p class="text-blue-100 text-xs mt-1">12 trips remaining</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-route text-3xl"></i>
                    </div>
                </div>
            </div>

            <!-- This Week's Total -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Weekly Earnings</p>
                        <h3 class="text-3xl font-bold mt-2">₱4,250.00</h3>
                        <p class="text-purple-100 text-xs mt-1">5 days this week</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-calendar-week text-3xl"></i>
                    </div>
                </div>
            </div>

            <!-- Vehicle Status -->
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Vehicle Status</p>
                        <h3 class="text-2xl font-bold mt-2">Active</h3>
                        <p class="text-orange-100 text-xs mt-1">Last inspection: 3 days ago</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-car text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

            <!-- Left Column - Vehicle & Route Info -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Vehicle Information -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-800">My Tricycle Information</h2>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Active</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-gray-500 text-sm">Plate Number</p>
                            <p class="text-gray-800 font-bold text-lg">ABC-1234</p>
                        </div>
                        <div class="border-l-4 border-green-500 pl-4">
                            <p class="text-gray-500 text-sm">Unit Number</p>
                            <p class="text-gray-800 font-bold text-lg">TC-045</p>
                        </div>
                        <div class="border-l-4 border-purple-500 pl-4">
                            <p class="text-gray-500 text-sm">Franchise Number</p>
                            <p class="text-gray-800 font-bold text-lg">FR-2024-0345</p>
                        </div>
                        <div class="border-l-4 border-orange-500 pl-4">
                            <p class="text-gray-500 text-sm">Route</p>
                            <p class="text-gray-800 font-bold text-lg">Route A</p>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-calendar-check text-blue-600"></i>
                                <span class="text-gray-600 text-sm">Next Inspection Due:</span>
                            </div>
                            <span class="text-gray-800 font-semibold">October 15, 2025</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Trips -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Recent Trips</h2>
                        <button class="text-blue-600 hover:text-blue-700 text-sm font-semibold">View All</button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Time</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Route</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold text-sm">Passengers</th>
                                    <th class="text-right py-3 px-4 text-gray-600 font-semibold text-sm">Fare</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4 text-gray-800">2:30 PM</td>
                                    <td class="py-3 px-4 text-gray-800">Church → Market</td>
                                    <td class="py-3 px-4 text-gray-800">3</td>
                                    <td class="py-3 px-4 text-gray-800 font-semibold text-right">₱45.00</td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4 text-gray-800">2:15 PM</td>
                                    <td class="py-3 px-4 text-gray-800">Market → Terminal</td>
                                    <td class="py-3 px-4 text-gray-800">2</td>
                                    <td class="py-3 px-4 text-gray-800 font-semibold text-right">₱30.00</td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4 text-gray-800">1:45 PM</td>
                                    <td class="py-3 px-4 text-gray-800">Terminal → School</td>
                                    <td class="py-3 px-4 text-gray-800">4</td>
                                    <td class="py-3 px-4 text-gray-800 font-semibold text-right">₱60.00</td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4 text-gray-800">1:20 PM</td>
                                    <td class="py-3 px-4 text-gray-800">School → Church</td>
                                    <td class="py-3 px-4 text-gray-800">1</td>
                                    <td class="py-3 px-4 text-gray-800 font-semibold text-right">₱15.00</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 text-gray-800">12:50 PM</td>
                                    <td class="py-3 px-4 text-gray-800">Church → Market</td>
                                    <td class="py-3 px-4 text-gray-800">2</td>
                                    <td class="py-3 px-4 text-gray-800 font-semibold text-right">₱30.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Right Column - Additional Info -->
            <div class="space-y-6">

                <!-- Payment Due -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Payment Status</h2>
                        <i class="fas fa-wallet text-2xl text-blue-600"></i>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                            <p class="text-yellow-800 font-semibold text-sm">Boundary Payment Due</p>
                            <p class="text-yellow-900 text-2xl font-bold mt-1">₱350.00</p>
                            <p class="text-yellow-700 text-xs mt-2">Due: End of Day</p>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Weekly Boundary</span>
                                <span class="text-gray-800 font-semibold">₱2,450.00</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Paid This Week</span>
                                <span class="text-green-600 font-semibold">₱1,750.00</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Balance</span>
                                <span class="text-orange-600 font-semibold">₱700.00</span>
                            </div>
                        </div>

                        <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                            Submit Payment
                        </button>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>

                    <div class="space-y-3">
                        <button class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition font-semibold flex items-center justify-center space-x-2">
                            <i class="fas fa-plus-circle"></i>
                            <span>Log New Trip</span>
                        </button>

                        <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition font-semibold flex items-center justify-center space-x-2">
                            <i class="fas fa-file-alt"></i>
                            <span>Daily Report</span>
                        </button>

                        <button class="w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white py-3 rounded-lg hover:from-purple-600 hover:to-purple-700 transition font-semibold flex items-center justify-center space-x-2">
                            <i class="fas fa-history"></i>
                            <span>View History</span>
                        </button>
                    </div>
                </div>

                <!-- Announcements -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Announcements</h2>

                    <div class="space-y-3">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded">
                            <p class="text-blue-800 font-semibold text-sm">New Route Guidelines</p>
                            <p class="text-blue-700 text-xs mt-1">Posted 2 days ago</p>
                        </div>

                        <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded">
                            <p class="text-green-800 font-semibold text-sm">Safety Reminder</p>
                            <p class="text-green-700 text-xs mt-1">Posted 5 days ago</p>
                        </div>

                        <button class="text-blue-600 hover:text-blue-700 text-sm font-semibold">View All Announcements</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Earnings Chart -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Weekly Earnings Overview</h2>

            <div class="flex items-end justify-between h-64 space-x-4">
                <div class="flex-1 flex flex-col items-center justify-end">
                    <div class="w-full bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg hover:from-blue-600 hover:to-blue-500 transition cursor-pointer" style="height: 70%;">
                        <div class="text-center text-white font-bold pt-2">₱750</div>
                    </div>
                    <p class="text-gray-600 text-sm mt-2 font-medium">Mon</p>
                </div>
                <div class="flex-1 flex flex-col items-center justify-end">
                    <div class="w-full bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg hover:from-blue-600 hover:to-blue-500 transition cursor-pointer" style="height: 85%;">
                        <div class="text-center text-white font-bold pt-2">₱900</div>
                    </div>
                    <p class="text-gray-600 text-sm mt-2 font-medium">Tue</p>
                </div>
                <div class="flex-1 flex flex-col items-center justify-end">
                    <div class="w-full bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg hover:from-blue-600 hover:to-blue-500 transition cursor-pointer" style="height: 60%;">
                        <div class="text-center text-white font-bold pt-2">₱650</div>
                    </div>
                    <p class="text-gray-600 text-sm mt-2 font-medium">Wed</p>
                </div>
                <div class="flex-1 flex flex-col items-center justify-end">
                    <div class="w-full bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg hover:from-blue-600 hover:to-blue-500 transition cursor-pointer" style="height: 95%;">
                        <div class="text-center text-white font-bold pt-2">₱1,100</div>
                    </div>
                    <p class="text-gray-600 text-sm mt-2 font-medium">Thu</p>
                </div>
                <div class="flex-1 flex flex-col items-center justify-end">
                    <div class="w-full bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg hover:from-blue-600 hover:to-blue-500 transition cursor-pointer" style="height: 75%;">
                        <div class="text-center text-white font-bold pt-2">₱850</div>
                    </div>
                    <p class="text-gray-600 text-sm mt-2 font-medium">Fri</p>
                </div>
                <div class="flex-1 flex flex-col items-center justify-end">
                    <div class="w-full bg-gradient-to-t from-gray-300 to-gray-200 rounded-t-lg opacity-50" style="height: 20%;">
                        <div class="text-center text-gray-600 font-bold pt-2 text-sm">-</div>
                    </div>
                    <p class="text-gray-400 text-sm mt-2 font-medium">Sat</p>
                </div>
                <div class="flex-1 flex flex-col items-center justify-end">
                    <div class="w-full bg-gradient-to-t from-gray-300 to-gray-200 rounded-t-lg opacity-50" style="height: 20%;">
                        <div class="text-center text-gray-600 font-bold pt-2 text-sm">-</div>
                    </div>
                    <p class="text-gray-400 text-sm mt-2 font-medium">Sun</p>
                </div>
            </div>
        </div>
    </div>
@endsection
