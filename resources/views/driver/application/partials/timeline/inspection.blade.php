<!-- 3. Inspection Scheduling/Completion -->
@if($application->status === 'for_scheduling')
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="flex-1 bg-blue-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Awaiting Inspection Schedule</h3>
            <p class="text-sm text-gray-600 mt-1">SB will schedule your vehicle inspection soon</p>
            <p class="text-xs text-gray-500 mt-2">
                <i class="fas fa-spinner fa-spin mr-1"></i>
                In Progress
            </p>
        </div>
    </div>
@elseif($application->status === 'inspection_scheduled' || $application->status === 'inspection_pending')
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
            <i class="fas fa-check"></i>
        </div>
        <div class="flex-1 bg-green-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Inspection Scheduled</h3>
            @if($application->latestInspection)
                <p class="text-sm text-gray-600 mt-1">
                    Scheduled for {{ $application->latestInspection->scheduled_date->format('F d, Y') }}
                </p>
                <p class="text-sm text-gray-600">Inspector: {{ $application->latestInspection->inspector_name }}</p>
                @if($application->latestInspection->location)
                    <p class="text-sm text-gray-600">Location: {{ $application->latestInspection->location }}</p>
                @endif
                @if($application->latestInspection->notes)
                    <div class="mt-3 pt-3 border-t border-green-200">
                        <p class="text-xs font-semibold text-gray-700">Inspector Notes:</p>
                        <p class="text-sm text-gray-600 mt-1 italic">{{ $application->latestInspection->notes }}</p>
                    </div>
                @endif
            @else
                <p class="text-sm text-gray-600 mt-1">Your vehicle inspection has been scheduled</p>
            @endif
            @if($application->scheduled_at)
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $application->scheduled_at->format('F d, Y - g:i A') }}
                </p>
            @endif
        </div>
    </div>

    @if($application->status === 'inspection_pending')
        <div class="relative flex items-start space-x-4">
            <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                <h3 class="font-bold text-gray-800">Inspection In Progress</h3>
                <p class="text-sm text-gray-600 mt-1">Vehicle inspection is currently being conducted</p>
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-spinner fa-spin mr-1"></i>
                    In Progress
                </p>
            </div>
        </div>
    @endif
@elseif($application->status === 'inspection_failed')
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
            <i class="fas fa-check"></i>
        </div>
        <div class="flex-1 bg-green-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Inspection Scheduled</h3>
            @if($application->latestInspection)
                <p class="text-sm text-gray-600 mt-1">
                    Scheduled for {{ $application->latestInspection->scheduled_date->format('F d, Y') }}
                </p>
            @endif
            @if($application->scheduled_at)
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $application->scheduled_at->format('F d, Y - g:i A') }}
                </p>
            @endif
        </div>
    </div>

    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-red-500 flex items-center justify-center text-white font-bold">
            <i class="fas fa-times"></i>
        </div>
        <div class="flex-1 bg-red-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Inspection Failed</h3>
            <p class="text-sm text-gray-600 mt-1">Your vehicle did not pass the inspection</p>
            @if($application->latestInspection && $application->latestInspection->remarks)
                <div class="mt-3 bg-red-100 border-l-4 border-red-500 p-2 rounded">
                    <p class="text-xs text-red-800"><strong>Issues:</strong> {{ $application->latestInspection->remarks }}</p>
                </div>
            @endif
            @if($application->latestInspection && $application->latestInspection->notes)
                <div class="mt-2 bg-yellow-50 border-l-4 border-yellow-500 p-2 rounded">
                    <p class="text-xs text-yellow-800"><strong>Inspector Notes:</strong></p>
                    <p class="text-xs text-yellow-700 mt-1">{{ $application->latestInspection->notes }}</p>
                </div>
            @endif
            @if($application->inspected_at)
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $application->inspected_at->format('F d, Y - g:i A') }}
                </p>
            @endif
        </div>
    </div>
@elseif(in_array($application->status, ['for_treasury', 'for_approval', 'approved', 'released', 'completed']))
    <div class="relative flex items-start space-x-4">
        <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
            <i class="fas fa-check"></i>
        </div>
        <div class="flex-1 bg-green-50 p-4 rounded-lg">
            <h3 class="font-bold text-gray-800">Inspection Passed</h3>
            @if($application->latestInspection)
                <p class="text-sm text-gray-600 mt-1">
                    Vehicle inspection completed successfully
                </p>
                @if($application->latestInspection->inspector_name)
                    <p class="text-sm text-gray-600">Inspector: {{ $application->latestInspection->inspector_name }}</p>
                @endif
                @if($application->latestInspection->notes)
                    <div class="mt-3 bg-green-100 border-l-4 border-green-600 p-3 rounded">
                        <p class="text-xs text-green-800"><strong>Inspector Notes:</strong></p>
                        <p class="text-xs text-green-700 mt-1">{{ $application->latestInspection->notes }}</p>
                    </div>
                @endif
            @else
                <p class="text-sm text-gray-600 mt-1">Your vehicle passed the inspection</p>
            @endif
            @if($application->inspected_at)
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $application->inspected_at->format('F d, Y - g:i A') }}
                </p>
            @endif
        </div>
    </div>
@endif
