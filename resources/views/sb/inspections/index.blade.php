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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Inspections</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Vehicle Inspections</h1>
            <p class="text-gray-600 mt-1">Manage and schedule vehicle inspections</p>
        </div>
        <a href="{{ route('sb.applications.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-semibold transition flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Schedule Inspection</span>
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Inspections</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total'] ?? 0 }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <i class="fas fa-clipboard-check text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Scheduled</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['scheduled'] ?? 0 }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-calendar-alt text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Completed</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['completed'] ?? 0 }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pass Rate</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['pass_rate'] ?? '0' }}%</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <i class="fas fa-award text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <a href="{{ route('sb.inspections.index') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ !request('status') ? 'border-purple-600 text-purple-600' : '' }}">
                    All Inspections
                    <span class="bg-gray-100 text-gray-900 ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ $stats['total'] ?? 0 }}</span>
                </a>
                <a href="{{ route('sb.inspections.index', ['status' => 'scheduled']) }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ request('status') === 'scheduled' ? 'border-purple-600 text-purple-600' : '' }}">
                    Scheduled
                    <span class="bg-blue-100 text-blue-800 ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ $stats['scheduled'] ?? 0 }}</span>
                </a>
                <a href="{{ route('sb.inspections.index', ['status' => 'completed']) }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ request('status') === 'completed' ? 'border-purple-600 text-purple-600' : '' }}">
                    Completed
                    <span class="bg-green-100 text-green-800 ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ $stats['completed'] ?? 0 }}</span>
                </a>
                <a href="{{ route('sb.inspections.index', ['status' => 'cancelled']) }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ request('status') === 'cancelled' ? 'border-purple-600 text-purple-600' : '' }}">
                    Cancelled
                    <span class="bg-red-100 text-red-800 ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ $stats['cancelled'] ?? 0 }}</span>
                </a>
            </nav>
        </div>

        <!-- Search and Filters -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
                <div class="flex-1 max-w-lg">
                    <div class="relative">
                        <input type="text" placeholder="Search by application number, driver name..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option>All Inspectors</option>
                        <option>Inspector A</option>
                        <option>Inspector B</option>
                    </select>
                    <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option>All Dates</option>
                        <option>Today</option>
                        <option>This Week</option>
                        <option>This Month</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Inspections Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Inspection Details
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Application
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Schedule
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Inspector
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Result
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($inspections as $inspection)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-clipboard-check text-purple-600"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">#{{ $inspection->id }}</div>
                                    <div class="text-sm text-gray-500">{{ $inspection->location }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $inspection->application->application_no }}</div>
                            <div class="text-sm text-gray-500">{{ $inspection->application->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $inspection->scheduled_date->format('M d, Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $inspection->scheduled_time->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $inspection->inspector_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($inspection->status === 'scheduled')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Scheduled
                                </span>
                            @elseif($inspection->status === 'completed')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Completed
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Cancelled
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($inspection->result === 'passed')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i> Passed
                                </span>
                            @elseif($inspection->result === 'failed')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times mr-1"></i> Failed
                                </span>
                            @else
                                <span class="text-sm text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('sb.inspections.show', $inspection) }}" class="text-purple-600 hover:text-purple-900 mr-3">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($inspection->status === 'scheduled')
                            <a href="{{ route('sb.inspections.edit', $inspection) }}" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-clipboard-list text-gray-300 text-6xl mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No inspections found</h3>
                                <p class="text-gray-500">Start by scheduling an inspection for an approved application.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($inspections->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $inspections->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
