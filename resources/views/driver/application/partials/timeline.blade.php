<!-- Application Timeline -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Application Timeline</h2>

    <div class="relative">
        <!-- Timeline Line -->
        <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-300"></div>

        <div class="space-y-6">
            <!-- 1. Application Submitted -->
            <div class="relative flex items-start space-x-4">
                <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                    <i class="fas fa-check"></i>
                </div>
                <div class="flex-1 bg-green-50 p-4 rounded-lg">
                    <h3 class="font-bold text-gray-800">Application Submitted</h3>
                    <p class="text-sm text-gray-600 mt-1">Your application has been received and is under review</p>
                    @if($application->date_submitted)
                        <p class="text-xs text-gray-500 mt-2">
                            <i class="fas fa-clock mr-1"></i>
                            {{ $application->date_submitted->format('F d, Y - g:i A') }}
                        </p>
                    @endif
                </div>
            </div>

            @include('driver.application.partials.timeline.document-review')
            @include('driver.application.partials.timeline.inspection')
            @include('driver.application.partials.timeline.payment')
            @include('driver.application.partials.timeline.approval')
            @include('driver.application.partials.timeline.completion')
        </div>
    </div>
</div>
