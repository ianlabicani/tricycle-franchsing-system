<!-- 6. Documents Released & 7. Completed -->
@if($application->status === 'released' || $application->status === 'completed')
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
            <i class="fas fa-check"></i>
        </div>
        <div class="flex-1 bg-green-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Documents Released</h3>
            <p class="text-sm text-gray-600 mt-1">Your franchise documents are ready for pickup</p>
            @if($application->released_at)
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $application->released_at->format('F d, Y - g:i A') }}
                </p>
            @endif
        </div>
    </div>
@endif

@if($application->status === 'completed')
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
            <i class="fas fa-trophy"></i>
        </div>
        <div class="flex-1 bg-green-50 p-4 rounded-lg border-2 border-green-500">
            <h3 class="font-bold text-gray-800">Process Completed</h3>
            <p class="text-sm text-gray-600 mt-1">Congratulations! Your franchise application is complete</p>
            @if($application->expiration_date)
                <p class="text-sm text-green-700 mt-2">
                    <strong>Valid Until:</strong> {{ $application->expiration_date->format('F d, Y') }}
                </p>
            @endif
            @if($application->completed_at)
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $application->completed_at->format('F d, Y - g:i A') }}
                </p>
            @endif
        </div>
    </div>
@endif
