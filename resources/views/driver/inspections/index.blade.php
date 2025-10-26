@extends('driver.shell')

@section('driver-content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Vehicle Inspection</h1>
        <p class="text-gray-600 mt-2">Schedule and track your vehicle inspection appointments</p>
    </div>

    <!-- All Inspections Summary -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">All Inspections</h2>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Time</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Vehicle</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Result</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Inspector</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $allInspections = collect([$inspection])->filter()->merge($inspectionHistory);
                        @endphp
                        @forelse($allInspections as $insp)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $insp->scheduled_date->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $insp->scheduled_time->format('h:i A') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    <span class="font-semibold">{{ $insp->application->plate_number ?? 'N/A' }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $insp->status === 'scheduled' ? 'bg-blue-100 text-blue-800' : ($insp->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($insp->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($insp->status === 'completed')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $insp->result === 'passed' ? 'bg-green-100 text-green-800' : ($insp->result === 'failed' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                                            <i class="fas {{ $insp->result === 'passed' ? 'fa-check-circle mr-1' : ($insp->result === 'failed' ? 'fa-times-circle mr-1' : '') }}"></i>
                                            {{ ucfirst($insp->result ?? 'N/A') }}
                                        </span>
                                    @elseif($insp->status === 'cancelled')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                            <i class="fas fa-ban mr-1"></i>Cancelled
                                        </span>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $insp->inspector_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('driver.inspections.show', $insp) }}" class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-xs font-semibold">
                                        <i class="fas fa-eye mr-1"></i>View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-inbox text-3xl mb-2 block text-gray-300"></i>
                                    No inspections yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($inspection)
        <!-- Current Inspection Status -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-8 mb-8 text-white">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Inspection Scheduled</h2>
                    <p class="text-blue-100">Your vehicle inspection has been confirmed</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-clipboard-check text-5xl"></i>
                </div>
            </div>

            <div class="grid md:grid-cols-4 gap-6 mt-6">
                <div class="bg-white bg-opacity-10 rounded-lg p-4">
                    <p class="text-blue-100 text-sm mb-1">Date</p>
                    <p class="text-xl font-bold">{{ $inspection->scheduled_date->format('M d, Y') }}</p>
                </div>
                <div class="bg-white bg-opacity-10 rounded-lg p-4">
                    <p class="text-blue-100 text-sm mb-1">Time</p>
                    <p class="text-xl font-bold">{{ $inspection->scheduled_time->format('h:i A') }}</p>
                </div>
                <div class="bg-white bg-opacity-10 rounded-lg p-4">
                    <p class="text-blue-100 text-sm mb-1">Status</p>
                    <p class="text-xl font-bold">{{ ucfirst($inspection->status) }}</p>
                </div>
                <div class="bg-white bg-opacity-10 rounded-lg p-4">
                    <p class="text-blue-100 text-sm mb-1">Inspector</p>
                    <p class="text-xl font-bold">{{ $inspection->inspector_name ?? 'To be assigned' }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Inspection Details -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Inspection Information -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Inspection Details</h2>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-4 pb-4 border-b border-gray-200">
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 mb-1">Location</h3>
                                <p class="text-gray-600">{{ $inspection->location ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 pb-4 border-b border-gray-200">
                            <div class="bg-green-100 p-3 rounded-lg">
                                <i class="fas fa-user-tie text-green-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 mb-1">Assigned Inspector</h3>
                                <p class="text-gray-600">{{ $inspection->inspector_name ?? 'To be assigned' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 pb-4 border-b border-gray-200">
                            <div class="bg-purple-100 p-3 rounded-lg">
                                <i class="fas fa-car text-purple-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 mb-1">Vehicle Details</h3>
                                <p class="text-gray-600">Plate Number: {{ $inspection->application->plate_number ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-500 mt-1">Make: {{ $inspection->application->make ?? 'N/A' }} | Color: {{ $inspection->application->color ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-orange-100 p-3 rounded-lg">
                                <i class="fas fa-clock text-orange-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 mb-1">Estimated Duration</h3>
                                <p class="text-gray-600">30-45 minutes</p>
                                <p class="text-sm text-gray-500 mt-1">Please arrive 15 minutes early</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-3">
                        <a href="{{ route('driver.inspections.show', $inspection) }}" class="flex-1 bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold flex items-center justify-center">
                            <i class="fas fa-eye mr-2"></i>View Details
                        </a>
                        <button class="flex-1 bg-orange-600 text-white py-3 rounded-lg hover:bg-orange-700 transition font-semibold">
                            <i class="fas fa-calendar-alt mr-2"></i>Reschedule
                        </button>
                    </div>
                </div>

                <!-- Inspection Checklist -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Inspection Checklist</h2>

                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <span class="text-gray-800">Vehicle lights (headlights, taillights, brake lights)</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <span class="text-gray-800">Braking system functionality</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <span class="text-gray-800">Tire condition and tread depth</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <span class="text-gray-800">Engine condition and emissions</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <span class="text-gray-800">Body and frame condition</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <span class="text-gray-800">Safety equipment (mirrors, horn, seatbelts)</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <span class="text-gray-800">Registration and documentation</span>
                        </div>
                    </div>
                </div>

                <!-- Inspection History -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Inspection History</h2>

                    @if($inspectionHistory->count() > 0)
                        <div class="space-y-4">
                            @foreach($inspectionHistory as $pastInspection)
                                <a href="{{ route('driver.inspections.show', $pastInspection) }}" class="flex items-start space-x-4 p-4 {{ $pastInspection->status === 'completed' && $pastInspection->result === 'passed' ? 'bg-green-50 border-l-4 border-green-500' : ($pastInspection->status === 'completed' && $pastInspection->result === 'failed' ? 'bg-red-50 border-l-4 border-red-500' : 'bg-gray-50 border-l-4 border-gray-400') }} rounded hover:shadow-md transition cursor-pointer">
                                    <i class="fas {{ $pastInspection->status === 'completed' && $pastInspection->result === 'passed' ? 'fa-check-circle text-green-600' : ($pastInspection->status === 'completed' && $pastInspection->result === 'failed' ? 'fa-times-circle text-red-600' : 'fa-ban text-gray-600') }} text-2xl mt-1"></i>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <h3 class="font-bold text-gray-800">{{ $pastInspection->status === 'completed' ? 'Inspection ' . ($pastInspection->result === 'passed' ? 'Passed' : 'Failed') : 'Cancelled' }}</h3>
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $pastInspection->status === 'completed' && $pastInspection->result === 'passed' ? 'bg-green-100 text-green-800' : ($pastInspection->status === 'completed' && $pastInspection->result === 'failed' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ ucfirst($pastInspection->status) }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600">Date: {{ $pastInspection->scheduled_date->format('F d, Y') }} | Inspector: {{ $pastInspection->inspector_name ?? 'N/A' }}</p>
                                        @if($pastInspection->remarks)
                                            <p class="text-sm text-gray-500 mt-1">Remarks: {{ $pastInspection->remarks }}</p>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 text-center py-8">No past inspections yet</p>
                    @endif
                </div>

            </div>

            <!-- Sidebar -->
            <div class="space-y-6">

                <!-- What to Bring -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">What to Bring</h2>

                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check text-blue-600 mt-1"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Original OR/CR</p>
                                <p class="text-sm text-gray-500">Official Receipt & Certificate of Registration</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check text-blue-600 mt-1"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Driver's License</p>
                                <p class="text-sm text-gray-500">Valid and unexpired</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check text-blue-600 mt-1"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Vehicle</p>
                                <p class="text-sm text-gray-500">Clean and in good condition</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check text-blue-600 mt-1"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Previous Report</p>
                                <p class="text-sm text-gray-500">If renewal (optional)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inspection Fee -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Inspection Fee</h2>

                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                        <p class="text-blue-800 font-semibold text-sm mb-2">Total Amount</p>
                        <p class="text-blue-900 text-3xl font-bold">₱1,500.00</p>
                        <p class="text-blue-700 text-xs mt-2">Payment due after inspection</p>
                    </div>

                    <div class="mt-4 space-y-2 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Inspection Fee:</span>
                            <span class="font-semibold">₱1,200.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Processing Fee:</span>
                            <span class="font-semibold">₱300.00</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Need Help?</h2>

                    <div class="space-y-3">
                        <a href="#" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <i class="fas fa-phone text-green-600 text-xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">Call Us</p>
                                <p class="text-xs text-gray-500">+63 123 456 7890</p>
                            </div>
                        </a>

                        <a href="#" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <i class="fas fa-envelope text-blue-600 text-xl"></i>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">Email</p>
                                <p class="text-xs text-gray-500">support@franchise.com</p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    @else
        <!-- No Scheduled Inspection -->
        <div class="bg-white rounded-xl shadow-lg p-12 text-center mb-8">
            <div class="max-w-md mx-auto">
                <div class="bg-yellow-100 rounded-full p-6 w-24 h-24 mx-auto mb-6 flex items-center justify-center">
                    <i class="fas fa-calendar-times text-yellow-600 text-5xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">No Inspection Scheduled</h2>
                <p class="text-gray-600 mb-8">You don't have any scheduled inspections at this time.</p>
                <p class="text-gray-500 text-sm">An inspection will be scheduled once your application is approved.</p>
            </div>
        </div>
    @endif

@endsection
