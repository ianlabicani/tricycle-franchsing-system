<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Get the latest/active application
        $activeApplication = Application::where('user_id', $user->id)
            ->whereNotIn('status', ['rejected', 'completed', 'archived'])
            ->with(['latestInspection', 'latestPayment'])
            ->latest()
            ->first();

        // Get the latest completed application
        $latestApprovedApplication = Application::where('user_id', $user->id)
            ->where('status', 'completed')
            ->with([
                'latestInspection',
                'latestPayment',
                'approvedBy',
                'documents',
            ])
            ->latest()
            ->first();

        // Get application statistics
        $stats = [
            'total_applications' => Application::where('user_id', $user->id)->count(),
            'pending' => Application::where('user_id', $user->id)
                ->whereIn('status', ['pending_review', 'incomplete', 'for_scheduling'])
                ->count(),
            'in_progress' => Application::where('user_id', $user->id)
                ->whereIn('status', ['inspection_scheduled', 'inspection_pending', 'for_treasury', 'for_approval'])
                ->count(),
            'completed' => Application::where('user_id', $user->id)
                ->where('status', 'completed')
                ->count(),
        ];

        // Get recent applications (last 5)
        $recentApplications = Application::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('driver.dashboard', compact('activeApplication', 'latestApprovedApplication', 'stats', 'recentApplications'));
    }
}
