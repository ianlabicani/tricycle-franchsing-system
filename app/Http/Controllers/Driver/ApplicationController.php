<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {

        $user = $request->user();

        $applications = Application::where('user_id', $user->id)->latest()->get();

        return view('driver.application.index', compact('applications'));
    }

    public function create()
    {
        return view('driver.application.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'franchise_type' => 'required|in:new,renewal,amendment',
            // Personal Information
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            // Vehicle Information
            'plate_number' => 'required|string|max:20',
            'engine_number' => 'required|string|max:50',
            'chassis_number' => 'required|string|max:50',
            'year_model' => 'required|integer|min:1990|max:'.(date('Y') + 1),
            'make' => 'required|string|max:100',
            'color' => 'required|string|max:50',
            // Route Information
            'route' => 'required|string',
            'operating_hours' => 'required|string|max:100',
            // Additional
            'purpose' => 'nullable|string|max:1000',
        ]);

        $application = Application::create([
            'user_id' => $user->id,
            'franchise_type' => $validated['franchise_type'],
            // Personal Information
            'full_name' => $validated['full_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'contact_number' => $validated['contact_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            // Vehicle Information
            'plate_number' => $validated['plate_number'],
            'engine_number' => $validated['engine_number'],
            'chassis_number' => $validated['chassis_number'],
            'year_model' => $validated['year_model'],
            'make' => $validated['make'],
            'color' => $validated['color'],
            // Route Information
            'route' => $validated['route'],
            'operating_hours' => $validated['operating_hours'],
            // Additional
            'purpose' => $validated['purpose'],
            'status' => 'pending_review',
            'date_submitted' => now(),
        ]);

        return redirect()->route('driver.application.show', $application)
            ->with('success', 'Application submitted successfully! Your application number is: '.$application->application_no);
    }

    public function show(Application $application)
    {
        $application->load('latestPayment');

        return view('driver.application.show', compact('application'));
    }

    public function edit(Application $application)
    {
        $this->authorize('update', $application);

        // Only allow editing if status is draft or incomplete
        if (! in_array($application->status, ['draft', 'incomplete'])) {
            return redirect()->route('driver.application.show', $application)
                ->with('error', 'You cannot edit this application at its current status.');
        }

        return view('driver.application.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $this->authorize('update', $application);

        // Only allow editing if status is draft or incomplete
        if (! in_array($application->status, ['draft', 'incomplete'])) {
            return redirect()->route('driver.application.show', $application)
                ->with('error', 'You cannot edit this application at its current status.');
        }

        $validated = $request->validate([
            'franchise_type' => 'required|in:new,renewal,amendment',
            // Personal Information
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            // Vehicle Information
            'plate_number' => 'required|string|max:20',
            'engine_number' => 'required|string|max:50',
            'chassis_number' => 'required|string|max:50',
            'year_model' => 'required|integer|min:1990|max:'.(date('Y') + 1),
            'make' => 'required|string|max:100',
            'color' => 'required|string|max:50',
            // Route Information
            'route' => 'required|string',
            'operating_hours' => 'required|string|max:100',
            // Additional
            'purpose' => 'nullable|string|max:1000',
        ]);

        $application->update($validated);

        // If status was incomplete, change to pending_review upon resubmission
        if ($application->status === 'incomplete') {
            $application->update([
                'status' => 'pending_review',
                'date_submitted' => now(),
            ]);
        }

        return redirect()->route('driver.application.show', $application)
            ->with('success', 'Application updated successfully.');
    }

    public function destroy(Application $application)
    {
        $this->authorize('delete', $application);

        // Only allow deletion if status is draft
        if ($application->status !== 'draft') {
            return redirect()->route('driver.application')
                ->with('error', 'You cannot delete this application at its current status.');
        }

        $application->delete();

        return redirect()->route('driver.application')
            ->with('success', 'Application deleted successfully.');
    }
}
