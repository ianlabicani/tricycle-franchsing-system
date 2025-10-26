<?php

namespace App\Http\Controllers\SB;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Inspection;
use App\Models\Payment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = Inspection::with(['application.user'])->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $inspections = $query->paginate(15);

        // Statistics
        $stats = [
            'total' => Inspection::count(),
            'completed' => Inspection::where('status', 'completed')->count(),
            'cancelled' => Inspection::where('status', 'cancelled')->count(),
            'pass_rate' => Inspection::where('status', 'completed')->count() > 0
                ? round((Inspection::where('result', 'passed')->count() / Inspection::where('status', 'completed')->count()) * 100)
                : 0,
        ];

        return view('sb.inspections.index', compact('inspections', 'stats', 'status'));
    }

    public function create(Request $request)
    {
        $applicationId = $request->get('application_id');
        $application = null;

        if ($applicationId) {
            $application = Application::with('user')->findOrFail($applicationId);

            // Check if application is in the correct status for inspection
            if (! in_array($application->status, ['for_scheduling', 'inspection_scheduled'])) {
                return redirect()->route('sb.applications.show', $application)
                    ->with('error', 'Application must have a schedule before creating an inspection.');
            }
        }

        return view('sb.inspections.create', compact('application'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'scheduled_date' => 'required|date|after_or_equal:today',
            'scheduled_time' => 'required',
            'inspector_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $application = Application::findOrFail($request->application_id);

        // Check if application is in the correct status
        if (! in_array($application->status, ['for_scheduling', 'inspection_scheduled'])) {
            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Application must have a schedule before creating an inspection.');
        }


        $inspection = Inspection::create([
            'application_id' => $request->application_id,
            'scheduled_date' => $request->scheduled_date,
            'scheduled_time' => $request->scheduled_time,
            'inspector_name' => $request->inspector_name,
            'location' => $request->location,
            'notes' => $request->notes,
            'status' => 'scheduled',
            'scheduled_by' => $request->user()->id,
        ]);

        // Update application status and scheduled_at
        $application->update([
            'status' => 'inspection_scheduled',
            'scheduled_at' => now(),
        ]);

        return redirect()->route('sb.inspections.show', $inspection)
            ->with('success', 'Inspection scheduled successfully.');
    }

    public function show(Inspection $inspection)
    {
        $inspection->load(['application.user', 'application.latestPayment']);

        return view('sb.inspections.show', compact('inspection'));
    }

    public function edit(Inspection $inspection)
    {
        $inspection->load(['application.user']);

        return view('sb.inspections.edit', compact('inspection'));
    }

    public function update(Request $request, Inspection $inspection)
    {
        $request->validate([
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required',
            'inspector_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $inspection->update([
            'scheduled_date' => $request->scheduled_date,
            'scheduled_time' => $request->scheduled_time,
            'inspector_name' => $request->inspector_name,
            'location' => $request->location,
            'notes' => $request->notes,
        ]);

        return redirect()->route('sb.inspections.show', $inspection)
            ->with('success', 'Inspection updated successfully.');
    }

    public function complete(Request $request, Inspection $inspection)
    {
        $request->validate([
            'result' => 'required|in:passed,failed',
            'remarks' => 'required|string|max:500',
        ]);


        $inspection->update([
            'status' => 'completed',
            'result' => $request->result,
            'completed_at' => now(),
            'completed_by' => auth()->id(),
            'remarks' => $request->remarks,
        ]);

        // Update application status and inspected_at based on result
        $application = $inspection->application;
        if ($request->result === 'passed') {
            $application->update([
                'status' => 'for_treasury',
                'inspected_at' => now(),
            ]);
        } else {
            $application->update([
                'status' => 'inspection_failed',
                'remarks' => $request->remarks,
                'inspected_at' => now(),
            ]);
        }

        return redirect()->route('sb.inspections.show', $inspection)
            ->with('success', 'Inspection marked as completed.');
    }

    public function cancel(Request $request, Inspection $inspection)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $inspection->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancelled_by' => auth()->id(),
            'cancellation_reason' => $request->reason,
        ]);

        // Update application status - revert to for_scheduling so it can be rescheduled
        $application = $inspection->application;
        $application->update(['status' => 'for_scheduling']);

        return redirect()->route('sb.inspections.show', $inspection)
            ->with('success', 'Inspection cancelled.');
    }
}
