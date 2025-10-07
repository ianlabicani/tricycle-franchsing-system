@extends('sb.shell')

@section('sb-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('sb.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('sb.schedules.index') }}" class="hover:text-purple-600">Schedules</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Schedule Details</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Schedule Details</h1>
                <p class="text-gray-600 mt-2">Queue Number: <span class="font-bold text-purple-600">{{ $schedule->queue_number }}</span></p>
            </div>
            <a href="{{ route('sb.schedules.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Schedules
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

    <!-- Schedule Status Card -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Inspection Schedule</h2>
                <p class="text-purple-100 mb-4">{{ $schedule->schedule_date->format('l, F d, Y') }}</p>
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-purple-100 text-sm">Queue Number</p>
                        <p class="text-2xl font-bold">{{ $schedule->queue_number }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-purple-100 text-sm">Status</p>
                        <p class="text-xl font-bold">{{ ucfirst($schedule->status) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                        <p class="text-purple-100 text-sm">Application ID</p>
                        <p class="text-xl font-bold">FR-{{ str_pad($schedule->application_id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-6">
                <i class="fas fa-calendar-check text-6xl"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Driver & Vehicle Information -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Driver & Vehicle Information</h2>

                <div class="space-y-6">
                    <!-- Driver Info -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Driver Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                                <p class="text-gray-800 font-semibold">{{ $schedule->application->user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                                <p class="text-gray-800 font-semibold">{{ $schedule->application->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Application Link -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Related Application</h3>
                        <a href="{{ route('sb.applications.show', $schedule->application) }}" class="inline-flex items-center space-x-2 text-purple-600 hover:text-purple-700 font-semibold">
                            <i class="fas fa-file-alt"></i>
                            <span>View Full Application Details</span>
                            <i class="fas fa-arrow-right text-sm"></i>
                        </a>
                    </div>

                    <!-- Schedule Remarks -->
                    @if($schedule->remarks)
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Schedule Remarks</h3>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $schedule->remarks }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Schedule History -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Schedule Timeline</h2>

                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-300"></div>

                    <div class="space-y-6">
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Schedule Created</h3>
                                <p class="text-sm text-gray-600 mt-1">Scheduled by {{ $schedule->scheduledBy->name }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $schedule->created_at->format('M d, Y - h:i A') }}</p>
                            </div>
                        </div>

                        @if($schedule->status === 'completed')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Schedule Completed</h3>
                                <p class="text-sm text-gray-600 mt-1">Inspection completed successfully</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $schedule->updated_at->format('M d, Y - h:i A') }}</p>
                            </div>
                        </div>
                        @elseif($schedule->status === 'cancelled')
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-red-500 flex items-center justify-center text-white font-bold">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="flex-1 bg-red-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Schedule Cancelled</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $schedule->remarks }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $schedule->updated_at->format('M d, Y - h:i A') }}</p>
                            </div>
                        </div>
                        @else
                        <div class="relative flex items-start space-x-4">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold animate-pulse">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                                <h3 class="font-bold text-gray-800">Awaiting Inspection</h3>
                                <p class="text-sm text-gray-600 mt-1">Schedule is pending inspection assignment</p>
                                <p class="text-xs text-gray-500 mt-2">Scheduled for {{ $schedule->schedule_date->format('M d, Y') }}</p>
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
            @if($schedule->status === 'scheduled')
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Actions</h2>

                <div class="space-y-3">
                    <a href="{{ route('sb.schedules.edit', $schedule) }}" class="block w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold text-center">
                        <i class="fas fa-edit mr-2"></i>Re-schedule
                    </a>
                    <a href="{{ route('sb.inspections.create', ['application_id' => $schedule->application_id]) }}" class="block w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition font-semibold text-center">
                        <i class="fas fa-clipboard-check mr-2"></i>Assign Inspection
                    </a>
                </div>
            </div>
            @endif

            <!-- Schedule Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Schedule Summary</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Queue Number</span>
                        <span class="font-bold text-purple-600">{{ $schedule->queue_number }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Status</span>
                        @if($schedule->status === 'scheduled')
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">Scheduled</span>
                        @elseif($schedule->status === 'completed')
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Completed</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Cancelled</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Schedule Date</span>
                        <span class="font-bold text-gray-800">{{ $schedule->schedule_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Scheduled By</span>
                        <span class="font-bold text-gray-800">{{ $schedule->scheduledBy->name }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Created</span>
                        <span class="font-bold text-gray-800">{{ $schedule->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Contact Driver -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Contact Driver</h2>

                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-user text-purple-600"></i>
                        <span class="text-gray-700 text-sm">{{ $schedule->application->user->name }}</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-purple-600"></i>
                        <span class="text-gray-700 text-sm">{{ $schedule->application->user->email }}</span>
                    </div>
                </div>

                <button class="w-full mt-4 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition font-semibold text-sm">
                    <i class="fas fa-paper-plane mr-2"></i>Send Message
                </button>
            </div>

        </div>
    </div>

    <!-- Cancel Modal -->
    <div id="cancelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Cancel Schedule</h3>
            <form action="{{ route('sb.schedules.cancel', $schedule) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Cancellation <span class="text-red-500">*</span></label>
                    <textarea name="remarks" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Please provide a reason for cancelling this schedule..." required></textarea>
                    <p class="text-xs text-gray-500 mt-1">The application status will be reverted to "incomplete"</p>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeCancelModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                        Keep Schedule
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                        Cancel Schedule
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCancelModal() {
            document.getElementById('cancelModal').classList.remove('hidden');
            document.getElementById('cancelModal').classList.add('flex');
        }

        function closeCancelModal() {
            document.getElementById('cancelModal').classList.add('hidden');
            document.getElementById('cancelModal').classList.remove('flex');
        }
    </script>

@endsection
