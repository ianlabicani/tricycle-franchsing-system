@extends('driver.shell')

@section('driver-content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Payments & Fees</h1>
        <p class="text-gray-600 mt-2">Manage your franchise fees and payment history</p>
    </div>

    <!-- Payment Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Total Fees</p>
                    <h3 class="text-3xl font-bold mt-2">₱8,500.00</h3>
                    <p class="text-orange-100 text-xs mt-1">Franchise Application</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-file-invoice-dollar text-3xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Amount Paid</p>
                    <h3 class="text-3xl font-bold mt-2">₱0.00</h3>
                    <p class="text-green-100 text-xs mt-1">No payments yet</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-check-circle text-3xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium">Balance Due</p>
                    <h3 class="text-3xl font-bold mt-2">₱8,500.00</h3>
                    <p class="text-red-100 text-xs mt-1">After inspection</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-exclamation-circle text-3xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Fee Breakdown -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Fee Breakdown</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <i class="fas fa-clipboard-check text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Inspection Fee</p>
                                <p class="text-sm text-gray-500">Vehicle safety inspection</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-800">₱1,500.00</p>
                            <p class="text-xs text-yellow-600">Pending</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="bg-green-100 p-3 rounded-lg">
                                <i class="fas fa-file-alt text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Processing Fee</p>
                                <p class="text-sm text-gray-500">Application processing</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-800">₱2,000.00</p>
                            <p class="text-xs text-yellow-600">Pending</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="bg-purple-100 p-3 rounded-lg">
                                <i class="fas fa-certificate text-purple-600"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Franchise Fee</p>
                                <p class="text-sm text-gray-500">Annual franchise permit</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-800">₱5,000.00</p>
                            <p class="text-xs text-yellow-600">Pending</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border-t-2 border-blue-500">
                        <div>
                            <p class="font-bold text-gray-800 text-lg">Total Amount</p>
                            <p class="text-sm text-gray-500">All fees included</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-blue-600">₱8,500.00</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment History -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Payment History</h2>
                    <button class="text-blue-600 hover:text-blue-700 text-sm font-semibold">View All</button>
                </div>

                <div class="text-center py-12">
                    <div class="bg-gray-100 rounded-full p-6 w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-receipt text-gray-400 text-4xl"></i>
                    </div>
                    <p class="text-gray-600 font-semibold">No payment history yet</p>
                    <p class="text-sm text-gray-500 mt-2">Your payment transactions will appear here</p>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Payment Instructions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Payment Instructions</h2>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded mb-4">
                    <p class="text-blue-800 font-semibold text-sm mb-2">When to Pay</p>
                    <p class="text-blue-700 text-sm">Payment is required after your vehicle inspection is completed and approved.</p>
                </div>

                <div class="space-y-3">
                    <div>
                        <h3 class="font-bold text-gray-800 mb-2 text-sm">Payment Methods:</h3>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <i class="fas fa-university text-blue-600"></i>
                                <span>Over-the-counter (Treasury Office)</span>
                            </div>
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <i class="fas fa-mobile-alt text-green-600"></i>
                                <span>GCash / PayMaya</span>
                            </div>
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <i class="fas fa-credit-card text-purple-600"></i>
                                <span>Bank Transfer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Make Payment -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Make a Payment</h2>

                <div class="space-y-3">
                    <button disabled class="w-full bg-gray-300 text-gray-500 py-3 rounded-lg font-semibold cursor-not-allowed">
                        <i class="fas fa-lock mr-2"></i>Pay Online
                    </button>

                    <p class="text-xs text-center text-gray-500">Online payment available after inspection approval</p>

                    <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-download mr-2"></i>Download Invoice
                    </button>
                </div>
            </div>

            <!-- Treasury Office Info -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Treasury Office</h2>

                <div class="space-y-3 text-sm">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt text-red-600 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Address</p>
                            <p class="text-gray-600">123 Franchise Center, 2nd Floor</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <i class="fas fa-clock text-blue-600 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Office Hours</p>
                            <p class="text-gray-600">Mon-Fri: 8:00 AM - 5:00 PM</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <i class="fas fa-phone text-green-600 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Contact</p>
                            <p class="text-gray-600">+63 123 456 7890</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Tips -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                <div class="flex items-start space-x-2">
                    <i class="fas fa-lightbulb text-yellow-600 mt-1"></i>
                    <div>
                        <p class="font-semibold text-yellow-800 text-sm mb-2">Payment Tips</p>
                        <ul class="text-yellow-700 text-xs space-y-1">
                            <li>• Keep your payment receipts</li>
                            <li>• Pay within 7 days of inspection</li>
                            <li>• Verify amounts before paying</li>
                            <li>• Request official receipt</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
