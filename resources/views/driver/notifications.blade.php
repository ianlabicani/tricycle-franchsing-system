@extends('driver.shell')

@section('driver-content')

    <!-- Page Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Notifications</h1>
            <p class="text-gray-600 mt-2">Stay updated with your application progress</p>
        </div>
        <button class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
            <i class="fas fa-check-double mr-1"></i>Mark all as read
        </button>
    </div>

    <!-- Notification Filters -->
    <div class="bg-white rounded-xl shadow-lg p-4 mb-6">
        <div class="flex items-center space-x-4">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold text-sm">All</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-200">Unread</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-200">Application</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-200">Payments</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-200">System</button>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="space-y-4">

        <!-- Today -->
        <div>
            <h2 class="text-sm font-bold text-gray-500 uppercase mb-3">Today</h2>

            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl shadow p-4 mb-3">
                <div class="flex items-start space-x-4">
                    <div class="bg-blue-600 text-white rounded-full p-3">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-bold text-gray-800">Inspection Scheduled</h3>
                            <span class="text-xs text-gray-500">2 hours ago</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">Your vehicle inspection has been scheduled for October 12, 2025 at 10:00 AM. Inspector Reyes has been assigned to your case.</p>
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-700 text-xs font-semibold">View Details</button>
                            <button class="text-gray-500 hover:text-gray-700 text-xs font-semibold">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border-l-4 border-gray-300 rounded-xl shadow p-4 mb-3">
                <div class="flex items-start space-x-4">
                    <div class="bg-gray-400 text-white rounded-full p-3">
                        <i class="fas fa-info-circle text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-bold text-gray-800">System Maintenance Notice</h3>
                            <span class="text-xs text-gray-500">5 hours ago</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">System maintenance is scheduled for October 8, 2025 from 2:00 AM to 4:00 AM. Some services may be temporarily unavailable.</p>
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-gray-700 text-xs font-semibold">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Yesterday -->
        <div>
            <h2 class="text-sm font-bold text-gray-500 uppercase mb-3">Yesterday</h2>

            <div class="bg-white border-l-4 border-gray-300 rounded-xl shadow p-4 mb-3">
                <div class="flex items-start space-x-4">
                    <div class="bg-green-600 text-white rounded-full p-3">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-bold text-gray-800">Documents Verified</h3>
                            <span class="text-xs text-gray-500">1 day ago</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">All your submitted documents have been verified and approved. You can now proceed to the next step of your application.</p>
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-gray-700 text-xs font-semibold">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Week -->
        <div>
            <h2 class="text-sm font-bold text-gray-500 uppercase mb-3">This Week</h2>

            <div class="bg-white border-l-4 border-gray-300 rounded-xl shadow p-4 mb-3">
                <div class="flex items-start space-x-4">
                    <div class="bg-purple-600 text-white rounded-full p-3">
                        <i class="fas fa-file-upload text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-bold text-gray-800">Medical Certificate Uploaded</h3>
                            <span class="text-xs text-gray-500">3 days ago</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">Your medical certificate has been successfully uploaded. Awaiting verification by SB Staff.</p>
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-gray-700 text-xs font-semibold">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border-l-4 border-gray-300 rounded-xl shadow p-4 mb-3">
                <div class="flex items-start space-x-4">
                    <div class="bg-purple-600 text-white rounded-full p-3">
                        <i class="fas fa-file-upload text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-bold text-gray-800">Clearances Uploaded</h3>
                            <span class="text-xs text-gray-500">4 days ago</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">Police and Barangay clearances have been successfully uploaded and are under review.</p>
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-gray-700 text-xs font-semibold">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border-l-4 border-gray-300 rounded-xl shadow p-4 mb-3">
                <div class="flex items-start space-x-4">
                    <div class="bg-blue-600 text-white rounded-full p-3">
                        <i class="fas fa-paper-plane text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-bold text-gray-800">Application Submitted</h3>
                            <span class="text-xs text-gray-500">5 days ago</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">Your franchise application form has been successfully submitted. Application ID: FR-2025-0123</p>
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-gray-700 text-xs font-semibold">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border-l-4 border-gray-300 rounded-xl shadow p-4 mb-3">
                <div class="flex items-start space-x-4">
                    <div class="bg-green-600 text-white rounded-full p-3">
                        <i class="fas fa-user-check text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-bold text-gray-800">Account Verified</h3>
                            <span class="text-xs text-gray-500">6 days ago</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">Welcome! Your account has been verified. You can now start your franchise application process.</p>
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-gray-700 text-xs font-semibold">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Load More -->
    <div class="text-center mt-8">
        <button class="bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-50 transition font-semibold">
            <i class="fas fa-chevron-down mr-2"></i>Load More Notifications
        </button>
    </div>

@endsection
