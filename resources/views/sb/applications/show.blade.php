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
                <p class="text-gray-600 mt-2">Application ID: FR-{{ str_pad($application->id, 6, '0', STR_PAD_LEFT) }}</p>
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
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Application Submitted</h3>
                                <p class="text-sm text-gray-600 mt-1">Application submitted by driver</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $application->date_submitted ? $application->date_submitted->format('M d, Y - h:i A') : 'N/A' }}</p>
                            </div>
                        </div>

                        @if($application->status === 'approved')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Application Approved</h3>
                                <p class="text-sm text-gray-600 mt-1">Application has been approved</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $application->approved_at ? $application->approved_at->format('M d, Y - h:i A') : 'N/A' }}</p>
                            </div>
                        </div>
                        @elseif($application->status === 'rejected')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-red-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="flex-1 bg-red-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Application Rejected</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $application->remarks }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $application->rejected_at ? $application->rejected_at->format('M d, Y - h:i A') : 'N/A' }}</p>
                            </div>
                        </div>
                        @else
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Awaiting Review</h3>
                                <p class="text-sm text-gray-600 mt-1">Application is pending SB Staff review</p>
                                <p class="text-xs text-gray-500 mt-2">In Progress</p>
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
            @if(!in_array($application->status, ['approved', 'rejected', 'released', 'completed']))
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Review Actions</h2>

                <div class="space-y-3">
                    <!-- Approve Button -->
                    <form action="{{ route('sb.applications.approve', $application) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition font-semibold">
                            <i class="fas fa-check-circle mr-2"></i>Approve Application
                        </button>
                    </form>

                    <!-- Review Button (Mark Complete or Incomplete) -->
                    <button onclick="openReviewModal()" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-clipboard-check mr-2"></i>Review Documents
                    </button>

                    <!-- Reject Button -->
                    <button onclick="openRejectModal()" class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition font-semibold">
                        <i class="fas fa-times-circle mr-2"></i>Reject Application
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
