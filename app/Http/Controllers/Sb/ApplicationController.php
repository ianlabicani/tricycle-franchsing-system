<?php

namespace App\Http\Controllers\Sb;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationDocument;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        // Check if all documents are approved before approving application
        if (! $application->allDocumentsApproved()) {
            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Cannot approve application: Not all documents have been approved. Please review and approve all documents first.');
        }

        // Check if driver has another active application
        $otherActiveApps = Application::where('user_id', $application->user_id)
            ->where('id', '!=', $application->id)
            ->whereNotIn('status', ['completed', 'released', 'rejected'])
            ->exists();

        if ($otherActiveApps) {
            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Cannot approve: Driver already has another active application in the system.');
        }

        $application->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
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
            'released_at' => now(),
            'released_by' => auth()->id(),
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

        $now = now();
        $application->update([
            'status' => 'completed',
            'completed_at' => $now,
            'date_completed' => $now,
            'expiration_date' => $now->copy()->addYears(3),
        ]);

        // If this is a renewal application, archive the previous completed application
        if ($application->franchise_type === 'renewal') {
            $previousApp = Application::where('user_id', $application->user_id)
                ->where('id', '!=', $application->id)
                ->where('status', 'completed')
                ->latest()
                ->first();

            if ($previousApp) {
                $previousApp->update([
                    'status' => 'archived',
                    'archived_at' => $now,
                ]);
            }
        }

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

    public function testRenewal(Application $application)
    {
        // Only for completed applications
        if ($application->status !== 'completed') {
            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Only completed applications can be tested for renewal.');
        }

        // Update expiration date to within the renewal window (within 1 month from now)
        $application->update([
            'expiration_date' => now()->addDays(15), // 15 days from now, which is within the 1-month renewal window
        ]);

        // Trigger the renewal check command immediately
        \Artisan::call('applications:send-renewal-notifications');

        // Refresh the application to get the updated status
        $application->refresh();

        return redirect()->route('sb.applications.show', $application)
            ->with('success', 'Test renewal triggered! Renewal check command executed. Application status updated to: ' . ucfirst(str_replace('_', ' ', $application->status)));
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

        // If marking as complete (for_scheduling), check if all documents are approved
        if ($status === 'for_scheduling') {
            if (! $application->allDocumentsApproved()) {
                return redirect()->route('sb.applications.show', $application)
                    ->with('error', 'Cannot mark as complete: Not all documents have been approved. Please review and approve all documents first.');
            }

            // Check if driver has another active application
            $otherActiveApps = Application::where('user_id', $application->user_id)
                ->where('id', '!=', $application->id)
                ->whereNotIn('status', ['completed', 'released', 'rejected'])
                ->exists();

            if ($otherActiveApps) {
                return redirect()->route('sb.applications.show', $application)
                    ->with('error', 'Cannot mark as complete: Driver already has another active application in the system.');
            }
        }

        $updateFields = [
            'status' => $status,
            'remarks' => $request->remarks,
        ];
        if ($status === 'for_scheduling') {
            $updateFields['reviewed_at'] = now();
            $updateFields['reviewed_by'] = auth()->id();
        }
        $application->update($updateFields);

        $message = $status === 'for_scheduling'
            ? 'Application marked as complete and ready for scheduling.'
            : 'Application marked as incomplete. Driver has been notified.';

        return redirect()->route('sb.applications.show', $application)
            ->with('success', $message);
    }

    /**
     * Approve a single document submitted by the driver.
     */
    public function approveDocument(Application $application, ApplicationDocument $document)
    {
        // Verify the document belongs to this application
        if ($document->application_id !== $application->id) {
            if (request()->wantsJson()) {
                return response()->json(['error' => 'Document not found for this application.'], 404);
            }

            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Document not found for this application.');
        }

        $document->update([
            'status' => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => ucfirst($document->document_label).' approved successfully.']);
        }

        return redirect()->route('sb.applications.show', $application)
            ->with('success', ucfirst($document->document_label).' approved successfully.');
    }

    /**
     * Reject a single document submitted by the driver.
     */
    public function rejectDocument(Request $request, Application $application, ApplicationDocument $document)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        // Verify the document belongs to this application
        if ($document->application_id !== $application->id) {
            if (request()->wantsJson()) {
                return response()->json(['error' => 'Document not found for this application.'], 404);
            }

            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Document not found for this application.');
        }

        $document->update([
            'status' => 'rejected',
            'rejection_reason' => $request->reason,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => ucfirst($document->document_label).' rejected. Driver will be notified.']);
        }

        return redirect()->route('sb.applications.show', $application)
            ->with('success', ucfirst($document->document_label).' rejected. Driver will be notified.');
    }

    /**
     * View a document submitted by the driver (for images).
     */
    public function viewDocument(Application $application, ApplicationDocument $document)
    {
        // Verify the document belongs to this application
        if ($document->application_id !== $application->id) {
            abort(404);
        }

        // Check if file exists
        if (! Storage::disk('private')->exists($document->file_path)) {
            abort(404, 'Document file not found.');
        }

        // For images, display in browser
        if ($document->isImage()) {
            return response()->file(Storage::disk('private')->path($document->file_path));
        }

        // For non-images, download
        return $this->downloadDocument($application, $document);
    }

    /**
     * Download a document submitted by the driver.
     */
    public function downloadDocument(Application $application, ApplicationDocument $document)
    {
        // Verify the document belongs to this application
        if ($document->application_id !== $application->id) {
            abort(404);
        }

        // Check if file exists
        if (! Storage::disk('private')->exists($document->file_path)) {
            abort(404, 'Document file not found.');
        }

        return Storage::disk('private')->download(
            $document->file_path,
            $document->file_name
        );
    }
}
