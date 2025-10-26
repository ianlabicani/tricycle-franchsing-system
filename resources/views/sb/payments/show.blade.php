@extends('sb.shell')

@section('sb-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('sb.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('sb.payments.index') }}" class="hover:text-purple-600">Payments</a></li>
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
            <a href="{{ route('sb.payments.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Payments
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-6">
            <div class="flex items-center space-x-3">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                <p class="text-green-800 font-semibold">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
            <div class="flex items-center space-x-3">
                <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                <p class="text-red-800 font-semibold">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Payment Status Card -->
    <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Payment Status</h2>
                <p class="text-indigo-100 mb-4">
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
                        <p class="text-indigo-100 text-sm">Payment No.</p>
                        <p class="text-xl font-bold">{{ $payment->payment_no }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-indigo-100 text-sm">Total Amount</p>
                        <p class="text-xl font-bold">₱{{ number_format($payment->total_amount, 2) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-indigo-100 text-sm">Status</p>
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
                        <a href="{{ route('sb.applications.show', $payment->application) }}" class="font-bold text-purple-600 hover:text-purple-700">
                            {{ $payment->application->application_no }}
                        </a>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Applicant Name</span>
                        <span class="font-bold text-gray-800">{{ $payment->application->user->name }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Email</span>
                        <span class="font-bold text-gray-800">{{ $payment->application->user->email }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Franchise Type</span>
                        <span class="font-bold text-gray-800">{{ ucfirst($payment->application->franchise_type) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Application Status</span>
                        <span class="font-bold text-gray-800">{{ $payment->application->status_label }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Notes -->
            @if($payment->notes)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Notes</h2>
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                    <p class="text-yellow-800">{{ $payment->notes }}</p>
                </div>
            </div>
            @endif

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
                                <p class="text-sm text-gray-600 mt-1">Driver needs to pay at treasury</p>
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

            <!-- Actions -->
            @if($payment->status === 'pending')
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Actions</h2>

                <div class="space-y-3">
                    <button onclick="openVerifyModal()" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition font-semibold">
                        <i class="fas fa-check-circle mr-2"></i>Verify Payment
                    </button>

                    <button onclick="openCancelModal()" class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition font-semibold">
                        <i class="fas fa-times-circle mr-2"></i>Cancel Payment
                    </button>
                </div>
            </div>
            @endif

            <!-- Payment Breakdown PDF -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Payment Breakdown</h2>

                <div class="space-y-3">
                    <a href="{{ route('sb.payments.pdf.preview', $payment) }}" target="_blank" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold flex items-center justify-center">
                        <i class="fas fa-eye mr-2"></i>View PDF
                    </a>

                    <a href="{{ route('sb.payments.pdf.download', $payment) }}" class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition font-semibold flex items-center justify-center">
                        <i class="fas fa-download mr-2"></i>Download PDF
                    </a>
                </div>
            </div>



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

    <!-- Verify Payment Modal -->
    <div id="verifyModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Verify Payment</h3>
            <form action="{{ route('sb.payments.verify', $payment) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Date <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="paid_at" value="{{ now()->format('Y-m-d\TH:i') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                    <p class="text-xs text-gray-500 mt-1">When did the driver make the payment?</p>
                </div>
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded mb-4">
                    <p class="text-sm text-green-800">This will mark the payment as verified and update the application status to "For Approval".</p>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeVerifyModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">
                        Verify Payment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cancel Payment Modal -->
    <div id="cancelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Cancel Payment</h3>
            <form action="{{ route('sb.payments.cancel', $payment) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Cancellation <span class="text-red-500">*</span></label>
                    <textarea name="reason" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Please provide a reason for cancelling this payment..." required></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeCancelModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                        Cancel Payment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openVerifyModal() {
            document.getElementById('verifyModal').classList.remove('hidden');
            document.getElementById('verifyModal').classList.add('flex');
        }

        function closeVerifyModal() {
            document.getElementById('verifyModal').classList.add('hidden');
            document.getElementById('verifyModal').classList.remove('flex');
        }

        function openCancelModal() {
            document.getElementById('cancelModal').classList.remove('hidden');
            document.getElementById('cancelModal').classList.add('flex');
        }

        function closeCancelModal() {
            document.getElementById('cancelModal').classList.add('hidden');
            document.getElementById('cancelModal').classList.remove('flex');
        }
    </script>

@endsection
