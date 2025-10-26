<!-- 5. Final Approval -->
@if($application->status === 'for_approval')
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
            <i class="fas fa-hourglass-half"></i>
        </div>
        <div class="flex-1 bg-blue-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Awaiting Final Approval</h3>
            <p class="text-sm text-gray-600 mt-1">SB is reviewing your application for final approval</p>
            <p class="text-xs text-gray-500 mt-2">
                <i class="fas fa-spinner fa-spin mr-1"></i>
                In Progress
            </p>
        </div>
    </div>
@elseif($application->status === 'rejected')
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-red-500 flex items-center justify-center text-white font-bold">
            <i class="fas fa-ban"></i>
        </div>
        <div class="flex-1 bg-red-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Application Rejected</h3>
            <p class="text-sm text-gray-600 mt-1">Your application was not approved</p>
            @if($application->remarks)
                <div class="mt-3 bg-red-100 border-l-4 border-red-500 p-2 rounded">
                    <p class="text-xs text-red-800"><strong>Reason:</strong> {{ $application->remarks }}</p>
                </div>
            @endif
            @if($application->rejected_at)
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $application->rejected_at->format('F d, Y - g:i A') }}
                </p>
            @endif
        </div>
    </div>
@elseif(in_array($application->status, ['approved', 'released', 'completed']))
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
            <i class="fas fa-check"></i>
        </div>
        <div class="flex-1 bg-green-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Application Approved</h3>
            <p class="text-sm text-gray-600 mt-1">Your franchise application has been approved</p>
            @if($application->date_approved)
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $application->date_approved->format('F d, Y - g:i A') }}
                </p>
            @endif
        </div>
    </div>
@endif
