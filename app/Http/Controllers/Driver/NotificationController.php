<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $status = $request->get('status', 'all');

        $notificationsQuery = $user->notifications();

        // Filter by read/unread status
        if ($status === 'unread') {
            $notificationsQuery->whereNull('read_at');
        } elseif ($status === 'read') {
            $notificationsQuery->whereNotNull('read_at');
        }

        $notifications = $notificationsQuery->latest()->paginate(15);

        // Get counts
        $allCount = $user->notifications()->count();
        $unreadCount = $user->notifications()->whereNull('read_at')->count();

        return view('driver.notifications.index', compact('notifications', 'status', 'allCount', 'unreadCount'));
    }

    public function markRead($notificationId)
    {
        $user = auth()->user();
        $notification = $user->notifications()->findOrFail($notificationId);
        $notification->markAsRead();

        // If AJAX request, return JSON
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Notification marked as read',
                'notification_id' => $notificationId
            ]);
        }

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    public function markAllRead(Request $request)
    {
        $user = $request->user();
        $user->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
