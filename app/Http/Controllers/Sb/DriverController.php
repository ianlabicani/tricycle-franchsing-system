<?php

namespace App\Http\Controllers\Sb;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status', 'all');

        // Only get users with driver role
        $query = User::with(['applications' => function ($q) {
            // Load applications ordered by latest, but exclude archived in the display
            $q->orderBy('created_at', 'desc');
        }])
                     ->whereHas('roles', function ($q) {
                         $q->where('name', 'driver');
                     })
                     ->latest();

        // Search by name or email
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        // Filter by application status
        if ($status !== 'all') {
            $query->whereHas('applications', function ($q) use ($status) {
                $q->where('status', $status);
            });
        }

        $drivers = $query->paginate(15);

        // Statistics (only for drivers)
        $stats = [
            'total' => User::whereHas('roles', function ($q) {
                $q->where('name', 'driver');
            })->count(),
            'active' => User::whereHas('roles', function ($q) {
                $q->where('name', 'driver');
            })->whereHas('applications', function ($q) {
                $q->where('status', 'completed');
            })->count(),
            'pending' => User::whereHas('roles', function ($q) {
                $q->where('name', 'driver');
            })->whereHas('applications', function ($q) {
                $q->whereIn('status', ['pending_review', 'incomplete', 'for_scheduling']);
            })->count(),
            'renewal' => User::whereHas('roles', function ($q) {
                $q->where('name', 'driver');
            })->whereHas('applications', function ($q) {
                $q->where('status', 'for_renewal');
            })->count(),
        ];

        return view('sb.drivers.index', compact('drivers', 'stats', 'search', 'status'));
    }

    public function show(User $user)
    {
        $user->load(['applications' => function ($query) {
            $query->latest();
        }]);

        // Get summary stats for this driver
        $stats = [
            'total_applications' => $user->applications->count(),
            'completed' => $user->applications->where('status', 'completed')->count(),
            'active' => $user->applications->where('status', '!=', 'completed')
                                           ->where('status', '!=', 'rejected')
                                           ->where('status', '!=', 'archived')
                                           ->count(),
        ];

        return view('sb.drivers.show', compact('user', 'stats'));
    }
}
