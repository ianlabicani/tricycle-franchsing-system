@extends('sb.shell')

@section('sb-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('sb.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('sb.schedules.index') }}" class="hover:text-purple-600">Schedules</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('sb.schedules.show', $schedule) }}" class="hover:text-purple-600">Schedule Details</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Edit Schedule</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Schedule</h1>
                <p class="text-gray-600 mt-2">Queue Number: <span class="font-bold text-purple-600">{{ $schedule->queue_number }}</span></p>
            </div>
            <a href="{{ route('sb.schedules.show', $schedule) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Details
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Schedule Information</h2>

                <form action="{{ route('sb.schedules.update', $schedule) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Schedule Date -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Schedule Date <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            name="schedule_date"
                            value="{{ old('schedule_date', $schedule->schedule_date->format('Y-m-d')) }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('schedule_date') border-red-500 @enderror"
                            required
                        >
                        @error('schedule_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            If you change the date, a new queue number will be automatically generated for that date.
                        </p>
                    </div>

                    <!-- Current Queue Number Info -->
                    <div class="mb-6 bg-purple-50 border-l-4 border-purple-500 p-4 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-purple-500 text-xl mr-3 mt-1"></i>
                            <div>
                                <p class="text-sm text-purple-800 font-semibold">Current Queue Number</p>
                                <p class="text-lg text-purple-600 font-bold mt-1">{{ $schedule->queue_number }}</p>
                                <p class="text-xs text-purple-700 mt-1">Queue number will update automatically if the date is changed</p>
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
                            placeholder="Add any notes or remarks about this schedule..."
                        >{{ old('remarks', $schedule->remarks) }}</textarea>
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
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                        <a
                            href="{{ route('sb.schedules.show', $schedule) }}"
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
                <h2 class="text-xl font-bold text-gray-800 mb-4">Related Application</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Application ID</span>
                        <span class="font-bold text-purple-600">FR-{{ str_pad($schedule->application_id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Driver</span>
                        <span class="font-bold text-gray-800">{{ $schedule->application->user->name }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Status</span>
                        <span class="font-bold text-gray-800">{{ ucfirst(str_replace('_', ' ', $schedule->application->status)) }}</span>
                    </div>
                </div>

                <a href="{{ route('sb.applications.show', $schedule->application) }}" class="block w-full mt-4 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition font-semibold text-center text-sm">
                    <i class="fas fa-eye mr-2"></i>View Application
                </a>
            </div>

            <!-- Schedule Info -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Schedule Details</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Current Date</span>
                        <span class="font-bold text-gray-800">{{ $schedule->schedule_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Scheduled By</span>
                        <span class="font-bold text-gray-800">{{ $schedule->scheduledBy->name }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Created</span>
                        <span class="font-bold text-gray-800">{{ $schedule->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Last Updated</span>
                        <span class="font-bold text-gray-800">{{ $schedule->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Warning Notice -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-xl mr-3 mt-1"></i>
                    <div>
                        <p class="text-sm text-yellow-800 font-semibold">Important Notice</p>
                        <p class="text-xs text-yellow-700 mt-1">Changing the schedule date will generate a new queue number based on the number of schedules already assigned for that date.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
