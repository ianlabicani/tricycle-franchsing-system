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
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Color</label>
                                <p class="text-gray-800 font-semibold">{{ $application->color ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Route Information -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Route Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Preferred Route</label>
                                <p class="text-gray-800 font-semibold">{{ $application->route ?? 'N/A' }}</p>
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
                        @php
                            $statuses = [
                                'draft' => ['icon' => 'fa-file-alt', 'title' => 'Draft Created', 'desc' => 'Application form created', 'date' => $application->created_at],
                                'pending_review' => ['icon' => 'fa-paper-plane', 'title' => 'Application Submitted', 'desc' => 'Submitted for SB Staff review', 'date' => $application->date_submitted],
                                'incomplete' => ['icon' => 'fa-exclamation-circle', 'title' => 'Incomplete Requirements', 'desc' => 'Additional documents required', 'date' => $application->reviewed_at, 'warning' => true],
                                'for_scheduling' => ['icon' => 'fa-check-circle', 'title' => 'Review Completed', 'desc' => 'Ready for inspection scheduling', 'date' => $application->reviewed_at],
                                'inspection_scheduled' => ['icon' => 'fa-calendar-check', 'title' => 'Inspection Scheduled', 'desc' => 'Inspection date and time set', 'date' => $application->scheduled_at],
                                'inspection_pending' => ['icon' => 'fa-clipboard-check', 'title' => 'Awaiting Inspection', 'desc' => 'Vehicle inspection in progress', 'date' => $application->scheduled_at],
                                'inspection_failed' => ['icon' => 'fa-times-circle', 'title' => 'Inspection Failed', 'desc' => 'Vehicle did not pass inspection', 'date' => $application->inspected_at, 'danger' => true],
                                'for_treasury' => ['icon' => 'fa-money-bill-wave', 'title' => 'For Payment', 'desc' => 'Proceed to treasury for payment', 'date' => $application->inspected_at],
                                'for_approval' => ['icon' => 'fa-hourglass-half', 'title' => 'For Final Approval', 'desc' => 'Payment verified, awaiting SB approval', 'date' => $application->payment_verified_at],
                                'approved' => ['icon' => 'fa-check-double', 'title' => 'Application Approved', 'desc' => 'Approved by SB officials', 'date' => $application->date_approved],
                                'rejected' => ['icon' => 'fa-ban', 'title' => 'Application Rejected', 'desc' => 'Application was not approved', 'date' => $application->rejected_at, 'danger' => true],
                                'released' => ['icon' => 'fa-file-export', 'title' => 'Documents Released', 'desc' => 'Franchise documents ready for pickup', 'date' => $application->released_at],
                                'completed' => ['icon' => 'fa-trophy', 'title' => 'Process Completed', 'desc' => 'All requirements fulfilled', 'date' => $application->completed_at],
                                'for_renewal' => ['icon' => 'fa-redo', 'title' => 'For Renewal', 'desc' => 'Franchise due for renewal', 'date' => $application->expiration_date],
                            ];

                            $currentStatusIndex = array_search($application->status, array_keys($statuses));
                            $statusIndex = 0;
                        @endphp

                        @foreach($statuses as $statusKey => $statusInfo)
                            @php
                                $thisStatusIndex = $statusIndex++;
                                $isPassed = $thisStatusIndex < $currentStatusIndex || $statusKey === $application->status;
                                $isCurrent = $statusKey === $application->status;
                                $isFuture = $thisStatusIndex > $currentStatusIndex;

                                // Skip certain statuses if not relevant
                                if ($statusKey === 'incomplete' && $application->status !== 'incomplete' && !in_array('incomplete', [$application->status])) {
                                    continue;
                                }
                                if ($statusKey === 'inspection_failed' && $application->status !== 'inspection_failed') {
                                    continue;
                                }
                                if ($statusKey === 'rejected' && $application->status !== 'rejected') {
                                    continue;
                                }

                                // Determine colors
                                if (isset($statusInfo['danger'])) {
                                    $bgColor = 'bg-red-500';
                                    $cardBg = 'bg-red-50';
                                    $textColor = 'text-gray-800';
                                } elseif (isset($statusInfo['warning'])) {
                                    $bgColor = 'bg-orange-500';
                                    $cardBg = 'bg-orange-50';
                                    $textColor = 'text-gray-800';
                                } elseif ($isCurrent) {
                                    $bgColor = 'bg-blue-500';
                                    $cardBg = 'bg-blue-50';
                                    $textColor = 'text-gray-800';
                                } elseif ($isPassed) {
                                    $bgColor = 'bg-green-500';
                                    $cardBg = 'bg-green-50';
                                    $textColor = 'text-gray-800';
                                } else {
                                    $bgColor = 'bg-gray-300';
                                    $cardBg = 'bg-gray-50';
                                    $textColor = 'text-gray-600';
                                }
                            @endphp

                            <div class="relative flex items-start space-x-4">
                                <div class="relative z-10 w-12 h-12 rounded-full {{ $bgColor }} flex items-center justify-center text-white font-bold {{ $isCurrent && !isset($statusInfo['danger']) ? 'animate-pulse' : '' }}">
                                    @if($isPassed && !$isCurrent)
                                        <i class="fas fa-check"></i>
                                    @else
                                        <i class="fas {{ $statusInfo['icon'] }}"></i>
                                    @endif
                                </div>
                                <div class="flex-1 {{ $cardBg }} p-4 rounded-lg">
                                    <h3 class="font-bold {{ $textColor }}">{{ $statusInfo['title'] }}</h3>
                                    <p class="text-sm {{ $isFuture ? 'text-gray-500' : 'text-gray-600' }} mt-1">{{ $statusInfo['desc'] }}</p>
                                    @if($statusInfo['date'])
                                        <p class="text-xs text-gray-500 mt-2">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $statusInfo['date']->format('F d, Y - g:i A') }}
                                        </p>
                                    @elseif($isCurrent)
                                        <p class="text-xs text-gray-500 mt-2">
                                            <i class="fas fa-spinner fa-spin mr-1"></i>
                                            In Progress
                                        </p>
                                    @else
                                        <p class="text-xs text-gray-400 mt-2">Pending</p>
                                    @endif

                                    @if($isCurrent && $application->remarks)
                                        <div class="mt-3 bg-yellow-100 border-l-4 border-yellow-500 p-2 rounded">
                                            <p class="text-xs text-yellow-800"><strong>Note:</strong> {{ $application->remarks }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
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
