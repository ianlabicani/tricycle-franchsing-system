@extends('sb.shell')

@section('sb-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('sb.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Schedules</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Inspection Schedules</h1>
                <p class="text-gray-600 mt-2">Manage inspection schedules and queue numbers</p>
            </div>
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

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Total Schedules</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $schedules->total() }}</h3>
                </div>
                <div class="bg-purple-100 rounded-full p-4">
                    <i class="fas fa-calendar-alt text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Scheduled</p>
                    <h3 class="text-3xl font-bold text-blue-600">{{ $schedules->where('status', 'scheduled')->count() }}</h3>
                </div>
                <div class="bg-blue-100 rounded-full p-4">
                    <i class="fas fa-clock text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Completed</p>
                    <h3 class="text-3xl font-bold text-green-600">{{ $schedules->where('status', 'completed')->count() }}</h3>
                </div>
                <div class="bg-green-100 rounded-full p-4">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Cancelled</p>
                    <h3 class="text-3xl font-bold text-red-600">{{ $schedules->where('status', 'cancelled')->count() }}</h3>
                </div>
                <div class="bg-red-100 rounded-full p-4">
                    <i class="fas fa-times-circle text-red-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('sb.schedules.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Schedules</option>
                    <option value="scheduled" {{ request('status') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Date</label>
                <input type="date" name="date" value="{{ request('date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
            <div class="flex items-end">
                <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold">
                    <i class="fas fa-filter mr-2"></i>Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Schedules Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-purple-600 to-purple-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Queue Number</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Application</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Driver</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Schedule Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Scheduled By</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($schedules as $schedule)
                    <tr class="hover:bg-purple-50 transition">
                        <td class="px-6 py-4">
                            <span class="font-bold text-purple-600 text-lg">{{ $schedule->queue_number }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-gray-800">FR-{{ str_pad($schedule->application_id, 6, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $schedule->application->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $schedule->application->user->email }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $schedule->schedule_date->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $schedule->schedule_date->format('l') }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-gray-700">{{ $schedule->scheduledBy->name }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($schedule->status === 'scheduled')
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-clock mr-1"></i>Scheduled
                                </span>
                            @elseif($schedule->status === 'completed')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>Completed
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-times-circle mr-1"></i>Cancelled
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('sb.schedules.show', $schedule) }}" class="text-purple-600 hover:text-purple-700 font-semibold text-sm">
                                    <i class="fas fa-eye mr-1"></i>View
                                </a>
                                @if($schedule->status === 'scheduled')
                                <a href="{{ route('sb.schedules.edit', $schedule) }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <i class="fas fa-calendar-times text-gray-400 text-5xl"></i>
                                <p class="text-gray-500 font-semibold">No schedules found</p>
                                <p class="text-gray-400 text-sm">Schedules will appear here when applications are reviewed as complete.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($schedules->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $schedules->links() }}
        </div>
        @endif
    </div>

@endsection
