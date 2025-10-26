<!-- 2. Document Review -->
@if($application->status === 'pending_review')
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
            <i class="fas fa-spinner fa-pulse"></i>
        </div>
        <div class="flex-1 bg-blue-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Under Review</h3>
            <p class="text-sm text-gray-600 mt-1">SB staff is reviewing your documents</p>
            <p class="text-xs text-gray-500 mt-2">
                <i class="fas fa-spinner fa-spin mr-1"></i>
                In Progress
            </p>
        </div>
    </div>
@elseif($application->status === 'incomplete')
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="flex-1 bg-orange-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Incomplete Documents</h3>
            <p class="text-sm text-gray-600 mt-1">Additional documents are required</p>
            @if($application->remarks)
                <div class="mt-3 bg-orange-100 border-l-4 border-orange-500 p-2 rounded">
                    <p class="text-xs text-orange-800"><strong>Note:</strong> {{ $application->remarks }}</p>
                </div>
            @endif
            @if($application->reviewed_at)
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $application->reviewed_at->format('F d, Y - g:i A') }}
                </p>
            @endif
        </div>
    </div>
@elseif(in_array($application->status, ['for_scheduling', 'inspection_scheduled', 'inspection_pending', 'for_treasury', 'for_approval', 'approved', 'released', 'completed']))
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
            <i class="fas fa-check"></i>
        </div>
        <div class="flex-1 bg-green-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Documents Reviewed</h3>
            <p class="text-sm text-gray-600 mt-1">All documents verified and approved</p>
            @if($application->reviewed_at)
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $application->reviewed_at->format('F d, Y - g:i A') }}
                </p>
            @endif
        </div>
    </div>
@endif
