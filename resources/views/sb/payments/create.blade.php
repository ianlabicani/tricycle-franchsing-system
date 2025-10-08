@extends('sb.shell')

@section('sb-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('sb.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('sb.payments.index') }}" class="hover:text-purple-600">Payments</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Create Payment</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Create Payment Record</h1>
                <p class="text-gray-600 mt-2">Generate payment details for franchise application</p>
            </div>
            <a href="{{ route('sb.payments.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Payments
            </a>
        </div>
    </div>

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
            <div class="flex items-center space-x-3">
                <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                <p class="text-red-800 font-semibold">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <form action="{{ route('sb.payments.store') }}" method="POST" id="paymentForm">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Application Selection -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Application Information</h2>

                    @if($application)
                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="bg-purple-50 border-2 border-purple-200 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Application Number</p>
                                    <p class="text-lg font-bold text-purple-600">{{ $application->application_no }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Applicant</p>
                                    <p class="text-lg font-bold text-gray-800">{{ $application->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Status</p>
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $application->status_label }}
                                    </span>
                                </div>
                            </div>

                            @if($application->latestInspection)
                            <div class="mt-4 pt-4 border-t border-purple-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600">Inspection Result</p>
                                        <p class="text-base font-bold text-green-600">
                                            <i class="fas fa-check-circle mr-1"></i>PASSED
                                        </p>
                                    </div>
                                    <a href="{{ route('sb.inspections.show', $application->latestInspection) }}" class="text-purple-600 hover:text-purple-800 font-semibold text-sm">
                                        <i class="fas fa-arrow-left mr-1"></i>Back to Inspection
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Application <span class="text-red-500">*</span></label>
                            <select name="application_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="">Select an application...</option>
                                <!-- This would be populated with applications that are in 'for_treasury' status -->
                            </select>
                        </div>
                    @endif
                </div>

                <!-- Payment Items -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Payment Items</h2>
                        <button type="button" onclick="addPaymentItem()" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold text-sm">
                            <i class="fas fa-plus mr-1"></i>Add Item
                        </button>
                    </div>

                    <div id="paymentItems" class="space-y-3">
                        <!-- Default payment items -->
                        <div class="payment-item p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                                    <input type="text" name="payment_items[0][name]" value="Filing Fee" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                                </div>
                                <div class="w-48">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₱)</label>
                                    <input type="number" name="payment_items[0][amount]" value="500" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent item-amount" required oninput="calculateTotal()">
                                </div>
                                <button type="button" onclick="removePaymentItem(this)" class="mt-6 text-red-600 hover:text-red-700">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <div class="payment-item p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                                    <input type="text" name="payment_items[1][name]" value="Annual Franchise Fee" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                                </div>
                                <div class="w-48">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₱)</label>
                                    <input type="number" name="payment_items[1][amount]" value="2000" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent item-amount" required oninput="calculateTotal()">
                                </div>
                                <button type="button" onclick="removePaymentItem(this)" class="mt-6 text-red-600 hover:text-red-700">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <div class="payment-item p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                                    <input type="text" name="payment_items[2][name]" value="Mayor's Permit" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                                </div>
                                <div class="w-48">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₱)</label>
                                    <input type="number" name="payment_items[2][amount]" value="1500" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent item-amount" required oninput="calculateTotal()">
                                </div>
                                <button type="button" onclick="removePaymentItem(this)" class="mt-6 text-red-600 hover:text-red-700">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <div class="payment-item p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                                    <input type="text" name="payment_items[3][name]" value="Sticker Fee" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                                </div>
                                <div class="w-48">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₱)</label>
                                    <input type="number" name="payment_items[3][amount]" value="200" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent item-amount" required oninput="calculateTotal()">
                                </div>
                                <button type="button" onclick="removePaymentItem(this)" class="mt-6 text-red-600 hover:text-red-700">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <div class="payment-item p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                                    <input type="text" name="payment_items[4][name]" value="ID Card" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                                </div>
                                <div class="w-48">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₱)</label>
                                    <input type="number" name="payment_items[4][amount]" value="150" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent item-amount" required oninput="calculateTotal()">
                                </div>
                                <button type="button" onclick="removePaymentItem(this)" class="mt-6 text-red-600 hover:text-red-700">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="mt-6 p-4 bg-indigo-50 rounded-lg border-2 border-indigo-200">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-gray-800">TOTAL AMOUNT</span>
                            <span id="totalAmount" class="text-2xl font-bold text-indigo-600">₱4,350.00</span>
                        </div>
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Additional Notes</h2>
                    <textarea name="notes" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Add any notes or special instructions..."></textarea>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="space-y-6">

                <!-- Summary -->
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Summary</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex items-center justify-between pb-3 border-b">
                            <span class="text-gray-600">Total Items</span>
                            <span id="itemCount" class="font-bold text-gray-800">5</span>
                        </div>
                        <div class="flex items-center justify-between pb-3 border-b">
                            <span class="text-gray-600">Total Amount</span>
                            <span id="summaryTotal" class="font-bold text-indigo-600">₱4,350.00</span>
                        </div>
                    </div>

                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded mb-6">
                        <p class="text-sm text-blue-800">
                            <i class="fas fa-info-circle mr-1"></i>
                            Payment record will be created with "Pending" status. Driver must pay at treasury, then you can verify the payment.
                        </p>
                    </div>

                    <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition font-semibold">
                        <i class="fas fa-save mr-2"></i>Create Payment Record
                    </button>
                </div>

            </div>
        </div>
    </form>

    <script>
        let itemCounter = 5;

        function addPaymentItem() {
            const itemsContainer = document.getElementById('paymentItems');
            const newItem = document.createElement('div');
            newItem.className = 'payment-item p-4 bg-gray-50 rounded-lg border border-gray-200';
            newItem.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                        <input type="text" name="payment_items[${itemCounter}][name]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    </div>
                    <div class="w-48">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₱)</label>
                        <input type="number" name="payment_items[${itemCounter}][amount]" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent item-amount" required oninput="calculateTotal()">
                    </div>
                    <button type="button" onclick="removePaymentItem(this)" class="mt-6 text-red-600 hover:text-red-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            `;
            itemsContainer.appendChild(newItem);
            itemCounter++;
            calculateTotal();
        }

        function removePaymentItem(button) {
            const item = button.closest('.payment-item');
            item.remove();
            calculateTotal();
        }

        function calculateTotal() {
            const amounts = document.querySelectorAll('.item-amount');
            let total = 0;
            amounts.forEach(input => {
                const value = parseFloat(input.value) || 0;
                total += value;
            });

            const formattedTotal = '₱' + total.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('totalAmount').textContent = formattedTotal;
            document.getElementById('summaryTotal').textContent = formattedTotal;
            document.getElementById('itemCount').textContent = amounts.length;
        }

        // Calculate initial total
        calculateTotal();
    </script>

@endsection
