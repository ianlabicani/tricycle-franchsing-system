@extends('sb.shell')

@section('sb-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('sb.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Applications</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Driver Applications</h1>
        <p class="text-gray-600 mt-2">Review and manage franchise applications</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Applications -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Applications</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total'] }}</h3>
                </div>
                <div class="bg-blue-100 p-4 rounded-full">
                    <i class="fas fa-file-alt text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Pending Review</p>
                    <h3 class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['pending'] }}</h3>
                </div>
                <div class="bg-yellow-100 p-4 rounded-full">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Approved -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Approved</p>
                    <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $stats['approved'] }}</h3>
                </div>
                <div class="bg-green-100 p-4 rounded-full">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Rejected -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Rejected</p>
                    <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $stats['rejected'] }}</h3>
                </div>
                <div class="bg-red-100 p-4 rounded-full">
                    <i class="fas fa-times-circle text-red-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Applications Table -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <!-- Filter Tabs -->
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <div class="flex space-x-2">
                <a href="{{ route('sb.applications.index', ['status' => 'all']) }}"
                   class="px-4 py-2 rounded-lg font-semibold transition {{ $status === 'all' ? 'bg-purple-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All
                </a>
                <a href="{{ route('sb.applications.index', ['status' => 'submitted']) }}"
                   class="px-4 py-2 rounded-lg font-semibold transition {{ $status === 'submitted' ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Pending
                </a>
                <a href="{{ route('sb.applications.index', ['status' => 'under_review']) }}"
                   class="px-4 py-2 rounded-lg font-semibold transition {{ $status === 'under_review' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Under Review
                </a>
                <a href="{{ route('sb.applications.index', ['status' => 'approved']) }}"
                   class="px-4 py-2 rounded-lg font-semibold transition {{ $status === 'approved' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Approved
                </a>
                <a href="{{ route('sb.applications.index', ['status' => 'rejected']) }}"
                   class="px-4 py-2 rounded-lg font-semibold transition {{ $status === 'rejected' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Rejected
                </a>
            </div>

            <div class="flex items-center space-x-3">
                <input type="text" placeholder="Search applications..." class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        @if($applications->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-inbox text-gray-400 text-5xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No Applications Found</h3>
                <p class="text-gray-600">There are no applications matching your filter criteria.</p>
            </div>
        @else
            <!-- Applications Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 text-left text-sm font-semibold text-gray-700">
                            <th class="px-4 py-3">Application ID</th>
                            <th class="px-4 py-3">Driver Name</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Submitted Date</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($applications as $application)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4">
                                <span class="font-mono text-sm text-gray-800">FR-{{ str_pad($application->id, 6, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="h-8 w-8 rounded-full">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $application->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $application->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <span class="capitalize text-gray-700">{{ $application->franchise_type ?? 'New' }}</span>
                            </td>
                            <td class="px-4 py-4">
                                <p class="text-gray-700">{{ $application->date_submitted ? $application->date_submitted->format('M d, Y') : 'N/A' }}</p>
                                <p class="text-xs text-gray-500">{{ $application->date_submitted ? $application->date_submitted->format('h:i A') : '' }}</p>
                            </td>
                            <td class="px-4 py-4">
                                @if($application->status === 'submitted')
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                                @elseif($application->status === 'under_review')
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">Under Review</span>
                                @elseif($application->status === 'approved')
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Approved</span>
                                @elseif($application->status === 'rejected')
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Rejected</span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">{{ ucfirst($application->status) }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <a href="{{ route('sb.applications.show', $application) }}" class="text-purple-600 hover:text-purple-700 font-semibold text-sm">
                                    <i class="fas fa-eye mr-1"></i>Review
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $applications->links() }}
            </div>
        @endif
    </div>

@endsection
