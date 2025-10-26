@extends('driver.shell')

@section('driver-content')

    <!-- Breadcrumb -->
    <div class="mb-8">
        <a href="{{ route('driver.inspection') }}" class="text-blue-600 hover:text-blue-700 font-medium">
            <i class="fas fa-arrow-left mr-2"></i>Back to Inspections
        </a>
    </div>

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Inspection Details</h1>
        <p class="text-gray-600 mt-2">Inspection scheduled for {{ $inspection->scheduled_date->format('F d, Y') }}</p>
    </div>

    <!-- Inspection Status Card -->
    <div class="bg-gradient-to-r {{ $inspection->status === 'scheduled' ? 'from-blue-600 to-blue-700' : ($inspection->status === 'completed' && $inspection->result === 'passed' ? 'from-green-600 to-green-700' : ($inspection->status === 'completed' && $inspection->result === 'failed' ? 'from-red-600 to-red-700' : 'from-gray-600 to-gray-700')) }} rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">
                    @if($inspection->status === 'scheduled')
                        Inspection Scheduled
                    @elseif($inspection->status === 'completed')
                        Inspection {{ $inspection->result === 'passed' ? 'Passed' : 'Failed' }}
                    @else
                        Inspection Cancelled
                    @endif
                </h2>
                <p class="text-opacity-90">
                    @if($inspection->status === 'scheduled')
                        Your vehicle inspection has been confirmed
                    @elseif($inspection->status === 'completed')
                        Inspection completed on {{ $inspection->completed_at?->format('F d, Y') ?? 'N/A' }}
                    @else
                        Inspection was cancelled on {{ $inspection->cancelled_at?->format('F d, Y') ?? 'N/A' }}
                    @endif
                </p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <i class="fas {{ $inspection->status === 'scheduled' ? 'fa-clipboard-check' : ($inspection->result === 'passed' ? 'fa-check-circle' : ($inspection->result === 'failed' ? 'fa-times-circle' : 'fa-ban')) }} text-5xl"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Inspection Information -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Inspection Information</h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="border-l-4 border-blue-500 pl-4">
                        <p class="text-sm text-gray-600">Date</p>
                        <p class="font-bold text-gray-800 text-lg">{{ $inspection->scheduled_date->format('F d, Y') }}</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4">
                        <p class="text-sm text-gray-600">Time</p>
                        <p class="font-bold text-gray-800 text-lg">{{ $inspection->scheduled_time->format('h:i A') }}</p>
                    </div>
                    <div class="border-l-4 border-purple-500 pl-4">
                        <p class="text-sm text-gray-600">Location</p>
                        <p class="font-bold text-gray-800 text-lg">{{ $inspection->location ?? 'N/A' }}</p>
                    </div>
                    <div class="border-l-4 border-orange-500 pl-4">
                        <p class="text-sm text-gray-600">Inspector</p>
                        <p class="font-bold text-gray-800 text-lg">{{ $inspection->inspector_name ?? 'To be assigned' }}</p>
                    </div>
                    <div class="border-l-4 border-indigo-500 pl-4">
                        <p class="text-sm text-gray-600">Status</p>
                        <p class="font-bold text-gray-800 text-lg">{{ ucfirst($inspection->status) }}</p>
                    </div>
                    @if($inspection->status === 'completed')
                        <div class="border-l-4 border-pink-500 pl-4">
                            <p class="text-sm text-gray-600">Result</p>
                            <p class="font-bold text-lg {{ $inspection->result === 'passed' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($inspection->result) }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Vehicle Details -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Vehicle Details</h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600">Plate Number</p>
                        <p class="font-bold text-gray-800">{{ $inspection->application->plate_number ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Make & Model</p>
                        <p class="font-bold text-gray-800">{{ $inspection->application->make ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Color</p>
                        <p class="font-bold text-gray-800">{{ $inspection->application->color ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Year Model</p>
                        <p class="font-bold text-gray-800">{{ $inspection->application->year_model ?? 'N/A' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-600">Route</p>
                        <p class="font-bold text-gray-800">{{ $inspection->application->route ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Application Link -->
            <div class="bg-blue-50 rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Related Application</h2>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Application Number</p>
                        <p class="font-bold text-gray-800 text-lg">{{ $inspection->application->application_no }}</p>
                        <p class="text-sm text-gray-500 mt-1">Status: {{ $inspection->application->status_label }}</p>
                    </div>
                    <a href="{{ route('driver.application.show', $inspection->application) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-eye mr-2"></i>View Application
                    </a>
                </div>
            </div>

            <!-- Inspection Remarks -->
            @if($inspection->remarks || $inspection->notes)
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Remarks & Notes</h2>

                    @if($inspection->remarks)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 font-semibold">Remarks</p>
                            <p class="text-gray-800 mt-2">{{ $inspection->remarks }}</p>
                        </div>
                    @endif

                    @if($inspection->notes)
                        <div>
                            <p class="text-sm text-gray-600 font-semibold">Notes</p>
                            <p class="text-gray-800 mt-2">{{ $inspection->notes }}</p>
                        </div>
                    @endif
                </div>
            @endif

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Timeline -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Timeline</h2>

                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="bg-blue-100 p-2 rounded">
                            <i class="fas fa-calendar text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Scheduled</p>
                            <p class="text-xs text-gray-500">{{ $inspection->created_at->format('F d, Y h:i A') }}</p>
                        </div>
                    </div>

                    @if($inspection->status === 'completed' && $inspection->completed_at)
                        <div class="flex items-start space-x-3">
                            <div class="bg-green-100 p-2 rounded">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">{{ $inspection->result === 'passed' ? 'Passed' : 'Failed' }}</p>
                                <p class="text-xs text-gray-500">{{ $inspection->completed_at->format('F d, Y h:i A') }}</p>
                            </div>
                        </div>
                    @elseif($inspection->status === 'cancelled' && $inspection->cancelled_at)
                        <div class="flex items-start space-x-3">
                            <div class="bg-red-100 p-2 rounded">
                                <i class="fas fa-times text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">Cancelled</p>
                                <p class="text-xs text-gray-500">{{ $inspection->cancelled_at->format('F d, Y h:i A') }}</p>
                                @if($inspection->cancellation_reason)
                                    <p class="text-xs text-gray-600 mt-1">Reason: {{ $inspection->cancellation_reason }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Inspector Info -->
            @if($inspection->inspector_name || $inspection->scheduledBy)
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Inspector Info</h2>

                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-user-tie text-blue-600 text-xl"></i>
                            <div>
                                <p class="text-sm text-gray-600">Assigned Inspector</p>
                                <p class="font-semibold text-gray-800">{{ $inspection->inspector_name ?? 'To be assigned' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Actions -->
            @if($inspection->status === 'scheduled')
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Actions</h2>

                    <div class="space-y-3">
                        <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                            <i class="fas fa-directions mr-2"></i>Get Directions
                        </button>
                        <button class="w-full bg-orange-600 text-white py-3 rounded-lg hover:bg-orange-700 transition font-semibold">
                            <i class="fas fa-calendar-alt mr-2"></i>Reschedule
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
