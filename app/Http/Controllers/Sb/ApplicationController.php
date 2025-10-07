<?php

namespace App\Http\Controllers\Sb;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Schedule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = Application::with('user')->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $applications = $query->paginate(15);

        // Statistics
        $stats = [
            'total' => Application::count(),
            'pending' => Application::where('status', 'pending_review')->count(),
            'under_review' => Application::whereIn('status', ['incomplete', 'for_scheduling'])->count(),
            'approved' => Application::where('status', 'approved')->count(),
            'rejected' => Application::where('status', 'rejected')->count(),
        ];

        return view('sb.applications.index', compact('applications', 'stats', 'status'));
    }

    public function show(Application $application)
    {
        $application->load('user');

        return view('sb.applications.show', compact('application'));
    }

    public function approve(Application $application)
    {
        $application->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        return redirect()->route('sb.applications.show', $application)
            ->with('success', 'Application approved successfully.');
    }

    public function reject(Request $request, Application $application)
    {
        $request->validate([
            'remarks' => 'required|string|max:500',
        ]);

        $application->update([
            'status' => 'rejected',
            'remarks' => $request->remarks,
            'rejected_at' => now(),
            'rejected_by' => auth()->id(),
        ]);

        return redirect()->route('sb.applications.show', $application)
            ->with('success', 'Application rejected.');
    }

    public function review(Request $request, Application $application)
    {
        $request->validate([
            'remarks' => 'nullable|string|max:500',
            'is_complete' => 'required|boolean',
        ]);

        // If documents are incomplete, mark as incomplete
        // If complete, mark as ready for scheduling and create a schedule
        $status = $request->is_complete ? 'for_scheduling' : 'incomplete';

        $application->update([
            'status' => $status,
            'remarks' => $request->remarks,
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
        ]);

        // If marked as complete, automatically create a schedule
        if ($request->is_complete) {
            $scheduleDate = now()->addDay(); // Default to next day, can be modified

            Schedule::create([
                'application_id' => $application->id,
                'scheduled_by' => auth()->id(),
                'schedule_date' => $scheduleDate,
                'queue_number' => Schedule::generateQueueNumber($scheduleDate),
                'status' => 'scheduled',
                'remarks' => 'Auto-generated schedule from application review',
            ]);
        }

        $message = $status === 'for_scheduling'
            ? 'Application marked as complete and schedule created with queue number.'
            : 'Application marked as incomplete. Driver has been notified.';

        return redirect()->route('sb.applications.show', $application)
            ->with('success', $message);
    }
}
