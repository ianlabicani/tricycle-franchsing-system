@extends('driver.shell')

@section('driver-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('driver.dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('driver.application') }}" class="hover:text-blue-600">Applications</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Application Details</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Application Details</h1>
                <p class="text-gray-600 mt-2">{{ $application->application_no }}</p>
            </div>
            <a href="{{ route('driver.application') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Applications
            </a>
        </div>
    </div>

    <!-- Application Status Card -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Application Status</h2>
                <p class="text-blue-100 mb-4">{{ $application->status_label }}</p>
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-blue-100 text-sm">Application No.</p>
                        <p class="text-xl font-bold">{{ $application->application_no }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-blue-100 text-sm">Submitted On</p>
                        <p class="text-xl font-bold">{{ $application->date_submitted ? $application->date_submitted->format('M d, Y') : 'Not yet submitted' }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-blue-100 text-sm">Type</p>
                        <p class="text-xl font-bold">{{ ucfirst($application->franchise_type) }}</p>
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

            <!-- Application Details -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Application Information</h2>
                    @if(in_array($application->status, ['draft', 'incomplete']))
                    <div class="flex space-x-2">
                        <a href="{{ route('driver.application.edit', $application) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                    </div>
                    @endif
                </div>

                <div class="space-y-6">
                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Personal Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                                <p class="text-gray-800 font-semibold">{{ $application->full_name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Date of Birth</label>
                                <p class="text-gray-800 font-semibold">{{ $application->date_of_birth ? $application->date_of_birth->format('F d, Y') : 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Contact Number</label>
                                <p class="text-gray-800 font-semibold">{{ $application->contact_number ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                                <p class="text-gray-800 font-semibold">{{ $application->email ?? 'N/A' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 mb-1">Complete Address</label>
                                <p class="text-gray-800 font-semibold">{{ $application->address ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Vehicle Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Plate Number</label>
                                <p class="text-gray-800 font-semibold">{{ $application->plate_number ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Engine Number</label>
                                <p class="text-gray-800 font-semibold">{{ $application->engine_number ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Chassis Number</label>
                                <p class="text-gray-800 font-semibold">{{ $application->chassis_number ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Year Model</label>
                                <p class="text-gray-800 font-semibold">{{ $application->year_model ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Make/Brand</label>
                                <p class="text-gray-800 font-semibold">{{ $application->make ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Route Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Route Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Preferred Route</label>
                                @php
                                    $route = $application->route;
                                    $routeData = \App\Helpers\RouteHelper::getRoute($route);
                                @endphp
                                @if($routeData)
                                    <div class="inline-flex items-center px-4 py-2 rounded-lg border-2 {{ \App\Helpers\RouteHelper::getTailwindColorClass($routeData['color']) }}">
                                        <span class="font-semibold">{{ $routeData['name'] }} - {{ ucfirst($routeData['color']) }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2">{{ $routeData['description'] }}</p>
                                @else
                                    <p class="text-gray-800 font-semibold">{{ $route ?? 'N/A' }}</p>
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Operating Hours</label>
                                <p class="text-gray-800 font-semibold">{{ $application->operating_hours ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Purpose/Remarks -->
                    @if(isset($application->purpose) && $application->purpose)
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Purpose / Remarks</h3>
                        <p class="text-gray-700">{{ $application->purpose }}</p>
                    </div>
                    @endif

                    <!-- Remarks from Admin -->
                    @if(isset($application->remarks) && $application->remarks)
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Admin Remarks</h3>
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                            <p class="text-yellow-800">{{ $application->remarks }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Payment Information (only shown when status is for_treasury) -->
            @if($application->status === 'for_treasury' && $application->latestPayment)
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">
                            <i class="fas fa-money-bill-wave mr-2"></i>Payment Required
                        </h2>
                        <p class="text-green-100">Your inspection has passed. Please proceed to treasury for payment.</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-receipt text-4xl"></i>
                    </div>
                </div>

                <div class="bg-white text-gray-800 rounded-lg p-6 mb-4">
                    <div class="flex items-center justify-between mb-4 pb-4 border-b">
                        <div>
                            <p class="text-sm text-gray-600">Payment Number</p>
                            <p class="text-xl font-bold text-purple-600">{{ $application->latestPayment->payment_no }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Total Amount</p>
                            <p class="text-3xl font-bold text-green-600">₱{{ number_format($application->latestPayment->total_amount, 2) }}</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <h3 class="font-bold text-gray-800 mb-3">Payment Breakdown</h3>
                        @foreach($application->latestPayment->payment_items as $item)
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-700">{{ $item['name'] }}</span>
                            <span class="font-semibold text-gray-800">₱{{ number_format($item['amount'], 2) }}</span>
                        </div>
                        @endforeach
                        <div class="flex items-center justify-between py-3 bg-green-50 px-3 rounded-lg mt-3">
                            <span class="font-bold text-gray-800">TOTAL</span>
                            <span class="font-bold text-green-600 text-xl">₱{{ number_format($application->latestPayment->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white bg-opacity-20 rounded-lg p-4 border-l-4 border-white">
                    <h3 class="font-bold text-white mb-2"><i class="fas fa-info-circle mr-1"></i> Payment Instructions</h3>
                    <ol class="space-y-2 text-green-100 text-sm">
                        <li><strong>1.</strong> Proceed to the SB Treasury Office</li>
                        <li><strong>2.</strong> Present this Payment Number: <span class="font-mono font-bold bg-white bg-opacity-20 px-2 py-1 rounded">{{ $application->latestPayment->payment_no }}</span></li>
                        <li><strong>3.</strong> Pay the total amount of <strong>₱{{ number_format($application->latestPayment->total_amount, 2) }}</strong></li>
                        <li><strong>4.</strong> Keep your official receipt for your records</li>
                        <li><strong>5.</strong> After payment verification, your application will proceed to final approval</li>
                    </ol>
                </div>

                <div class="mt-4 bg-yellow-100 border-l-4 border-yellow-500 p-3 rounded">
                    <p class="text-yellow-800 text-sm">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        <strong>Important:</strong> Payment must be made within 30 days. After payment, please allow 1-2 business days for verification before your application proceeds to final approval.
                    </p>
                </div>
            </div>
            @endif

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

                        <!-- 4. Payment -->
                        @if($application->status === 'for_treasury')
                            <div class="relative flex items-start space-x-4">
                                <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                                    <h3 class="font-bold text-gray-800">Payment Required</h3>
                                    <p class="text-sm text-gray-600 mt-1">Please proceed to treasury for payment</p>
                                    @if($application->latestPayment)
                                        <p class="text-sm text-blue-700 mt-2">
                                            <strong>Payment No:</strong> {{ $application->latestPayment->payment_no }}<br>
                                            <strong>Amount:</strong> ₱{{ number_format($application->latestPayment->total_amount, 2) }}
                                        </p>
                                    @endif
                                    <p class="text-xs text-gray-500 mt-2">
                                        <i class="fas fa-spinner fa-spin mr-1"></i>
                                        Awaiting Payment
                                    </p>
                                </div>
                            </div>
                        @elseif(in_array($application->status, ['for_approval', 'approved', 'released', 'completed']))
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
                                        <p class="text-sm text-gray-600">Payment No: {{ $application->latestPayment->payment_no }}</p>
                                    @else
                                        <p class="text-sm text-gray-600 mt-1">Payment has been verified</p>
                                    @endif
                                    @if($application->payment_verified_at)
                                        <p class="text-xs text-gray-500 mt-2">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $application->payment_verified_at->format('F d, Y - g:i A') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- 5. Final Approval -->
                        @if($application->status === 'for_approval')
                            <div class="relative flex items-start space-x-4">
                                <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
                                    <i class="fas fa-hourglass-half"></i>
                                </div>
                                <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                                    <h3 class="font-bold text-gray-800">Awaiting Final Approval</h3>
                                    <p class="text-sm text-gray-600 mt-1">SB is reviewing your application for final approval</p>
                                    <p class="text-xs text-gray-500 mt-2">
                                        <i class="fas fa-spinner fa-spin mr-1"></i>
                                        In Progress
                                    </p>
                                </div>
                            </div>
                        @elseif($application->status === 'rejected')
                            <div class="relative flex items-start space-x-4">
                                <div class="relative z-10 w-12 h-12 rounded-full bg-red-500 flex items-center justify-center text-white font-bold">
                                    <i class="fas fa-ban"></i>
                                </div>
                                <div class="flex-1 bg-red-50 p-4 rounded-lg">
                                    <h3 class="font-bold text-gray-800">Application Rejected</h3>
                                    <p class="text-sm text-gray-600 mt-1">Your application was not approved</p>
                                    @if($application->remarks)
                                        <div class="mt-3 bg-red-100 border-l-4 border-red-500 p-2 rounded">
                                            <p class="text-xs text-red-800"><strong>Reason:</strong> {{ $application->remarks }}</p>
                                        </div>
                                    @endif
                                    @if($application->rejected_at)
                                        <p class="text-xs text-gray-500 mt-2">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $application->rejected_at->format('F d, Y - g:i A') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @elseif(in_array($application->status, ['approved', 'released', 'completed']))
                            <div class="relative flex items-start space-x-4">
                                <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                    <h3 class="font-bold text-gray-800">Application Approved</h3>
                                    <p class="text-sm text-gray-600 mt-1">Your franchise application has been approved</p>
                                    @if($application->date_approved)
                                        <p class="text-xs text-gray-500 mt-2">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $application->date_approved->format('F d, Y - g:i A') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- 6. Documents Released -->
                        @if($application->status === 'released' || $application->status === 'completed')
                            <div class="relative flex items-start space-x-4">
                                <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                    <h3 class="font-bold text-gray-800">Documents Released</h3>
                                    <p class="text-sm text-gray-600 mt-1">Your franchise documents are ready for pickup</p>
                                    @if($application->released_at)
                                        <p class="text-xs text-gray-500 mt-2">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $application->released_at->format('F d, Y - g:i A') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- 7. Completed -->
                        @if($application->status === 'completed')
                            <div class="relative flex items-start space-x-4">
                                <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="flex-1 bg-green-50 p-4 rounded-lg border-2 border-green-500">
                                    <h3 class="font-bold text-gray-800">Process Completed</h3>
                                    <p class="text-sm text-gray-600 mt-1">Congratulations! Your franchise application is complete</p>
                                    @if($application->expiration_date)
                                        <p class="text-sm text-green-700 mt-2">
                                            <strong>Valid Until:</strong> {{ $application->expiration_date->format('F d, Y') }}
                                        </p>
                                    @endif
                                    @if($application->completed_at)
                                        <p class="text-xs text-gray-500 mt-2">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $application->completed_at->format('F d, Y - g:i A') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Application Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Application Summary</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Status</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $application->status_label }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Type</span>
                        <span class="font-bold text-gray-800">{{ ucfirst($application->franchise_type) }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Submitted</span>
                        <span class="font-bold text-gray-800">{{ $application->date_submitted ? $application->date_submitted->format('M d, Y') : 'Not yet' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Processing Time</span>
                        <span class="font-bold text-gray-800">10-15 days</span>
                    </div>
                </div>
            </div>

            <!-- Next Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Next Actions</h2>

                <div class="space-y-3">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                            <div>
                                <p class="font-semibold text-blue-800 text-sm">Wait for Review</p>
                                <p class="text-blue-700 text-xs mt-1">SB Staff is reviewing your application</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Need Help?</h2>

                <div class="space-y-3">
                    <a href="{{ route('driver.help') }}" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-headset text-blue-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Contact Support</p>
                            <p class="text-xs text-gray-500">We're here to help</p>
                        </div>
                    </a>

                    <a href="{{ route('driver.help') }}" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-book text-purple-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Application Guide</p>
                            <p class="text-xs text-gray-500">Step-by-step instructions</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

@endsection
