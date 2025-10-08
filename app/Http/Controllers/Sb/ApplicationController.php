<?php

namespace App\Http\Controllers\Sb;

use App\Http\Controllers\Controller;
use App\Models\Application;
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
        $application->load([
            'user',
            'latestInspection',
            'latestPayment',
            'reviewedBy',
            'approvedBy',
            'rejectedBy',
            'releasedBy',
        ]);

        return view('sb.applications.show', compact('application'));
    }

    public function approve(Application $application)
    {
        // Application must be in for_approval status
        if ($application->status !== 'for_approval') {
            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Application must be in "For Approval" status to be approved.');
        }

        $application->update([
            'status' => 'approved',
        ]);

        return redirect()->route('sb.applications.show', $application)
            ->with('success', 'Application approved successfully.');
    }

    public function release(Application $application)
    {
        // Application must be approved
        if ($application->status !== 'approved') {
            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Application must be approved before releasing documents.');
        }

        $application->update([
            'status' => 'released',
        ]);

        return redirect()->route('sb.applications.show', $application)
            ->with('success', 'Documents released successfully.');
    }

    public function complete(Application $application)
    {
        // Application must be released
        if ($application->status !== 'released') {
            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Application must have documents released before completing.');
        }

        $application->update([
            'status' => 'completed',
            'date_completed' => now(),
        ]);

        return redirect()->route('sb.applications.show', $application)
            ->with('success', 'Application completed successfully.');
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
        // If complete, mark as ready for scheduling
        $status = $request->is_complete ? 'for_scheduling' : 'incomplete';

        $application->update([
            'status' => $status,
            'remarks' => $request->remarks,
        ]);

        $message = $status === 'for_scheduling'
            ? 'Application marked as complete and ready for scheduling.'
            : 'Application marked as incomplete. Driver has been notified.';

        return redirect()->route('sb.applications.show', $application)
            ->with('success', $message);
    }
}
