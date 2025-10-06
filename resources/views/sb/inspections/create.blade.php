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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Schedule Inspection</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Schedule Vehicle Inspection</h1>
        <p class="text-gray-600 mt-1">Create a new inspection schedule for an approved application</p>
    </div>

    <!-- Application Info Card (if application_id is provided) -->
    @if(request('application_id'))
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-500 text-xl"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Scheduling inspection for application</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <p><strong>Application No:</strong> {{ $application->application_no ?? 'N/A' }}</p>
                    <p><strong>Driver:</strong> {{ $application->user->name ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Inspection Form -->
    <form action="{{ route('sb.inspections.store') }}" method="POST" class="bg-white rounded-lg shadow-md">
        @csrf

        <div class="p-6 space-y-6">
            <!-- Application Selection (if not provided) -->
            @if(!request('application_id'))
            <div>
                <label for="application_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Select Application <span class="text-red-500">*</span>
                </label>
                <select id="application_id" name="application_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">-- Select an Application --</option>
                    @foreach($applications ?? [] as $app)
                    <option value="{{ $app->id }}">{{ $app->application_no }} - {{ $app->user->name }}</option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">Select an approved application that needs inspection</p>
            </div>
            @else
            <input type="hidden" name="application_id" value="{{ request('application_id') }}">
            @endif

            <!-- Inspection Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Scheduled Date -->
                <div>
                    <label for="scheduled_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Inspection Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="scheduled_date" name="scheduled_date" required min="{{ date('Y-m-d') }}" value="{{ old('scheduled_date') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <!-- Scheduled Time -->
                <div>
                    <label for="scheduled_time" class="block text-sm font-medium text-gray-700 mb-2">
                        Inspection Time <span class="text-red-500">*</span>
                    </label>
                    <input type="time" id="scheduled_time" name="scheduled_time" required value="{{ old('scheduled_time', '09:00') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
            </div>

            <!-- Inspector and Location -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Inspector Name -->
                <div>
                    <label for="inspector_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Assigned Inspector <span class="text-red-500">*</span>
                    </label>
                    <select id="inspector_name" name="inspector_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">-- Select Inspector --</option>
                        <option value="Inspector Juan Dela Cruz" {{ old('inspector_name') === 'Inspector Juan Dela Cruz' ? 'selected' : '' }}>Inspector Juan Dela Cruz</option>
                        <option value="Inspector Maria Santos" {{ old('inspector_name') === 'Inspector Maria Santos' ? 'selected' : '' }}>Inspector Maria Santos</option>
                        <option value="Inspector Pedro Garcia" {{ old('inspector_name') === 'Inspector Pedro Garcia' ? 'selected' : '' }}>Inspector Pedro Garcia</option>
                    </select>
                    <p class="text-sm text-gray-500 mt-1">Select the inspector who will conduct the vehicle inspection</p>
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                        Inspection Location <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="location" name="location" required value="{{ old('location', 'Municipal Garage, Barangay Hall') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="e.g., Municipal Garage, Barangay Hall">
                </div>
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Notes / Instructions
                </label>
                <textarea id="notes" name="notes" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Any special instructions or notes for the inspector...">{{ old('notes') }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Optional: Provide any special instructions or requirements for the inspection</p>
            </div>

            <!-- Important Notice -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Important Reminders</h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Ensure the application status is approved before scheduling</li>
                                <li>Verify inspector availability on the selected date and time</li>
                                <li>The driver will be notified via email about the inspection schedule</li>
                                <li>Make sure all required documents are complete before inspection</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 rounded-b-lg">
            <a href="{{ route('sb.inspections.index') }}" class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold transition flex items-center space-x-2">
                <i class="fas fa-calendar-check"></i>
                <span>Schedule Inspection</span>
            </button>
        </div>
    </form>
</div>
@endsection
