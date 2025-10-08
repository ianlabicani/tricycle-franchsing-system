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

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-6">
            <div class="flex items-center space-x-3">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                <p class="text-green-800 font-semibold">{{ session('success') }}</p>
            </div>
        </div>
    @endif

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
                <form action="{{ route('sb.applications.approve', $application) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold whitespace-nowrap">
                        <i class="fas fa-check-circle mr-2"></i>Approve Now
                    </button>
                </form>
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

    <!-- Application Status Card -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Application Status</h2>
                <p class="text-purple-100 mb-4">{{ ucfirst($application->status ?? 'Pending') }}</p>
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-purple-100 text-sm">Applicant</p>
                        <p class="text-xl font-bold">{{ $application->user->name }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-purple-100 text-sm">Submitted On</p>
                        <p class="text-xl font-bold">{{ $application->date_submitted ? $application->date_submitted->format('M d, Y') : 'N/A' }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-purple-100 text-sm">Type</p>
                        <p class="text-xl font-bold">{{ ucfirst($application->franchise_type ?? 'New') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-6">
                <i class="fas fa-file-alt text-6xl"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Applicant Information -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Applicant Information</h2>

                <div class="space-y-6">
                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center justify-between">
                            <span>Personal Information</span>
                            <span class="text-sm font-normal text-green-600"><i class="fas fa-check-circle mr-1"></i>Verified</span>
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                                <p class="text-gray-800 font-semibold">{{ $application->user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                                <p class="text-gray-800 font-semibold">{{ $application->user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Contact Number</label>
                                <p class="text-gray-800 font-semibold">+63 912 345 6789</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Date of Birth</label>
                                <p class="text-gray-800 font-semibold">January 15, 1985</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 mb-1">Complete Address</label>
                                <p class="text-gray-800 font-semibold">123 Main Street, Barangay Centro, City, Province</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center justify-between">
                            <span>Vehicle Information</span>
                            <span class="text-sm font-normal text-green-600"><i class="fas fa-check-circle mr-1"></i>Verified</span>
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Plate Number</label>
                                <p class="text-gray-800 font-semibold">ABC-1234</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Engine Number</label>
                                <p class="text-gray-800 font-semibold">EN123456789</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Chassis Number</label>
                                <p class="text-gray-800 font-semibold">CH987654321</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Year Model</label>
                                <p class="text-gray-800 font-semibold">2020</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Make/Brand</label>
                                <p class="text-gray-800 font-semibold">Honda</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Color</label>
                                <p class="text-gray-800 font-semibold">Blue</p>
                            </div>
                        </div>
                    </div>

                    <!-- Route Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Route Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Preferred Route</label>
                                <p class="text-gray-800 font-semibold">Route A (Church - Market - Terminal)</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Operating Hours</label>
                                <p class="text-gray-800 font-semibold">6:00 AM - 8:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Purpose/Remarks -->
                    @if($application->purpose)
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Purpose / Remarks</h3>
                        <p class="text-gray-700">{{ $application->purpose }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Submitted Requirements -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Submitted Requirements</h2>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-id-card text-green-600 text-2xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Valid Driver's License</p>
                                <p class="text-xs text-gray-500">Uploaded on Oct 1, 2025</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                            <button class="text-purple-600 hover:text-purple-700 font-semibold text-sm">
                                <i class="fas fa-eye mr-1"></i>View
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file-alt text-green-600 text-2xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Vehicle OR/CR</p>
                                <p class="text-xs text-gray-500">Uploaded on Oct 1, 2025</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                            <button class="text-purple-600 hover:text-purple-700 font-semibold text-sm">
                                <i class="fas fa-eye mr-1"></i>View
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Police Clearance</p>
                                <p class="text-xs text-gray-500">Uploaded on Oct 2, 2025</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                            <button class="text-purple-600 hover:text-purple-700 font-semibold text-sm">
                                <i class="fas fa-eye mr-1"></i>View
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-landmark text-green-600 text-2xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Barangay Clearance</p>
                                <p class="text-xs text-gray-500">Uploaded on Oct 2, 2025</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                            <button class="text-purple-600 hover:text-purple-700 font-semibold text-sm">
                                <i class="fas fa-eye mr-1"></i>View
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-notes-medical text-green-600 text-2xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Medical Certificate</p>
                                <p class="text-xs text-gray-500">Uploaded on Oct 2, 2025</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                            <button class="text-purple-600 hover:text-purple-700 font-semibold text-sm">
                                <i class="fas fa-eye mr-1"></i>View
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Timeline -->
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
                                <p class="text-sm text-gray-600 mt-1">
                                    @if($application->reviewedBy)
                                        Reviewed by {{ $application->reviewedBy->name }}
                                    @else
                                        Document review completed
                                    @endif
                                </p>
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
                                @if($application->latestInspection)
                                    <p class="text-sm text-gray-600 mt-1">
                                        Scheduled for {{ $application->latestInspection->scheduled_date->format('M d, Y') }}
                                        with {{ $application->latestInspection->inspector_name }}
                                    </p>
                                @else
                                    <p class="text-sm text-gray-600 mt-1">Vehicle inspection has been scheduled</p>
                                @endif
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
                                @if($application->latestInspection)
                                    <p class="text-sm text-gray-600 mt-1">
                                        Inspected by {{ $application->latestInspection->inspector_name }}
                                    </p>
                                    @if($application->latestInspection->remarks)
                                        <p class="text-sm {{ $application->status === 'inspection_failed' ? 'text-red-700' : 'text-gray-600' }} mt-2">
                                            <strong>Notes:</strong> {{ $application->latestInspection->remarks }}
                                        </p>
                                    @endif
                                @else
                                    <p class="text-sm text-gray-600 mt-1">Inspection completed successfully</p>
                                @endif
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

                        <!-- Inspection Failed (if applicable) -->
                        @if($application->status === 'inspection_failed')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-red-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="flex-1 bg-red-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Application On Hold - Failed Inspection</h3>
                                <p class="text-sm text-gray-600 mt-1">Waiting for driver to address inspection issues</p>
                                @if($application->latestInspection && $application->latestInspection->remarks)
                                    <p class="text-sm text-red-700 mt-2"><strong>Issues:</strong> {{ $application->latestInspection->remarks }}</p>
                                @endif
                                <p class="text-xs text-gray-500 mt-2">Current Status</p>
                            </div>
                        </div>
                        @endif

                        <!-- Payment Created -->
                        @if($application->latestPayment || in_array($application->status, ['for_approval', 'approved', 'released', 'completed']))
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Payment Record Created</h3>
                                @if($application->latestPayment)
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $application->latestPayment->payment_no }} - ₱{{ number_format($application->latestPayment->total_amount, 2) }}
                                    </p>
                                    <a href="{{ route('sb.payments.show', $application->latestPayment) }}" class="text-sm text-purple-600 hover:text-purple-700 font-semibold mt-2 inline-block">
                                        <i class="fas fa-receipt mr-1"></i>View Payment Details
                                    </a>
                                @else
                                    <p class="text-sm text-gray-600 mt-1">Payment record has been created</p>
                                @endif
                                <p class="text-xs text-gray-500 mt-2">{{ $application->latestPayment ? $application->latestPayment->created_at->format('M d, Y - h:i A') : 'Completed' }}</p>
                            </div>
                        </div>
                        @elseif($application->status === 'for_treasury')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold animate-pulse">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="flex-1 bg-indigo-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Awaiting Payment Record</h3>
                                <p class="text-sm text-gray-600 mt-1">Treasury needs to create payment record</p>
                                <p class="text-xs text-gray-500 mt-2">In Progress</p>
                            </div>
                        </div>
                        @endif

                        <!-- Payment Verified -->
                        @if($application->payment_verified_at || in_array($application->status, ['for_approval', 'approved', 'released', 'completed']))
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Payment Verified</h3>
                                @if($application->latestPayment)
                                    <p class="text-sm text-gray-600 mt-1">
                                        Payment of ₱{{ number_format($application->latestPayment->total_amount, 2) }} has been verified
                                    </p>
                                @else
                                    <p class="text-sm text-gray-600 mt-1">Payment has been verified and confirmed</p>
                                @endif
                                <p class="text-xs text-gray-500 mt-2">{{ $application->payment_verified_at ? $application->payment_verified_at->format('M d, Y - h:i A') : 'Completed' }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Final Approval/Rejection -->
                        @if($application->status === 'approved' || $application->status === 'released' || $application->status === 'completed')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Application Approved</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    @if($application->approvedBy)
                                        Approved by {{ $application->approvedBy->name }}
                                    @else
                                        Application has been approved
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500 mt-2">{{ $application->date_approved ? $application->date_approved->format('M d, Y - h:i A') : 'Completed' }}</p>
                            </div>
                        </div>
                        @elseif($application->status === 'rejected')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-red-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="flex-1 bg-red-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Application Rejected</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    @if($application->rejectedBy)
                                        Rejected by {{ $application->rejectedBy->name }}
                                    @else
                                        Application has been rejected
                                    @endif
                                </p>
                                @if($application->remarks)
                                    <p class="text-sm text-red-700 mt-2"><strong>Reason:</strong> {{ $application->remarks }}</p>
                                @endif
                                <p class="text-xs text-gray-500 mt-2">{{ $application->rejected_at ? $application->rejected_at->format('M d, Y - h:i A') : 'N/A' }}</p>
                            </div>
                        </div>
                        @elseif($application->status === 'for_approval')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold animate-pulse">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="flex-1 bg-purple-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Awaiting Final Approval</h3>
                                <p class="text-sm text-gray-600 mt-1">SB needs to approve the application</p>
                                <p class="text-xs text-gray-500 mt-2">In Progress</p>
                            </div>
                        </div>
                        @endif

                        <!-- Documents Released -->
                        @if($application->status === 'released' || $application->status === 'completed')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Documents Released</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    @if($application->releasedBy)
                                        Released by {{ $application->releasedBy->name }}
                                    @else
                                        Franchise documents have been released to driver
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500 mt-2">{{ $application->released_at ? $application->released_at->format('M d, Y - h:i A') : 'Completed' }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Application Completed -->
                        @if($application->status === 'completed')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg border-2 border-green-500">
                                <h3 class="font-bold text-gray-800">Application Completed</h3>
                                <p class="text-sm text-gray-600 mt-1">Franchise application process successfully completed</p>
                                @if($application->expiration_date)
                                    <p class="text-sm text-green-700 mt-2">
                                        <strong>Valid Until:</strong> {{ $application->expiration_date->format('F d, Y') }}
                                    </p>
                                @endif
                                <p class="text-xs text-gray-500 mt-2">{{ $application->date_completed ? $application->date_completed->format('M d, Y - h:i A') : 'N/A' }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

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

                <div class="space-y-3">
                    <!-- Review Button (Mark Complete or Incomplete) -->
                    <button onclick="openReviewModal()" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-clipboard-check mr-2"></i>Review Documents
                    </button>
                </div>
            </div>
            @endif

            <!-- Schedule Inspection Action -->
            @if($application->status === 'approved' && !$application->latestInspection)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Next Steps</h2>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <p class="text-sm text-blue-800 font-semibold">Application Approved</p>
                            <p class="text-xs text-blue-700 mt-1">Schedule a vehicle inspection to proceed with the franchise application.</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('sb.inspections.create', ['application_id' => $application->id]) }}" class="block w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition font-semibold text-center">
                    <i class="fas fa-clipboard-check mr-2"></i>Schedule Vehicle Inspection
                </a>
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
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-check mr-1"></i>Passed
                            </span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-times mr-1"></i>Failed
                            </span>
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
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-check mr-1"></i>Verified
                            </span>
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
                                'inspection_pending' => 'bg-blue-100 text-blue-800',
                                'inspection_failed' => 'bg-red-100 text-red-800',
                                'for_treasury' => 'bg-indigo-100 text-indigo-800',
                                'for_approval' => 'bg-indigo-100 text-indigo-800',
                                'approved' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                                'released' => 'bg-green-100 text-green-800',
                                'completed' => 'bg-green-100 text-green-800',
                                'for_renewal' => 'bg-purple-100 text-purple-800',
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

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Reject Application</h3>
            <form action="{{ route('sb.applications.reject', $application) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection <span class="text-red-500">*</span></label>
                    <textarea name="remarks" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Please provide a clear reason for rejection..." required></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                        Reject
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Review Application</h3>
            <form action="{{ route('sb.applications.review', $application) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Document Completeness <span class="text-red-500">*</span></label>
                    <div class="space-y-2">
                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="is_complete" value="1" required class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                            <span class="ml-3">
                                <span class="block text-sm font-medium text-gray-900">
                                    <i class="fas fa-check-circle text-green-600 mr-1"></i> Complete
                                </span>
                                <span class="block text-xs text-gray-500">All required documents are valid and ready for scheduling</span>
                            </span>
                        </label>
                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="is_complete" value="0" required class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300">
                            <span class="ml-3">
                                <span class="block text-sm font-medium text-gray-900">
                                    <i class="fas fa-exclamation-triangle text-orange-600 mr-1"></i> Incomplete
                                </span>
                                <span class="block text-xs text-gray-500">Missing or invalid documents - requires driver action</span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Review Notes</label>
                    <textarea name="remarks" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Add notes about missing documents or review details..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">If marking as incomplete, specify which documents are missing or invalid</p>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeReviewModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                        Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('flex');
        }

        function openReviewModal() {
            document.getElementById('reviewModal').classList.remove('hidden');
            document.getElementById('reviewModal').classList.add('flex');
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').classList.add('hidden');
            document.getElementById('reviewModal').classList.remove('flex');
        }
    </script>

@endsection
