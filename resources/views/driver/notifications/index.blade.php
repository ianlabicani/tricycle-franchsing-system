@extends('driver.shell')

@section('driver-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('driver.dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Notifications</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Notifications</h1>
                <p class="text-gray-600 mt-2">View all your system notifications and updates</p>
            </div>
            @if($unreadCount > 0)
                <form action="{{ route('driver.notifications.mark-all-read') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-check-double mr-2"></i>Mark All as Read
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-lg mb-6 p-4">
        <div class="flex items-center space-x-4 flex-wrap">
            <a href="{{ route('driver.notifications') }}" class="px-4 py-2 rounded-lg font-semibold transition {{ $status === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All Notifications
                <span class="ml-2 text-sm">{{ $allCount }}</span>
            </a>
            <a href="{{ route('driver.notifications', ['status' => 'unread']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ $status === 'unread' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Unread
                @if($unreadCount > 0)
                    <span class="ml-2 text-sm bg-red-500 text-white px-2 py-1 rounded-full">{{ $unreadCount }}</span>
                @endif
            </a>
            <a href="{{ route('driver.notifications', ['status' => 'read']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ $status === 'read' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Read
            </a>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="space-y-4">
        @forelse($notifications as $notification)
            @php
                $isRead = $notification->read_at !== null;
                $data = $notification->data;
            @endphp
            <div
                data-notification-id="{{ $notification->id }}"
                data-is-read="{{ $isRead ? 'true' : 'false' }}"
                data-application-id="{{ $data['application_id'] ?? '' }}"
                onclick="openNotificationModal('{{ $notification->id }}')"
                class="bg-white rounded-xl shadow-lg p-6 border-l-4 {{ $isRead ? 'border-gray-300 bg-gray-50' : 'border-blue-600 bg-blue-50' }} hover:shadow-xl transition cursor-pointer"
            >
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="flex-shrink-0">
                                @if(strpos($data['title'], 'Renewal') !== false)
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-yellow-100">
                                        <i class="fas fa-sync-alt text-yellow-600 text-lg"></i>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-blue-100">
                                        <i class="fas fa-bell text-blue-600 text-lg"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">
                                    <span data-title>{{ $data['title'] }}</span>
                                </h3>
                                <p class="text-sm text-gray-500" data-timestamp>
                                    {{ $notification->created_at->format('F d, Y') }} at {{ $notification->created_at->format('h:i A') }}
                                </p>
                            </div>
                        </div>

                        <p class="text-gray-700 mt-3 ml-13" data-message>{{ $data['message'] }}</p>

                        <div class="mt-4 ml-13 hidden">
                            <span data-badge>
                                @if(strpos($data['title'], 'Renewal') !== false)
                                    Renewal Notice
                                @else
                                    System Notification
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="flex-shrink-0 ml-4">
                        @if(!$isRead)
                            <div class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-600 text-white">
                                <i class="fas fa-circle text-xs"></i>
                            </div>
                        @else
                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-check-double text-sm"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No Notifications</h3>
                <p class="text-gray-600">
                    @if($status === 'unread')
                        You're all caught up! No unread notifications.
                    @else
                        You don't have any notifications yet.
                    @endif
                </p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($notifications->hasPages())
        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
    @endif

    <!-- Include Notification Modal -->
    @include('driver.notifications.show-modal')

@endsection
