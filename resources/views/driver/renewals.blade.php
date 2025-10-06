@extends('driver.shell')

@section('driver-content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Franchise Renewals</h1>
        <p class="text-gray-600 mt-2">Track and manage your franchise renewal schedule</p>
    </div>

    <!-- Current Franchise Status -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Current Franchise Status</h2>
                <p class="text-purple-100 mb-4">Your franchise is active and in good standing</p>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-3">
                        <p class="text-purple-100 text-sm">Issue Date</p>
                        <p class="text-xl font-bold">Mar 15, 2025</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-3">
                        <p class="text-purple-100 text-sm">Expiry Date</p>
                        <p class="text-xl font-bold">Mar 15, 2026</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-3">
                        <p class="text-purple-100 text-sm">Days Remaining</p>
                        <p class="text-xl font-bold">159 days</p>
                    </div>
                </div>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-6">
                <i class="fas fa-certificate text-6xl"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Renewal Reminders -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Renewal Reminders</h2>

                <div class="space-y-4">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-bell text-blue-600 text-xl mt-1"></i>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800">90-Day Notice</h3>
                                <p class="text-sm text-gray-600 mt-1">We'll send you a reminder 90 days before expiration</p>
                                <p class="text-xs text-gray-500 mt-2">Expected: December 15, 2025</p>
                            </div>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">Scheduled</span>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-bell text-yellow-600 text-xl mt-1"></i>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800">30-Day Notice</h3>
                                <p class="text-sm text-gray-600 mt-1">Final reminder 30 days before expiration</p>
                                <p class="text-xs text-gray-500 mt-2">Expected: February 13, 2026</p>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">Scheduled</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Renewal Requirements -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Renewal Requirements</h2>

                <p class="text-gray-600 mb-4">Make sure to prepare these documents for your renewal application:</p>

                <div class="space-y-3">
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Valid Driver's License</p>
                            <p class="text-sm text-gray-500">Updated and not expired</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Vehicle Registration (OR/CR)</p>
                            <p class="text-sm text-gray-500">Current year registration</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Medical Certificate</p>
                            <p class="text-sm text-gray-500">Not older than 6 months</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Clearances</p>
                            <p class="text-sm text-gray-500">Police and Barangay clearances</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Proof of Payment</p>
                            <p class="text-sm text-gray-500">No pending fees or violations</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Renewal History -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Renewal History</h2>

                <div class="space-y-4">
                    <div class="flex items-start space-x-4 p-4 bg-green-50 border-l-4 border-green-500 rounded">
                        <i class="fas fa-check-circle text-green-600 text-2xl mt-1"></i>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold text-gray-800">2024-2025 Franchise</h3>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Completed</span>
                            </div>
                            <p class="text-sm text-gray-600">Renewed on: March 15, 2025</p>
                            <p class="text-xs text-gray-500 mt-1">Fee Paid: ₱5,000.00 | Valid until: March 15, 2026</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 bg-green-50 border-l-4 border-green-500 rounded">
                        <i class="fas fa-check-circle text-green-600 text-2xl mt-1"></i>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold text-gray-800">2023-2024 Franchise</h3>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Completed</span>
                            </div>
                            <p class="text-sm text-gray-600">Renewed on: March 10, 2024</p>
                            <p class="text-xs text-gray-500 mt-1">Fee Paid: ₱4,800.00 | Valid until: March 15, 2025</p>
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
                    <button disabled class="w-full bg-gray-300 text-gray-500 py-3 rounded-lg font-semibold cursor-not-allowed">
                        <i class="fas fa-sync-alt mr-2"></i>Start Renewal
                    </button>
                    <p class="text-xs text-center text-gray-500">Available 90 days before expiration</p>

                    <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-download mr-2"></i>Download Certificate
                    </button>
                </div>
            </div>

            <!-- Renewal Timeline -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Renewal Timeline</h2>

                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="bg-green-100 p-2 rounded">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Today</p>
                            <p class="text-xs text-gray-500">Franchise active</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="bg-blue-100 p-2 rounded">
                            <i class="fas fa-bell text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Dec 15, 2025</p>
                            <p class="text-xs text-gray-500">90-day reminder</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="bg-yellow-100 p-2 rounded">
                            <i class="fas fa-exclamation text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Feb 13, 2026</p>
                            <p class="text-xs text-gray-500">30-day reminder</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="bg-red-100 p-2 rounded">
                            <i class="fas fa-calendar-times text-red-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Mar 15, 2026</p>
                            <p class="text-xs text-gray-500">Expiration date</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification Settings -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Notifications</h2>

                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope text-blue-600"></i>
                            <span class="text-sm text-gray-700">Email Reminders</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-mobile-alt text-green-600"></i>
                            <span class="text-sm text-gray-700">SMS Alerts</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
