<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Inspection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $user = $request->user();

        // Get the scheduled inspection for the active application
        $inspection = Inspection::whereHas('application', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->where('status', 'scheduled')
            ->with(['application', 'scheduledBy', 'completedBy', 'cancelledBy'])
            ->latest()
            ->first();

        // Get inspection history (past inspections)
        $inspectionHistory = Inspection::whereHas('application', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->whereIn('status', ['completed', 'cancelled'])
            ->with(['application', 'scheduledBy', 'completedBy', 'cancelledBy'])
            ->latest()
            ->get();

        return view('driver.inspections.index', compact('inspection', 'inspectionHistory'));
    }

    public function show(Inspection $inspection)
    {
        // Verify the inspection belongs to the current user's application
        // $this->authorize('view', $inspection);

        $inspection->load(['application', 'scheduledBy', 'completedBy', 'cancelledBy']);

        return view('driver.inspections.show', compact('inspection'));
    }
}
