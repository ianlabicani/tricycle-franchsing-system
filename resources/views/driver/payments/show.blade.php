@extends('driver.shell')

@section('driver-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('driver.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('driver.payments') }}" class="hover:text-purple-600">Payments</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Payment Details</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Payment Details</h1>
                <p class="text-gray-600 mt-2">{{ $payment->payment_no }}</p>
            </div>
            <a href="{{ route('driver.payments') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Payments
            </a>
        </div>
    </div>

    <!-- Payment Status Card -->
    <div class="bg-gradient-to-r {{ $payment->status === 'paid' ? 'from-green-600 to-emerald-600' : ($payment->status === 'cancelled' ? 'from-red-600 to-rose-600' : 'from-blue-600 to-indigo-600') }} rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Payment Status</h2>
                <p class="text-opacity-90 mb-4">
                    @if($payment->status === 'pending')
                        Awaiting Payment
                    @elseif($payment->status === 'paid')
                        Payment Verified
                    @else
                        Cancelled
                    @endif
                </p>
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-opacity-75 text-sm">Payment No.</p>
                        <p class="text-xl font-bold">{{ $payment->payment_no }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-opacity-75 text-sm">Total Amount</p>
                        <p class="text-xl font-bold">₱{{ number_format($payment->total_amount, 2) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-opacity-75 text-sm">Status</p>
                        <p class="text-xl font-bold">{{ ucfirst($payment->status) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-6">
                <i class="fas fa-file-invoice-dollar text-6xl"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Payment Items -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Payment Breakdown</h2>

                <div class="space-y-3">
                    @foreach($payment->payment_items as $item)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-receipt text-indigo-600 text-xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-gray-800">₱{{ number_format($item['amount'], 2) }}</p>
                        </div>
                    </div>
                    @endforeach

                    <!-- Total -->
                    <div class="flex items-center justify-between p-4 bg-indigo-50 rounded-lg border-2 border-indigo-200 mt-4">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-calculator text-indigo-600 text-xl"></i>
                            <div>
                                <p class="font-bold text-gray-800 text-lg">TOTAL AMOUNT</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-indigo-600">₱{{ number_format($payment->total_amount, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Information -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Application Information</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Application No.</span>
                        <a href="{{ route('driver.application.show', $payment->application) }}" class="font-bold text-purple-600 hover:text-purple-700">
                            {{ $payment->application->application_no }}
                        </a>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Franchise Type</span>
                        <span class="font-bold text-gray-800">{{ ucfirst($payment->application->franchise_type) }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Application Status</span>
                        <span class="font-bold text-gray-800">{{ $payment->application->status_label }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Date Created</span>
                        <span class="font-bold text-gray-800">{{ $payment->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Timeline -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Payment Timeline</h2>

                <div class="relative">
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-300"></div>

                    <div class="space-y-6">
                        <!-- Created -->
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Payment Record Created</h3>
                                <p class="text-sm text-gray-600 mt-1">Created by {{ $payment->createdBy->name }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $payment->created_at->format('F d, Y - g:i A') }}</p>
                            </div>
                        </div>

                        <!-- Verified/Pending -->
                        @if($payment->status === 'paid')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check-double"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Payment Verified</h3>
                                <p class="text-sm text-gray-600 mt-1">Verified by {{ $payment->verifiedBy->name }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $payment->verified_at->format('F d, Y - g:i A') }}</p>
                            </div>
                        </div>
                        @elseif($payment->status === 'cancelled')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-red-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="flex-1 bg-red-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Payment Cancelled</h3>
                                <p class="text-sm text-gray-600 mt-1">Cancelled by {{ $payment->cancelledBy->name }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $payment->cancelled_at->format('F d, Y - g:i A') }}</p>
                            </div>
                        </div>
                        @else
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Awaiting Payment</h3>
                                <p class="text-sm text-gray-600 mt-1">Payment needs to be verified</p>
                                <p class="text-xs text-gray-500 mt-2">In Progress</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Payment Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Payment Summary</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Status</span>
                        @if($payment->status === 'pending')
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                        @elseif($payment->status === 'paid')
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Paid</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Cancelled</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Total Amount</span>
                        <span class="font-bold text-gray-800">₱{{ number_format($payment->total_amount, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Items</span>
                        <span class="font-bold text-gray-800">{{ count($payment->payment_items) }}</span>
                    </div>
                    @if($payment->paid_at)
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Paid On</span>
                        <span class="font-bold text-gray-800">{{ $payment->paid_at->format('M d, Y') }}</span>
                    </div>
                    @endif
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Created</span>
                        <span class="font-bold text-gray-800">{{ $payment->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
