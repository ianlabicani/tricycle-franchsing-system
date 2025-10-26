<!-- Current Action Required Banner -->
@if($application->status === 'pending_review')
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-lg mb-6">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <i class="fas fa-clipboard-check text-yellow-600 text-3xl mt-1"></i>
                <div>
                    <h3 class="text-lg font-bold text-yellow-900">Action Required: Review Documents</h3>
                    <p class="text-yellow-800 mt-1">This application is pending document review. Please verify all submitted requirements.</p>
                </div>
            </div>
            <button onclick="openReviewModal()" class="px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition font-semibold whitespace-nowrap">
                <i class="fas fa-check mr-2"></i>Review Now
            </button>
        </div>
    </div>
@elseif($application->status === 'incomplete')
    <div class="bg-orange-50 border-l-4 border-orange-500 p-6 rounded-lg mb-6">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <i class="fas fa-exclamation-triangle text-orange-600 text-3xl mt-1"></i>
                <div>
                    <h3 class="text-lg font-bold text-orange-900">Waiting for Driver: Incomplete Documents</h3>
                    <p class="text-orange-800 mt-1">Driver has been notified to submit missing/corrected documents.</p>
                    @if($application->remarks)
                        <p class="text-orange-700 text-sm mt-2"><strong>Note:</strong> {{ $application->remarks }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@elseif($application->status === 'for_scheduling')
    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg mb-6">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <i class="fas fa-calendar-check text-blue-600 text-3xl mt-1"></i>
                <div>
                    <h3 class="text-lg font-bold text-blue-900">Action Required: Schedule Inspection</h3>
                    <p class="text-blue-800 mt-1">Documents are complete. Schedule a vehicle inspection to proceed.</p>
                </div>
            </div>
            <a href="{{ route('sb.inspections.create', ['application_id' => $application->id]) }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold whitespace-nowrap">
                <i class="fas fa-calendar-plus mr-2"></i>Schedule Now
            </a>
        </div>
    </div>
@elseif($application->status === 'inspection_scheduled')
    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg mb-6">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <i class="fas fa-clock text-blue-600 text-3xl mt-1"></i>
                <div>
                    <h3 class="text-lg font-bold text-blue-900">Inspection Scheduled</h3>
                    <p class="text-blue-800 mt-1">
                        Vehicle inspection scheduled for <strong>{{ $application->latestInspection->scheduled_date->format('F d, Y') }}</strong>
                        with {{ $application->latestInspection->inspector_name }}.
                    </p>
                </div>
            </div>
            <a href="{{ route('sb.inspections.show', $application->latestInspection) }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold whitespace-nowrap">
                <i class="fas fa-eye mr-2"></i>View Inspection
            </a>
        </div>
    </div>
@elseif($application->status === 'for_treasury')
    <div class="bg-indigo-50 border-l-4 border-indigo-500 p-6 rounded-lg mb-6">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <i class="fas fa-money-bill-wave text-indigo-600 text-3xl mt-1"></i>
                <div>
                    <h3 class="text-lg font-bold text-indigo-900">Action Required: Create Payment Record</h3>
                    <p class="text-indigo-800 mt-1">Inspection passed. Create a payment record for franchise fees and permits.</p>
                </div>
            </div>
            <div class="flex space-x-3">
                @if($application->latestPayment)
                    <a href="{{ route('sb.payments.show', $application->latestPayment) }}" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold whitespace-nowrap">
                        <i class="fas fa-receipt mr-2"></i>View Payment
                    </a>
                @else
                    <a href="{{ route('sb.payments.create', ['application_id' => $application->id]) }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold whitespace-nowrap">
                        <i class="fas fa-plus mr-2"></i>Create Payment
                    </a>
                @endif
            </div>
        </div>
    </div>
@elseif($application->status === 'for_approval')
    <div class="bg-purple-50 border-l-4 border-purple-500 p-6 rounded-lg mb-6">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <i class="fas fa-user-check text-purple-600 text-3xl mt-1"></i>
                <div>
                    <h3 class="text-lg font-bold text-purple-900">Action Required: Final Approval</h3>
                    <p class="text-purple-800 mt-1">Payment verified. Review and approve the franchise application.</p>
                    @if($application->latestPayment)
                        <p class="text-purple-700 text-sm mt-2">
                            <strong>Payment:</strong> {{ $application->latestPayment->payment_no }} -
                            ₱{{ number_format($application->latestPayment->total_amount, 2) }} (Verified)
                        </p>
                    @endif
                </div>
            </div>
            @if(!$application->allDocumentsApproved())
                <button disabled class="px-6 py-3 bg-gray-400 text-white rounded-lg cursor-not-allowed font-semibold whitespace-nowrap opacity-50" title="All documents must be approved">
                    <i class="fas fa-lock mr-2"></i>Cannot Approve (Documents Not Reviewed)
                </button>
            @else
                <form action="{{ route('sb.applications.approve', $application) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold whitespace-nowrap">
                        <i class="fas fa-check-circle mr-2"></i>Approve Now
                    </button>
                </form>
            @endif
        </div>
    </div>
@elseif($application->status === 'approved')
    <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg mb-6">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <i class="fas fa-file-export text-green-600 text-3xl mt-1"></i>
                <div>
                    <h3 class="text-lg font-bold text-green-900">Action Required: Release Documents</h3>
                    <p class="text-green-800 mt-1">Application approved. Prepare and release franchise documents to the driver.</p>
                </div>
            </div>
            <form action="{{ route('sb.applications.release', $application) }}" method="POST">
                @csrf
                <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold whitespace-nowrap">
                    <i class="fas fa-paper-plane mr-2"></i>Release Documents
                </button>
            </form>
        </div>
    </div>
@elseif($application->status === 'released')
    <div class="bg-teal-50 border-l-4 border-teal-500 p-6 rounded-lg mb-6">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <i class="fas fa-flag-checkered text-teal-600 text-3xl mt-1"></i>
                <div>
                    <h3 class="text-lg font-bold text-teal-900">Action Required: Mark as Complete</h3>
                    <p class="text-teal-800 mt-1">Documents released. Confirm driver has received everything to complete the application.</p>
                </div>
            </div>
            <form action="{{ route('sb.applications.complete', $application) }}" method="POST">
                @csrf
                <button type="submit" class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-semibold whitespace-nowrap">
                    <i class="fas fa-check-double mr-2"></i>Complete Application
                </button>
            </form>
        </div>
    </div>
@elseif($application->status === 'completed')
    <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg mb-6">
        <div class="flex items-start space-x-4">
            <i class="fas fa-check-circle text-green-600 text-3xl mt-1"></i>
            <div>
                <h3 class="text-lg font-bold text-green-900">Application Completed</h3>
                <p class="text-green-800 mt-1">
                    This franchise application is complete. Expires on <strong>{{ $application->expiration_date ? $application->expiration_date->format('F d, Y') : 'N/A' }}</strong>.
                </p>
            </div>
        </div>
    </div>
@elseif($application->status === 'rejected')
    <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg mb-6">
        <div class="flex items-start space-x-4">
            <i class="fas fa-times-circle text-red-600 text-3xl mt-1"></i>
            <div>
                <h3 class="text-lg font-bold text-red-900">Application Rejected</h3>
                <p class="text-red-800 mt-1">This application has been rejected.</p>
                @if($application->remarks)
                    <p class="text-red-700 text-sm mt-2"><strong>Reason:</strong> {{ $application->remarks }}</p>
                @endif
            </div>
        </div>
    </div>
@elseif($application->status === 'inspection_failed')
    <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg mb-6">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <i class="fas fa-times-octagon text-red-600 text-3xl mt-1"></i>
                <div>
                    <h3 class="text-lg font-bold text-red-900">Inspection Failed</h3>
                    <p class="text-red-800 mt-1">Vehicle inspection did not pass. Driver must address issues and request re-inspection.</p>
                    @if($application->latestInspection && $application->latestInspection->remarks)
                        <p class="text-red-700 text-sm mt-2"><strong>Issues:</strong> {{ $application->latestInspection->remarks }}</p>
                    @endif
                </div>
            </div>
            @if($application->latestInspection)
                <a href="{{ route('sb.inspections.show', $application->latestInspection) }}" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold whitespace-nowrap">
                    <i class="fas fa-eye mr-2"></i>View Inspection
                </a>
            @endif
        </div>
    </div>
@endif
