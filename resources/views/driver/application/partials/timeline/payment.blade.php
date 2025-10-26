<!-- 4. Payment -->
@if($application->status === 'for_treasury')
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="flex-1 bg-blue-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Payment Required</h3>
            <p class="text-sm text-gray-600 mt-1">Please proceed to treasury for payment</p>
            @if($application->latestPayment)
                <p class="text-sm text-blue-700 mt-2">
                    <strong>Payment No:</strong> {{ $application->latestPayment->payment_no }}<br>
                    <strong>Amount:</strong> ₱{{ number_format($application->latestPayment->total_amount, 2) }}
                </p>
            @endif
            <p class="text-xs text-gray-500 mt-2">
                <i class="fas fa-spinner fa-spin mr-1"></i>
                Awaiting Payment
            </p>
        </div>
    </div>
@elseif(in_array($application->status, ['for_approval', 'approved', 'released', 'completed']))
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
            <i class="fas fa-check"></i>
        </div>
        <div class="flex-1 bg-green-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Payment Verified</h3>
            @if($application->latestPayment)
                <p class="text-sm text-gray-600 mt-1">
                    Payment of ₱{{ number_format($application->latestPayment->total_amount, 2) }} has been verified
                </p>
                <p class="text-sm text-gray-600">Payment No: {{ $application->latestPayment->payment_no }}</p>
            @else
                <p class="text-sm text-gray-600 mt-1">Payment has been verified</p>
            @endif
            @if($application->payment_verified_at)
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $application->payment_verified_at->format('F d, Y - g:i A') }}
                </p>
            @endif
        </div>
    </div>
@endif
