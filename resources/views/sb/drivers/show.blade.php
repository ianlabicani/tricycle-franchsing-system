@extends('sb.shell')

@section('sb-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('sb.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('sb.drivers.index') }}" class="hover:text-purple-600">Drivers</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">{{ $user->name }}</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                <p class="text-gray-600 mt-2">{{ $user->email }}</p>
            </div>
            <a href="{{ route('sb.drivers.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Drivers
            </a>
        </div>
    </div>

    <!-- Driver Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Applications</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_applications'] }}</p>
                </div>
                <div class="bg-blue-100 p-4 rounded-lg">
                    <i class="fas fa-file-alt text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Completed</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['completed'] }}</p>
                </div>
                <div class="bg-green-100 p-4 rounded-lg">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Active</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['active'] }}</p>
                </div>
                <div class="bg-purple-100 p-4 rounded-lg">
                    <i class="fas fa-hourglass-half text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2">

            <!-- Driver Information -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Driver Information</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Name</span>
                        <span class="font-bold text-gray-800">{{ $user->name }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Email</span>
                        <span class="font-bold text-gray-800">{{ $user->email }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Phone</span>
                        <span class="font-bold text-gray-800">{{ $user->phone_number ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Member Since</span>
                        <span class="font-bold text-gray-800">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Status</span>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Active</span>
                    </div>
                </div>
            </div>

            <!-- Applications List -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Applications</h2>

                <div class="space-y-3">
                    @forelse($user->applications as $application)
                    <div class="flex items-start justify-between p-4 border rounded-lg hover:bg-gray-50 transition">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">{{ $application->application_no }}</p>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-info-circle mr-1"></i>
                                Type: {{ ucfirst($application->franchise_type) }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-calendar mr-1"></i>
                                Submitted: {{ $application->date_submitted ? $application->date_submitted->format('M d, Y') : 'N/A' }}
                            </p>
                        </div>
                        <div class="text-right">
                            @php
                                $statusColors = [
                                    'completed' => 'bg-green-100 text-green-800',
                                    'for_renewal' => 'bg-purple-100 text-purple-800',
                                    'approved' => 'bg-green-100 text-green-800',
                                    'pending_review' => 'bg-yellow-100 text-yellow-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                ];
                                $color = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $color }} block mb-2">
                                {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                            </span>
                            <a href="{{ route('sb.applications.show', $application) }}" class="text-purple-600 hover:text-purple-900 text-sm font-semibold">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-inbox text-3xl mb-2 block text-gray-300"></i>
                        <p>No applications found</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Contact Information -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Contact</h2>

                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-purple-600"></i>
                        <span class="text-gray-700 text-sm break-all">{{ $user->email }}</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-phone text-purple-600"></i>
                        <span class="text-gray-700 text-sm">{{ $user->phone_number ?? 'N/A' }}</span>
                    </div>
                </div>

                <button class="w-full mt-4 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition font-semibold text-sm">
                    <i class="fas fa-paper-plane mr-2"></i>Send Message
                </button>
            </div>

            <!-- Application Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Application Summary</h2>

                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 text-sm">Total Apps</span>
                        <span class="font-bold text-gray-800">{{ $stats['total_applications'] }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600 text-sm">Completed</span>
                        <span class="font-bold text-green-600">{{ $stats['completed'] }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600 text-sm">Active</span>
                        <span class="font-bold text-purple-600">{{ $stats['active'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 text-sm">Success Rate</span>
                        @php
                            $successRate = $stats['total_applications'] > 0
                                ? round(($stats['completed'] / $stats['total_applications']) * 100)
                                : 0;
                        @endphp
                        <span class="font-bold text-gray-800">{{ $successRate }}%</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
