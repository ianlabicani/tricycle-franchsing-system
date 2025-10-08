<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Current Status</h2>

    @if($application->status === 'pending_review')
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-lg">
            <div class="flex items-start space-x-4">
                <div class="bg-yellow-500 text-white rounded-full p-3 flex-shrink-0">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Under Review</h3>
                    <p class="text-gray-600 mb-4">Your application is being reviewed by SB Staff. This usually takes 2-3 business days.</p>
                    <div class="bg-white p-4 rounded">
                        <p class="text-sm text-gray-600"><strong>Submitted:</strong> {{ $application->date_submitted->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

    @elseif($application->status === 'incomplete')
        <div class="bg-orange-50 border-l-4 border-orange-500 p-6 rounded-lg">
            <div class="flex items-start space-x-4">
                <div class="bg-orange-500 text-white rounded-full p-3 flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Action Required: Incomplete Documents</h3>
                    <p class="text-gray-600 mb-4">Please review the remarks and update your application.</p>
                    @if($application->remarks)
                        <div class="bg-white p-4 rounded mb-4">
                            <p class="text-sm text-orange-800"><strong>Remarks:</strong> {{ $application->remarks }}</p>
                        </div>
                    @endif
                    <a href="{{ route('driver.application.edit', $application) }}" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition font-semibold">
                        <i class="fas fa-edit mr-2"></i>Update Application
                    </a>
                </div>
            </div>
        </div>

    @elseif(in_array($application->status, ['inspection_scheduled', 'inspection_pending']) && $application->latestInspection)
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
            <div class="flex items-start space-x-4">
                <div class="bg-blue-500 text-white rounded-full p-3 flex-shrink-0">
                    <i class="fas fa-clipboard-check text-2xl"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Inspection Scheduled</h3>
                    <p class="text-gray-600 mb-4">Your vehicle inspection has been scheduled. Please bring all required documents.</p>
                    <div class="bg-white p-4 rounded">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600"><strong>Date:</strong> {{ $application->latestInspection->scheduled_date->format('F d, Y') }}</p>
                                <p class="text-sm text-gray-600"><strong>Time:</strong> {{ $application->latestInspection->scheduled_time ?? 'TBA' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600"><strong>Inspector:</strong> {{ $application->latestInspection->inspector_name }}</p>
                                <p class="text-sm text-gray-600"><strong>Location:</strong> {{ $application->latestInspection->location ?? 'SB Office' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @elseif($application->status === 'for_treasury' && $application->latestPayment)
        <div class="bg-indigo-50 border-l-4 border-indigo-500 p-6 rounded-lg">
            <div class="flex items-start space-x-4">
                <div class="bg-indigo-500 text-white rounded-full p-3 flex-shrink-0">
                    <i class="fas fa-money-bill-wave text-2xl"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Payment Required</h3>
                    <p class="text-gray-600 mb-4">Inspection passed! Please proceed to treasury for payment.</p>
                    <div class="bg-white p-4 rounded mb-4">
                        <p class="text-sm text-gray-600 mb-2"><strong>Payment No:</strong> <span class="text-purple-600 font-bold">{{ $application->latestPayment->payment_no }}</span></p>
                        <p class="text-sm text-gray-600"><strong>Amount:</strong> <span class="text-green-600 font-bold text-lg">₱{{ number_format($application->latestPayment->total_amount, 2) }}</span></p>
                    </div>
                    <a href="{{ route('driver.application.show', $application) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                        <i class="fas fa-receipt mr-2"></i>View Payment Details
                    </a>
                </div>
            </div>
        </div>

    @elseif($application->status === 'for_approval')
        <div class="bg-purple-50 border-l-4 border-purple-500 p-6 rounded-lg">
            <div class="flex items-start space-x-4">
                <div class="bg-purple-500 text-white rounded-full p-3 flex-shrink-0">
                    <i class="fas fa-hourglass-half text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Awaiting Final Approval</h3>
                    <p class="text-gray-600">Payment verified. SB is reviewing your application for final approval.</p>
                </div>
            </div>
        </div>

    @elseif(in_array($application->status, ['approved', 'released']))
        <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg">
            <div class="flex items-start space-x-4">
                <div class="bg-green-500 text-white rounded-full p-3 flex-shrink-0">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $application->status === 'approved' ? 'Application Approved!' : 'Documents Ready for Pickup' }}</h3>
                    <p class="text-gray-600 mb-4">
                        @if($application->status === 'approved')
                            Congratulations! Your application has been approved.
                        @else
                            Your franchise documents are ready for pickup at the SB Office.
                        @endif
                    </p>
                    <div class="bg-white p-4 rounded">
                        <p class="text-sm text-gray-600"><strong>Approved:</strong> {{ $application->date_approved ? $application->date_approved->format('F d, Y') : 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
            <div class="flex items-start space-x-4">
                <div class="bg-blue-500 text-white rounded-full p-3 flex-shrink-0">
                    <i class="fas fa-info-circle text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">In Progress</h3>
                    <p class="text-gray-600">Your application is being processed. We'll notify you of updates.</p>
                </div>
            </div>
        </div>
    @endif
</div>
