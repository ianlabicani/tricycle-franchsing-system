    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
    @endif
@extends('driver.shell')

@section('driver-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('driver.dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Applications</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">My Applications</h1>
                <p class="text-gray-600 mt-2">View and manage your franchise applications</p>
            </div>
            @php
                $hasActive = $applications->whereNotIn('status', ['completed', 'released', 'rejected'])->count() > 0;
            @endphp
            <a href="{{ $hasActive ? '#' : route('driver.application.create') }}"
               class="px-6 py-3 {{ $hasActive ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }} text-white rounded-lg transition font-semibold shadow-lg"
               @if($hasActive) onclick="return false;" title="You already have an active application." @endif>
                <i class="fas fa-plus-circle mr-2"></i>New Application
            </a>
        </div>
    </div>

    @if($applications->isEmpty())
    <!-- No Applications State -->
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <div class="max-w-md mx-auto">
            <div class="bg-blue-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-file-alt text-blue-600 text-5xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-3">No Applications Yet</h2>
            <p class="text-gray-600 mb-6">You haven't submitted any franchise applications. Ready to get started?</p>
            <a href="{{ route('driver.application.create') }}" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i>Create Your First Application
            </a>
        </div>
    </div>
    @else

    <!-- Applications List -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Application No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plate Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($applications as $application)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $application->application_no }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ ucfirst($application->franchise_type) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $application->full_name ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $application->plate_number ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'draft' => 'gray',
                                    'pending_review' => 'yellow',
                                    'incomplete' => 'orange',
                                    'for_scheduling' => 'blue',
                                    'inspection_scheduled' => 'blue',
                                    'inspection_pending' => 'blue',
                                    'inspection_failed' => 'red',
                                    'for_treasury' => 'indigo',
                                    'for_approval' => 'indigo',
                                    'approved' => 'green',
                                    'rejected' => 'red',
                                    'released' => 'green',
                                    'completed' => 'green',
                                    'for_renewal' => 'purple',
                                ];
                                $color = $statusColors[$application->status] ?? 'gray';
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $color }}-100 text-{{ $color }}-800">
                                {{ $application->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $application->date_submitted ? $application->date_submitted->format('M d, Y') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('driver.application.show', $application) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-eye"></i> View
                            </a>
                            @if(in_array($application->status, ['draft', 'incomplete']))
                            <a href="{{ route('driver.application.edit', $application) }}" class="text-green-600 hover:text-green-900">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @endif

@endsection
