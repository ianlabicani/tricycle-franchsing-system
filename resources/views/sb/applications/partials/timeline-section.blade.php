<!-- Timeline Section -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Application Timeline</h2>

    <div class="relative">
        <!-- Timeline Line -->
        <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-300"></div>

        <div class="space-y-6">
            <!-- Submitted -->
            <div class="relative flex items-start space-x-4">
                <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                    <i class="fas fa-check"></i>
                </div>
                <div class="flex-1 bg-green-50 p-4 rounded-lg">
                    <h3 class="font-bold text-gray-800">Application Submitted</h3>
                    <p class="text-sm text-gray-600 mt-1">Application submitted by {{ $application->user->name }}</p>
                    <p class="text-xs text-gray-500 mt-2">{{ $application->date_submitted ? $application->date_submitted->format('M d, Y - h:i A') : 'N/A' }}</p>
                </div>
            </div>

            <!-- Document Review -->
            @if($application->reviewed_at || in_array($application->status, ['incomplete', 'for_scheduling', 'inspection_scheduled', 'for_treasury', 'for_approval', 'approved', 'rejected', 'released', 'completed']))
            <div class="relative flex items-start space-x-4">
                <div class="relative z-10 w-12 h-12 rounded-full {{ $application->status === 'incomplete' ? 'bg-orange-500' : 'bg-green-500' }} flex items-center justify-center text-white font-bold">
                    <i class="fas {{ $application->status === 'incomplete' ? 'fa-exclamation' : 'fa-check' }}"></i>
                </div>
                <div class="flex-1 {{ $application->status === 'incomplete' ? 'bg-orange-50' : 'bg-green-50' }} p-4 rounded-lg">
                    <h3 class="font-bold text-gray-800">Documents {{ $application->status === 'incomplete' ? 'Marked Incomplete' : 'Reviewed & Approved' }}</h3>
                    <p class="text-sm text-gray-600 mt-1">SB staff reviewed submitted documents and determined application status</p>
                    @if($application->status === 'incomplete' && $application->remarks)
                        <p class="text-sm text-orange-700 mt-2"><strong>Note:</strong> {{ $application->remarks }}</p>
                    @endif
                    <p class="text-xs text-gray-500 mt-2">{{ $application->reviewed_at ? $application->reviewed_at->format('M d, Y - h:i A') : 'Completed' }}</p>
                </div>
            </div>
            @elseif($application->status === 'pending_review')
            <div class="relative flex items-start space-x-4">
                <div class="relative z-10 w-12 h-12 rounded-full bg-yellow-500 flex items-center justify-center text-white font-bold animate-pulse">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="flex-1 bg-yellow-50 p-4 rounded-lg">
                    <h3 class="font-bold text-gray-800">Awaiting Document Review</h3>
                    <p class="text-sm text-gray-600 mt-1">SB staff needs to review submitted documents</p>
                    <p class="text-xs text-gray-500 mt-2">In Progress</p>
                </div>
            </div>
            @endif

            <!-- Inspection Scheduling -->
            @if($application->scheduled_at || in_array($application->status, ['inspection_scheduled', 'for_treasury', 'for_approval', 'approved', 'released', 'completed']))
            <div class="relative flex items-start space-x-4">
                <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                    <i class="fas fa-check"></i>
                </div>
                <div class="flex-1 bg-green-50 p-4 rounded-lg">
                    <h3 class="font-bold text-gray-800">Inspection Scheduled</h3>
                    <p class="text-sm text-gray-600 mt-1">Vehicle inspection has been scheduled</p>
                    <p class="text-xs text-gray-500 mt-2">{{ $application->scheduled_at ? $application->scheduled_at->format('M d, Y - h:i A') : 'Completed' }}</p>
                </div>
            </div>
            @elseif($application->status === 'for_scheduling')
            <div class="relative flex items-start space-x-4">
                <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-bold text-gray-800">Ready for Inspection Scheduling</h3>
                    <p class="text-sm text-gray-600 mt-1">Awaiting vehicle inspection schedule</p>
                    <p class="text-xs text-gray-500 mt-2">In Progress</p>
                </div>
            </div>
            @endif

            <!-- Inspection Completed -->
            @if($application->inspected_at || in_array($application->status, ['for_treasury', 'for_approval', 'approved', 'released', 'completed']))
            <div class="relative flex items-start space-x-4">
                <div class="relative z-10 w-12 h-12 rounded-full {{ $application->status === 'inspection_failed' ? 'bg-red-500' : 'bg-green-500' }} flex items-center justify-center text-white font-bold">
                    <i class="fas {{ $application->status === 'inspection_failed' ? 'fa-times' : 'fa-check' }}"></i>
                </div>
                <div class="flex-1 {{ $application->status === 'inspection_failed' ? 'bg-red-50' : 'bg-green-50' }} p-4 rounded-lg">
                    <h3 class="font-bold text-gray-800">Vehicle Inspection {{ $application->status === 'inspection_failed' ? 'Failed' : 'Passed' }}</h3>
                    <p class="text-sm text-gray-600 mt-1">Inspection completed</p>
                    <p class="text-xs text-gray-500 mt-2">{{ $application->inspected_at ? $application->inspected_at->format('M d, Y - h:i A') : 'Completed' }}</p>
                </div>
            </div>
            @elseif($application->status === 'inspection_scheduled')
            <div class="relative flex items-start space-x-4">
                <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-bold text-gray-800">Awaiting Inspection</h3>
                    <p class="text-sm text-gray-600 mt-1">Scheduled inspection pending completion</p>
                    <p class="text-xs text-gray-500 mt-2">In Progress</p>
                </div>
            </div>
            @endif

            <!-- Payment & Approval -->
            @if($application->status === 'completed')
            <div class="relative flex items-start space-x-4">
                <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="flex-1 bg-green-50 p-4 rounded-lg border-2 border-green-500">
                    <h3 class="font-bold text-gray-800">Application Complete</h3>
                    <p class="text-sm text-gray-600 mt-1">All steps completed successfully</p>
                    <p class="text-xs text-gray-500 mt-2">{{ $application->completed_at ? $application->completed_at->format('M d, Y - h:i A') : 'Completed' }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
