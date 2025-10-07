<?php

namespace App\Http\Controllers\Sb;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Schedule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of schedules.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $date = $request->get('date');

        $query = Schedule::with(['application.user', 'scheduledBy'])
            ->orderBy('schedule_date', 'asc')
            ->orderBy('queue_number', 'asc');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($date) {
            $query->whereDate('schedule_date', $date);
        }

        $schedules = $query->paginate(20);

        return view('sb.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new schedule.
     */
    public function create(Request $request)
    {
        $applicationId = $request->get('application_id');
        $application = Application::with('user')->findOrFail($applicationId);

        // Check if application is in the correct status
        if ($application->status !== 'for_scheduling') {
            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Application must be reviewed and marked as complete before scheduling.');
        }

        // Check if schedule already exists
        if ($application->latestSchedule && $application->latestSchedule->status === 'scheduled') {
            return redirect()->route('sb.schedules.show', $application->latestSchedule)
                ->with('info', 'A schedule already exists for this application.');
        }

        return view('sb.schedules.create', compact('application'));
    }

    /**
     * Store a newly created schedule.
     */
    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'schedule_date' => 'required|date|after_or_equal:today',
            'remarks' => 'nullable|string|max:500',
        ]);

        $application = Application::findOrFail($request->application_id);

        // Check if application is in the correct status
        if ($application->status !== 'for_scheduling') {
            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Application must be reviewed and marked as complete before scheduling.');
        }

        // Create the schedule
        $schedule = Schedule::create([
            'application_id' => $application->id,
            'scheduled_by' => auth()->id(),
            'schedule_date' => $request->schedule_date,
            'queue_number' => Schedule::generateQueueNumber($request->schedule_date),
            'status' => 'scheduled',
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('sb.schedules.show', $schedule)
            ->with('success', 'Schedule created successfully with queue number: ' . $schedule->queue_number);
    }

    /**
     * Show the form for editing the specified schedule.
     */
    public function edit(Schedule $schedule)
    {
        $schedule->load(['application.user', 'scheduledBy']);

        return view('sb.schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified schedule.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'schedule_date' => 'required|date|after_or_equal:today',
            'remarks' => 'nullable|string|max:500',
        ]);

        $oldDate = $schedule->schedule_date;
        $newDate = $request->schedule_date;

        // If date changed, regenerate queue number
        if ($oldDate->format('Y-m-d') !== $newDate) {
            $schedule->update([
                'schedule_date' => $newDate,
                'queue_number' => Schedule::generateQueueNumber($newDate),
                'remarks' => $request->remarks,
            ]);
        } else {
            $schedule->update([
                'remarks' => $request->remarks,
            ]);
        }

        return redirect()->route('sb.schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    /**
     * Cancel the specified schedule.
     */
    public function cancel(Request $request, Schedule $schedule)
    {
        $request->validate([
            'remarks' => 'required|string|max:500',
        ]);

        $schedule->update([
            'status' => 'cancelled',
            'remarks' => $request->remarks,
        ]);

        // Revert application status
        $schedule->application->update([
            'status' => 'incomplete',
        ]);

        return redirect()->route('sb.schedules.index')
            ->with('success', 'Schedule cancelled successfully.');
    }

    /**
     * Display the specified schedule.
     */
    public function show(Schedule $schedule)
    {
        $schedule->load(['application.user', 'scheduledBy']);

        return view('sb.schedules.show', compact('schedule'));
    }
}
