@extends('sb.shell')

@section('sb-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('sb.dashboard') }}" class="hover:text-purple-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Payment Management</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Payment Management</h1>
                <p class="text-gray-600 mt-2">Manage and verify franchise payments</p>
            </div>
            <a href="{{ route('sb.payments.create') }}" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold shadow-lg">
                <i class="fas fa-plus mr-2"></i>Create Payment Record
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

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Payments</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-4">
                    <i class="fas fa-file-invoice-dollar text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pending</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-4">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Paid</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['paid'] }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-4">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Revenue</p>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">₱{{ number_format($stats['total_amount'], 2) }}</p>
                </div>
                <div class="bg-indigo-100 rounded-full p-4">
                    <i class="fas fa-peso-sign text-indigo-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-xl shadow-lg mb-6">
        <!-- Search Bar -->
        <div class="p-6 border-b border-gray-200">
            <form action="{{ route('sb.payments.index') }}" method="GET" class="flex items-center space-x-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search by payment number, applicant name, or application number..."
                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                </div>
                <input type="hidden" name="status" value="{{ $status }}">
                <button type="submit" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
                @if(request('search'))
                <a href="{{ route('sb.payments.index', ['status' => $status]) }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                    <i class="fas fa-times mr-2"></i>Clear
                </a>
                @endif
            </form>
            @if(request('search'))
            <div class="mt-3">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-info-circle mr-1"></i>
                    Showing results for: <span class="font-semibold text-purple-600">"{{ request('search') }}"</span>
                </p>
            </div>
            @endif
        </div>

        <!-- Filter Tabs -->
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <a href="{{ route('sb.payments.index', ['search' => request('search')]) }}" class="py-4 px-6 text-center border-b-2 font-medium text-sm {{ $status === 'all' ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    All Payments
                    @if($status === 'all')
                        <span class="ml-2 bg-purple-100 text-purple-600 px-2 py-1 rounded-full text-xs">{{ $stats['total'] }}</span>
                    @endif
                </a>
                <a href="{{ route('sb.payments.index', ['status' => 'pending', 'search' => request('search')]) }}" class="py-4 px-6 text-center border-b-2 font-medium text-sm {{ $status === 'pending' ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Pending
                    @if($status === 'pending')
                        <span class="ml-2 bg-purple-100 text-purple-600 px-2 py-1 rounded-full text-xs">{{ $stats['pending'] }}</span>
                    @endif
                </a>
                <a href="{{ route('sb.payments.index', ['status' => 'paid', 'search' => request('search')]) }}" class="py-4 px-6 text-center border-b-2 font-medium text-sm {{ $status === 'paid' ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Paid
                    @if($status === 'paid')
                        <span class="ml-2 bg-purple-100 text-purple-600 px-2 py-1 rounded-full text-xs">{{ $stats['paid'] }}</span>
                    @endif
                </a>
                <a href="{{ route('sb.payments.index', ['status' => 'cancelled', 'search' => request('search')]) }}" class="py-4 px-6 text-center border-b-2 font-medium text-sm {{ $status === 'cancelled' ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Cancelled
                </a>
            </nav>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Application No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($payments as $payment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-bold text-purple-600">{{ $payment->payment_no }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <span class="text-purple-600 font-bold text-sm">{{ substr($payment->application->user->name, 0, 2) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $payment->application->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $payment->application->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-gray-900">{{ $payment->application->application_no }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-bold text-gray-900">₱{{ number_format($payment->total_amount, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($payment->status === 'pending')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($payment->status === 'paid')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Paid
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Cancelled
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $payment->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('sb.payments.show', $payment) }}" class="text-purple-600 hover:text-purple-900 mr-3">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                                @if(request('search'))
                                    <p class="text-gray-500 font-medium">No payments found for "{{ request('search') }}"</p>
                                    <p class="text-gray-400 text-sm mt-1">Try adjusting your search terms</p>
                                    <a href="{{ route('sb.payments.index', ['status' => $status]) }}" class="mt-4 text-purple-600 hover:text-purple-700 font-semibold">
                                        <i class="fas fa-times mr-1"></i>Clear search
                                    </a>
                                @else
                                    <p class="text-gray-500 font-medium">No payments found</p>
                                    <p class="text-gray-400 text-sm mt-1">Payment records will appear here</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($payments->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $payments->links() }}
        </div>
        @endif
    </div>

@endsection
