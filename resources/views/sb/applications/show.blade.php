@extends('sb.shell')

@section('sb-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('sb.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('sb.applications.index') }}" class="hover:text-purple-600">Applications</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Review Application</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Application Review</h1>
                <p class="text-gray-600 mt-2">Application ID: {{ $application->application_no }}</p>
            </div>
            <a href="{{ route('sb.applications.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Applications
            </a>
        </div>
    </div>

    <!-- Status Banners -->
    @include('sb.applications.partials.status-banner')
    @include('sb.applications.partials.action-banner')

    <!-- Header Card -->
    @include('sb.applications.partials.header-card')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Applicant Information -->
            @include('sb.applications.partials.applicant-info')

            <!-- Documents Section -->
            @include('sb.applications.partials.documents-section')

            <!-- Timeline Section -->
            @include('sb.applications.partials.timeline-section')

        </div>

        <!-- Sidebar - Action Panel -->
        <div class="space-y-6">

            <!-- Quick Actions -->
            @if($application->status === 'for_scheduling')
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Next Steps</h2>

                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-4">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <p class="text-sm text-green-800 font-semibold">Documents Reviewed</p>
                            <p class="text-xs text-green-700 mt-1">Application is ready for inspection scheduling.</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('sb.inspections.create', ['application_id' => $application->id]) }}" class="block w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition font-semibold text-center">
                    <i class="fas fa-calendar-check mr-2"></i>Schedule Vehicle Inspection
                </a>
            </div>
            @elseif(!in_array($application->status, ['approved', 'rejected', 'released', 'completed']))
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Review Actions</h2>

                @if(!$application->allDocumentsApproved())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-4">
                        <p class="text-sm text-red-800 font-semibold">
                            <i class="fas fa-lock mr-2"></i>Review actions disabled
                        </p>
                        <p class="text-xs text-red-700 mt-1">All documents must be approved first</p>
                    </div>
                    <button disabled class="w-full bg-gray-400 text-white py-3 rounded-lg cursor-not-allowed font-semibold opacity-50">
                        <i class="fas fa-clipboard-check mr-2"></i>Review Documents
                    </button>
                @else
                    <div class="space-y-3">
                        <button onclick="openReviewModal()" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                            <i class="fas fa-clipboard-check mr-2"></i>Review Documents
                        </button>
                    </div>
                @endif
            </div>
            @endif

            <!-- Inspection Status -->
            @if($application->latestInspection)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Inspection Status</h2>

                <div class="space-y-3">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Status</span>
                        @if($application->latestInspection->status === 'scheduled')
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">Scheduled</span>
                        @elseif($application->latestInspection->status === 'completed')
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Completed</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Cancelled</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Scheduled Date</span>
                        <span class="font-bold text-gray-800">{{ $application->latestInspection->scheduled_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Inspector</span>
                        <span class="font-bold text-gray-800">{{ $application->latestInspection->inspector_name }}</span>
                    </div>
                    @if($application->latestInspection->result)
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Result</span>
                        @if($application->latestInspection->result === 'passed')
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Passed</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Failed</span>
                        @endif
                    </div>
                    @endif
                </div>

                <a href="{{ route('sb.inspections.show', $application->latestInspection) }}" class="block w-full mt-4 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition font-semibold text-center text-sm">
                    <i class="fas fa-eye mr-2"></i>View Inspection Details
                </a>
            </div>
            @endif

            <!-- Payment Status -->
            @if($application->latestPayment)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Payment Status</h2>

                <div class="space-y-3">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Payment No.</span>
                        <span class="font-bold text-purple-600">{{ $application->latestPayment->payment_no }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Amount</span>
                        <span class="font-bold text-gray-800">₱{{ number_format($application->latestPayment->total_amount, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Status</span>
                        @if($application->latestPayment->status === 'pending')
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                        @elseif($application->latestPayment->status === 'verified')
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Cancelled</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Created</span>
                        <span class="font-bold text-gray-800">{{ $application->latestPayment->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <a href="{{ route('sb.payments.show', $application->latestPayment) }}" class="block w-full mt-4 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition font-semibold text-center text-sm">
                    <i class="fas fa-receipt mr-2"></i>View Payment Details
                </a>
            </div>
            @endif

            <!-- Application Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Application Summary</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Status</span>
                        @php
                            $statusColors = [
                                'draft' => 'bg-gray-100 text-gray-800',
                                'pending_review' => 'bg-yellow-100 text-yellow-800',
                                'incomplete' => 'bg-orange-100 text-orange-800',
                                'for_scheduling' => 'bg-blue-100 text-blue-800',
                                'inspection_scheduled' => 'bg-blue-100 text-blue-800',
                                'for_treasury' => 'bg-indigo-100 text-indigo-800',
                                'for_approval' => 'bg-purple-100 text-purple-800',
                                'approved' => 'bg-green-100 text-green-800',
                                'released' => 'bg-green-100 text-green-800',
                                'completed' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                            ];
                            $color = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="{{ $color }} px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $application->status_label ?? ucfirst(str_replace('_', ' ', $application->status)) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Type</span>
                        <span class="font-bold text-gray-800">{{ ucfirst($application->franchise_type ?? 'New') }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Submitted</span>
                        <span class="font-bold text-gray-800">{{ $application->date_submitted ? $application->date_submitted->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    @if($application->queue_number)
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Queue Number</span>
                        <span class="font-bold text-purple-600">{{ $application->queue_number }}</span>
                    </div>
                    @endif
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Requirements</span>
                        <span class="font-bold text-green-600">5/5 Complete</span>
                    </div>
                </div>

                @if($application->status === 'completed')
                <div class="mt-4 pt-4 border-t">
                    <form action="{{ route('sb.applications.testRenewal', $application) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="w-full bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700 transition font-semibold text-sm">
                            <i class="fas fa-flask mr-2"></i>Test Renewal Process
                        </button>
                    </form>
                    <p class="text-xs text-amber-700 mt-2 bg-amber-50 p-2 rounded">
                        <i class="fas fa-info-circle mr-1"></i>
                        Updates expiry to 1 month before actual expiration to trigger renewal logic.
                    </p>
                </div>
                @endif
            </div>

            <!-- Contact Driver -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Contact Driver</h2>

                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-purple-600"></i>
                        <span class="text-gray-700 text-sm">{{ $application->user->email }}</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-phone text-purple-600"></i>
                        <span class="text-gray-700 text-sm">+63 912 345 6789</span>
                    </div>
                </div>

                <button class="w-full mt-4 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition font-semibold text-sm">
                    <i class="fas fa-paper-plane mr-2"></i>Send Message
                </button>
            </div>

        </div>
    </div>

    <!-- Modals -->
    @include('sb.applications.partials.modals')

@endsection
