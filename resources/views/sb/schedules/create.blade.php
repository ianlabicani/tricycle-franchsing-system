@extends('sb.shell')

@section('sb-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('sb.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('sb.applications.show', $application) }}" class="hover:text-purple-600">Application</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Create Schedule</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Create Inspection Schedule</h1>
                <p class="text-gray-600 mt-2">Application ID: <span class="font-bold text-purple-600">FR-{{ str_pad($application->id, 6, '0', STR_PAD_LEFT) }}</span></p>
            </div>
            <a href="{{ route('sb.applications.show', $application) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Application
            </a>
        </div>
    </div>

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
            <div class="flex items-center space-x-3">
                <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                <p class="text-red-800 font-semibold">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Create Form -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Schedule Information</h2>

                <form action="{{ route('sb.schedules.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="application_id" value="{{ $application->id }}">

                    <!-- Schedule Date -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Schedule Date <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            name="schedule_date"
                            value="{{ old('schedule_date', now()->addDay()->format('Y-m-d')) }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('schedule_date') border-red-500 @enderror"
                            required
                        >
                        @error('schedule_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Select the date when the vehicle inspection will be conducted.
                        </p>
                    </div>

                    <!-- Queue Number Info -->
                    <div class="mb-6 bg-purple-50 border-l-4 border-purple-500 p-4 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-purple-500 text-xl mr-3 mt-1"></i>
                            <div>
                                <p class="text-sm text-purple-800 font-semibold">Queue Number Generation</p>
                                <p class="text-xs text-purple-700 mt-1">A unique queue number will be automatically generated based on the selected date (format: YYYYMMDD-XXX)</p>
                                <p class="text-xs text-purple-700 mt-1">Example: 20251007-001, 20251007-002, etc.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Schedule Remarks
                        </label>
                        <textarea
                            name="remarks"
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('remarks') border-red-500 @enderror"
                            placeholder="Add any notes or special instructions for this schedule..."
                        >{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex space-x-3">
                        <button
                            type="submit"
                            class="flex-1 bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition font-semibold"
                        >
                            <i class="fas fa-calendar-plus mr-2"></i>Create Schedule
                        </button>
                        <a
                            href="{{ route('sb.applications.show', $application) }}"
                            class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-lg hover:bg-gray-300 transition font-semibold text-center"
                        >
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">

            <!-- Application Info -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Application Details</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Application ID</span>
                        <span class="font-bold text-purple-600">FR-{{ str_pad($application->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Driver Name</span>
                        <span class="font-bold text-gray-800">{{ $application->user->name }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Email</span>
                        <span class="text-sm text-gray-800">{{ $application->user->email }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Status</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                            For Scheduling
                        </span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Submitted</span>
                        <span class="font-bold text-gray-800">{{ $application->date_submitted ? $application->date_submitted->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Reviewed</span>
                        <span class="font-bold text-gray-800">{{ $application->reviewed_at ? $application->reviewed_at->format('M d, Y') : 'N/A' }}</span>
                    </div>
                </div>

                <a href="{{ route('sb.applications.show', $application) }}" class="block w-full mt-4 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition font-semibold text-center text-sm">
                    <i class="fas fa-eye mr-2"></i>View Full Application
                </a>
            </div>

            <!-- Process Info -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
                    <div>
                        <p class="text-sm text-blue-800 font-semibold">Next Steps</p>
                        <p class="text-xs text-blue-700 mt-1">After creating the schedule:</p>
                        <ul class="text-xs text-blue-700 mt-2 space-y-1 list-disc list-inside">
                            <li>Queue number will be assigned</li>
                            <li>Driver will be notified</li>
                            <li>Inspector can be assigned</li>
                            <li>Inspection can be conducted</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Warning Notice -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-xl mr-3 mt-1"></i>
                    <div>
                        <p class="text-sm text-yellow-800 font-semibold">Important</p>
                        <p class="text-xs text-yellow-700 mt-1">Make sure to schedule the inspection on a date when inspectors are available.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
