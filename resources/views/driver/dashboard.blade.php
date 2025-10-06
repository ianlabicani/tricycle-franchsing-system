@extends('driver.shell')

@section('driver-content')
    <div class="container mx-auto p-6">
        <!-- Dashboard Header -->
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
