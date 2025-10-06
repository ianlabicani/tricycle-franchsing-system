@extends('sb.shell')

@section('sb-content')
<div class="space-y-6">
    <!-- Breadcrumbs -->
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('sb.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-purple-600">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    <a href="{{ route('sb.inspections.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-purple-600 md:ml-2">Inspections</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Inspection #{{ $inspection->id }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header with Actions -->
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Inspection Details</h1>
            <p class="text-gray-600 mt-1">Vehicle inspection #{{ $inspection->id }}</p>
        </div>
        <div class="flex items-center space-x-3">
            @if($inspection->status === 'scheduled')
            <button onclick="openCompleteModal()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition flex items-center space-x-2">
                <i class="fas fa-check-circle"></i>
                <span>Complete Inspection</span>
            </button>
            <a href="{{ route('sb.inspections.edit', $inspection) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition flex items-center space-x-2">
                <i class="fas fa-edit"></i>
                <span>Edit</span>
            </a>
            <button onclick="openCancelModal()" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition flex items-center space-x-2">
                <i class="fas fa-ban"></i>
                <span>Cancel</span>
            </button>
            @endif
        </div>
    </div>

    <!-- Status Banner -->
    <div class="rounded-lg p-6 @if($inspection->status === 'scheduled') bg-blue-50 border-l-4 border-blue-500 @elseif($inspection->status === 'completed') bg-green-50 border-l-4 border-green-500 @else bg-red-50 border-l-4 border-red-500 @endif">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    @if($inspection->status === 'scheduled')
                        <i class="fas fa-calendar-alt text-blue-500 text-3xl"></i>
                    @elseif($inspection->status === 'completed')
                        <i class="fas fa-check-circle text-green-500 text-3xl"></i>
                    @else
                        <i class="fas fa-times-circle text-red-500 text-3xl"></i>
                    @endif
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold @if($inspection->status === 'scheduled') text-blue-900 @elseif($inspection->status === 'completed') text-green-900 @else text-red-900 @endif">
                        Inspection {{ ucfirst($inspection->status) }}
                    </h3>
                    <p class="@if($inspection->status === 'scheduled') text-blue-700 @elseif($inspection->status === 'completed') text-green-700 @else text-red-700 @endif">
                        @if($inspection->status === 'scheduled')
                            Scheduled for {{ $inspection->scheduled_date->format('F d, Y') }} at {{ $inspection->scheduled_time->format('h:i A') }}
                        @elseif($inspection->status === 'completed')
                            Completed on {{ $inspection->completed_at->format('F d, Y \a\t h:i A') }}
                        @else
                            Cancelled on {{ $inspection->cancelled_at->format('F d, Y \a\t h:i A') }}
                        @endif
                    </p>
                </div>
            </div>
            @if($inspection->result)
            <div>
                @if($inspection->result === 'passed')
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                        <i class="fas fa-check mr-1"></i> PASSED
                    </span>
                @else
                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                        <i class="fas fa-times mr-1"></i> FAILED
                    </span>
                @endif
            </div>
            @endif
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Inspection Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Application Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-file-alt text-purple-600 mr-2"></i>
                    Application Information
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Application Number</p>
                        <p class="text-base font-semibold text-gray-900">{{ $inspection->application->application_no }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Driver Name</p>
                        <p class="text-base font-semibold text-gray-900">{{ $inspection->application->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Application Status</p>
                        <p class="text-base font-semibold text-gray-900">{{ ucfirst(str_replace('_', ' ', $inspection->application->status)) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">View Application</p>
                        <a href="{{ route('sb.applications.show', $inspection->application) }}" class="text-purple-600 hover:text-purple-800 font-semibold">
                            View Details <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Inspection Schedule -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-calendar-check text-purple-600 mr-2"></i>
                    Inspection Schedule
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Inspection Date</p>
                        <p class="text-base font-semibold text-gray-900">{{ $inspection->scheduled_date->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Inspection Time</p>
                        <p class="text-base font-semibold text-gray-900">{{ $inspection->scheduled_time->format('h:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Inspector Assigned</p>
                        <p class="text-base font-semibold text-gray-900">{{ $inspection->inspector_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Location</p>
                        <p class="text-base font-semibold text-gray-900">{{ $inspection->location }}</p>
                    </div>
                </div>
            </div>

            <!-- Inspection Notes -->
            @if($inspection->notes)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-sticky-note text-purple-600 mr-2"></i>
                    Notes / Instructions
                </h2>
                <p class="text-gray-700 whitespace-pre-line">{{ $inspection->notes }}</p>
            </div>
            @endif

            <!-- Inspection Result -->
            @if($inspection->status === 'completed')
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-clipboard-list text-purple-600 mr-2"></i>
                    Inspection Result
                </h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Result</p>
                        <p class="text-base font-semibold">
                            @if($inspection->result === 'passed')
                                <span class="text-green-600"><i class="fas fa-check-circle mr-1"></i> PASSED</span>
                            @else
                                <span class="text-red-600"><i class="fas fa-times-circle mr-1"></i> FAILED</span>
                            @endif
                        </p>
                    </div>
                    @if($inspection->remarks)
                    <div>
                        <p class="text-sm text-gray-500">Remarks</p>
                        <p class="text-gray-700 whitespace-pre-line">{{ $inspection->remarks }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm text-gray-500">Completed By</p>
                        <p class="text-base font-semibold text-gray-900">{{ $inspection->completedBy->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Completed At</p>
                        <p class="text-base font-semibold text-gray-900">{{ $inspection->completed_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Cancellation Details -->
            @if($inspection->status === 'cancelled')
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-ban text-red-600 mr-2"></i>
                    Cancellation Details
                </h2>
                <div class="space-y-4">
                    @if($inspection->cancellation_reason)
                    <div>
                        <p class="text-sm text-gray-500">Reason for Cancellation</p>
                        <p class="text-gray-700 whitespace-pre-line">{{ $inspection->cancellation_reason }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm text-gray-500">Cancelled By</p>
                        <p class="text-base font-semibold text-gray-900">{{ $inspection->cancelledBy->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Cancelled At</p>
                        <p class="text-base font-semibold text-gray-900">{{ $inspection->cancelled_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column - Timeline -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-clock text-purple-600 mr-2"></i>
                    Timeline
                </h2>
                <div class="space-y-4">
                    <!-- Scheduled -->
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-blue-100">
                                <i class="fas fa-calendar-alt text-blue-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Inspection Scheduled</p>
                            <p class="text-sm text-gray-500">{{ $inspection->created_at->format('M d, Y h:i A') }}</p>
                            <p class="text-xs text-gray-500">by {{ $inspection->scheduledBy->name }}</p>
                        </div>
                    </div>

                    @if($inspection->status === 'completed')
                    <!-- Completed -->
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-green-100">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Inspection Completed</p>
                            <p class="text-sm text-gray-500">{{ $inspection->completed_at->format('M d, Y h:i A') }}</p>
                            <p class="text-xs text-gray-500">by {{ $inspection->completedBy->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    @elseif($inspection->status === 'cancelled')
                    <!-- Cancelled -->
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-red-100">
                                <i class="fas fa-times-circle text-red-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Inspection Cancelled</p>
                            <p class="text-sm text-gray-500">{{ $inspection->cancelled_at->format('M d, Y h:i A') }}</p>
                            <p class="text-xs text-gray-500">by {{ $inspection->cancelledBy->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Complete Inspection Modal -->
<div id="completeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mx-auto">
                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 text-center mt-4">Complete Inspection</h3>
            <form action="{{ route('sb.inspections.complete', $inspection) }}" method="POST" class="mt-4">
                @csrf
                @method('PATCH')

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Inspection Result</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="result" value="passed" required class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                <span class="ml-2 text-sm text-gray-700">
                                    <i class="fas fa-check-circle text-green-600"></i> Passed
                                </span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="result" value="failed" required class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                <span class="ml-2 text-sm text-gray-700">
                                    <i class="fas fa-times-circle text-red-600"></i> Failed
                                </span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="remarks" class="block text-sm font-medium text-gray-700 mb-2">Remarks</label>
                        <textarea id="remarks" name="remarks" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Enter inspection remarks..."></textarea>
                    </div>
                </div>

                <div class="flex space-x-3 mt-6">
                    <button type="button" onclick="closeCompleteModal()" class="flex-1 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                        Complete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Cancel Inspection Modal -->
<div id="cancelModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mx-auto">
                <i class="fas fa-ban text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 text-center mt-4">Cancel Inspection</h3>
            <p class="text-sm text-gray-500 text-center mt-2">Are you sure you want to cancel this inspection?</p>
            <form action="{{ route('sb.inspections.cancel', $inspection) }}" method="POST" class="mt-4">
                @csrf
                @method('PATCH')

                <div>
                    <label for="cancellation_reason" class="block text-sm font-medium text-gray-700 mb-2">Reason for Cancellation <span class="text-red-500">*</span></label>
                    <textarea id="cancellation_reason" name="cancellation_reason" rows="4" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Please provide a reason for cancelling this inspection..."></textarea>
                </div>

                <div class="flex space-x-3 mt-6">
                    <button type="button" onclick="closeCancelModal()" class="flex-1 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-50 transition">
                        Keep Inspection
                    </button>
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                        Cancel Inspection
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCompleteModal() {
    document.getElementById('completeModal').classList.remove('hidden');
}

function closeCompleteModal() {
    document.getElementById('completeModal').classList.add('hidden');
}

function openCancelModal() {
    document.getElementById('cancelModal').classList.remove('hidden');
}

function closeCancelModal() {
    document.getElementById('cancelModal').classList.add('hidden');
}
</script>
@endsection
