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

        $request->validate([
            'franchise_type' => 'required|in:new,renewal,amendment',
            'purpose' => 'nullable|string|max:255',
        ]);

        Application::create([
            'user_id' => $user->id,
            'franchise_type' => $request->franchise_type,
            'purpose' => $request->purpose,
            'status' => 'submitted',
            'date_submitted' => now(),
        ]);

        return redirect()->route('driver.application')->with('success', 'Application submitted successfully.');
    }

    public function show(Application $application)
    {
        $this->authorize('view', $application);

        return view('driver.application.show', compact('application'));
    }

    public function edit(Application $application)
    {
        $this->authorize('update', $application);

        return view('driver.application.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $this->authorize('update', $application);

        $request->validate([
            'franchise_type' => 'required|in:new,renewal,amendment',
            'purpose' => 'nullable|string|max:255',
            'status' => 'in:draft,submitted,approved,rejected',
        ]);

        $application->update($request->only(['franchise_type', 'purpose', 'status', 'remarks']));

        return redirect()->route('driver.application')->with('success', 'Application updated successfully.');
    }

    public function destroy(Application $application)
    {
        $this->authorize('delete', $application);
        $application->delete();

        return redirect()->route('driver.application')->with('success', 'Application deleted successfully.');
    }
}
