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
                    <h3 class="text-3xl font-bold mt-2">₱{{ number_format($totalFees, 2) }}</h3>
                    <p class="text-orange-100 text-xs mt-1">{{ $activeApplication ? ucfirst($activeApplication->franchise_type) . ' Franchise' : 'No active application' }}</p>
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
                    <h3 class="text-3xl font-bold mt-2">₱{{ number_format($totalPaid, 2) }}</h3>
                    <p class="text-green-100 text-xs mt-1">{{ $totalPaid > 0 ? 'Verified payments' : 'No payments yet' }}</p>
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
                    <h3 class="text-3xl font-bold mt-2">₱{{ number_format(max(0, $balanceDue), 2) }}</h3>
                    <p class="text-red-100 text-xs mt-1">{{ $balanceDue > 0 ? 'Remaining amount' : 'All paid' }}</p>
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

                @if($paymentBreakdown && count($paymentBreakdown) > 0)
                    <div class="space-y-4">
                        @php $totalAmount = 0; @endphp
                        @foreach($paymentBreakdown as $item)
                            @php $totalAmount += $item['amount'] ?? 0; @endphp
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-blue-100 p-3 rounded-lg">
                                        <i class="fas fa-receipt text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $item['name'] ?? 'Fee' }}</p>
                                        <p class="text-sm text-gray-500">Payment item</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-gray-800">₱{{ number_format($item['amount'] ?? 0, 2) }}</p>
                                    <p class="text-xs text-yellow-600">{{ $activeApplication ? ucfirst($activeApplication->status) : 'N/A' }}</p>
                                </div>
                            </div>
                        @endforeach

                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border-t-2 border-blue-500">
                            <div>
                                <p class="font-bold text-gray-800 text-lg">Total Amount</p>
                                <p class="text-sm text-gray-500">All fees included</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-blue-600">₱{{ number_format($totalAmount, 2) }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-file-invoice text-gray-400 text-4xl mb-3"></i>
                        <p class="text-gray-600 font-semibold">No fee breakdown available</p>
                        <p class="text-sm text-gray-500 mt-2">Fee details will appear after your application is processed</p>
                    </div>
                @endif
            </div>

            <!-- Payment History -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Payment History</h2>
                </div>

                @if($payments && count($payments) > 0)
                    <div class="space-y-3">
                        @foreach($payments as $payment)
                            <a href="{{ route('driver.payments.show', $payment) }}" class="block">
                                <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50 transition cursor-pointer hover:shadow-md">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center
                                            {{ $payment->status === 'paid' ? 'bg-green-100' : ($payment->status === 'cancelled' ? 'bg-red-100' : 'bg-yellow-100') }}">
                                            <i class="fas {{ $payment->status === 'paid' ? 'fa-check text-green-600' : ($payment->status === 'cancelled' ? 'fa-times text-red-600' : 'fa-clock text-yellow-600') }}"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $payment->payment_no }}</p>
                                            <p class="text-sm text-gray-500">{{ $payment->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="text-right">
                                            <p class="font-bold text-gray-800">₱{{ number_format($payment->total_amount, 2) }}</p>
                                            <p class="text-xs font-semibold {{ $payment->status === 'paid' ? 'text-green-600' : ($payment->status === 'cancelled' ? 'text-red-600' : 'text-yellow-600') }}">
                                                {{ ucfirst($payment->status) }}
                                            </p>
                                        </div>
                                        <div class="text-gray-400">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="bg-gray-100 rounded-full p-6 w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-receipt text-gray-400 text-4xl"></i>
                        </div>
                        <p class="text-gray-600 font-semibold">No payment history yet</p>
                        <p class="text-sm text-gray-500 mt-2">Your payment transactions will appear here</p>
                    </div>
                @endif
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
