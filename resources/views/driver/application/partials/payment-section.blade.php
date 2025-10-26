@if($application->status === 'for_treasury' && $application->latestPayment)
<!-- Payment Information -->
<div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
    <div class="flex items-start justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold mb-2">
                <i class="fas fa-money-bill-wave mr-2"></i>Payment Required
            </h2>
            <p class="text-green-100">Your inspection has passed. Please proceed to treasury for payment.</p>
        </div>
        <div class="bg-white bg-opacity-20 rounded-full p-4">
            <i class="fas fa-receipt text-4xl"></i>
        </div>
    </div>

    <div class="bg-white text-gray-800 rounded-lg p-6 mb-4">
        <div class="flex items-center justify-between mb-4 pb-4 border-b">
            <div>
                <p class="text-sm text-gray-600">Payment Number</p>
                <p class="text-xl font-bold text-purple-600" data-payment-no>{{ $application->latestPayment->payment_no }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-600">Total Amount</p>
                <p class="text-3xl font-bold text-green-600" data-total-amount>₱{{ number_format($application->latestPayment->total_amount, 2) }}</p>
            </div>
        </div>

        <div class="space-y-2">
            <h3 class="font-bold text-gray-800 mb-3">Payment Breakdown</h3>
            @foreach($application->latestPayment->payment_items as $item)
            <div class="flex items-center justify-between py-2 border-b border-gray-100" data-payment-item data-item-name="{{ $item['name'] }}" data-item-amount="{{ number_format($item['amount'], 2) }}">
                <span class="text-gray-700">{{ $item['name'] }}</span>
                <span class="font-semibold text-gray-800">₱{{ number_format($item['amount'], 2) }}</span>
            </div>
            @endforeach
            <div class="flex items-center justify-between py-3 bg-green-50 px-3 rounded-lg mt-3">
                <span class="font-bold text-gray-800">TOTAL</span>
                <span class="font-bold text-green-600 text-xl">₱{{ number_format($application->latestPayment->total_amount, 2) }}</span>
            </div>
            <button onclick="printPaymentBreakdown()" class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg transition font-semibold text-base flex items-center justify-center gap-2">
                <i class="fas fa-print"></i>
                <span>Print Payment Breakdown</span>
            </button>

        </div>
    </div>

    <div class="flex items-start justify-between gap-4 mb-4">
        <div class="bg-white bg-opacity-20 rounded-lg p-4 border-l-4 border-white flex-1">
            <h3 class="font-bold text-white mb-2"><i class="fas fa-info-circle mr-1"></i> Payment Instructions</h3>
            <ol class="space-y-2 text-green-100 text-sm">
                <li><strong>1.</strong> Proceed to the SB Treasury Office</li>
                <li><strong>2.</strong> Present this Payment Number: <span class="font-mono font-bold bg-white bg-opacity-20 px-2 py-1 rounded">{{ $application->latestPayment->payment_no }}</span></li>
                <li><strong>3.</strong> Pay the total amount of <strong>₱{{ number_format($application->latestPayment->total_amount, 2) }}</strong></li>
                <li><strong>4.</strong> Keep your official receipt for your records</li>
                <li><strong>5.</strong> After payment verification, your application will proceed to final approval</li>
            </ol>
        </div>
    </div>

    <div class="mt-4 bg-yellow-100 border-l-4 border-yellow-500 p-3 rounded">
        <p class="text-yellow-800 text-sm">
            <i class="fas fa-exclamation-triangle mr-1"></i>
            <strong>Important:</strong> Payment must be made within 30 days. After payment, please allow 1-2 business days for verification before your application proceeds to final approval.
        </p>
    </div>
</div>
@endif
