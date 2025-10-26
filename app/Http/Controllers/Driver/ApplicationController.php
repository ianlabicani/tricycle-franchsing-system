<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationDocument;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    use AuthorizesRequests;

    // Document type validation rules
    private const DOCUMENT_TYPES = [
        'id_picture' => ['image/jpeg', 'image/png', 'image/webp'],
        'cedula' => ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'],
        'lto_certificate' => ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'],
        'lto_receipt' => ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'],
        'engine_stencil' => ['image/jpeg', 'image/png', 'image/webp'],
        'chassis_stencil' => ['image/jpeg', 'image/png', 'image/webp'],
        'tricycle_front' => ['image/jpeg', 'image/png', 'image/webp'],
        'tricycle_side' => ['image/jpeg', 'image/png', 'image/webp'],
        'tricycle_back' => ['image/jpeg', 'image/png', 'image/webp'],
    ];

    private const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB in bytes

    private const MAX_IMAGE_SIZE = 5 * 1024 * 1024; // 5MB for images

    public function index(Request $request)
    {

        $user = $request->user();

        $applications = Application::where('user_id', $user->id)->latest()->get();

        return view('driver.application.index', compact('applications'));
    }

    public function create()
    {
        $user = auth()->user();
        if (Application::userHasActive($user->id)) {
            return redirect()->route('driver.application')
                ->with('error', 'You already have an active application. Please complete or cancel it before creating a new one.');
        }

        return view('driver.application.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if (Application::userHasActive($user->id)) {
            return redirect()->route('driver.application')
                ->with('error', 'You already have an active application. Please complete or cancel it before creating a new one.');
        }

        $validated = $request->validate([
            'franchise_type' => 'required|in:new,renewal,amendment',
            // Personal Information
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
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
            // Route Information
            'route' => 'required|string',
            'operating_hours' => 'required|string|max:100',
            // Additional
            'purpose' => 'nullable|string|max:1000',
            // Documents
            'documents' => 'nullable|array',
            'documents.*' => 'nullable|file',
        ]);

        // Build full name from components
        $fullName = trim($validated['first_name'].' '.$validated['middle_name'].' '.$validated['last_name']);

        $application = Application::create([
            'user_id' => $user->id,
            'franchise_type' => $validated['franchise_type'],
            // Personal Information
            'full_name' => $fullName,
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
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
            // Route Information
            'route' => $validated['route'],
            'operating_hours' => $validated['operating_hours'],
            // Additional
            'purpose' => $validated['purpose'],
            'status' => 'pending_review',
            'date_submitted' => now(),
        ]);

        // Handle document uploads if provided
        if ($request->hasFile('documents')) {
            $this->storeDocuments($application, $request);
        }

        return redirect()->route('driver.application.show', $application)
            ->with('success', 'Application submitted successfully! Your application number is: '.$application->application_no);
    }

    public function show(Application $application)
    {
        $application->load('latestPayment', 'latestInspection', 'documents');

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
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
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
            // Route Information
            'route' => 'required|string',
            'operating_hours' => 'required|string|max:100',
            // Additional
            'purpose' => 'nullable|string|max:1000',
            // Documents
            'documents' => 'nullable|array',
            'documents.*' => 'nullable|file',
        ]);

        // Build full name from components
        $fullName = trim($validated['first_name'].' '.$validated['middle_name'].' '.$validated['last_name']);

        $application->update([
            'franchise_type' => $validated['franchise_type'],
            'full_name' => $fullName,
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'contact_number' => $validated['contact_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'plate_number' => $validated['plate_number'],
            'engine_number' => $validated['engine_number'],
            'chassis_number' => $validated['chassis_number'],
            'year_model' => $validated['year_model'],
            'make' => $validated['make'],
            'route' => $validated['route'],
            'operating_hours' => $validated['operating_hours'],
            'purpose' => $validated['purpose'],
        ]);

        // Handle document uploads if provided
        if ($request->hasFile('documents')) {
            $this->storeDocuments($application, $request);
        }

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

    /**
     * Store uploaded documents for an application
     */
    private function storeDocuments(Application $application, Request $request)
    {
        $documents = $request->file('documents') ?? [];

        foreach ($documents as $documentType => $file) {
            // Skip if no file or invalid document type
            if (! $file || ! isset(self::DOCUMENT_TYPES[$documentType])) {
                continue;
            }

            // Validate file type
            $allowedMimes = self::DOCUMENT_TYPES[$documentType];
            if (! in_array($file->getMimeType(), $allowedMimes)) {
                \Log::warning("Invalid MIME type for {$documentType}: {$file->getMimeType()}");

                continue;
            }

            // Validate file size
            $maxSize = in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'])
                ? self::MAX_IMAGE_SIZE
                : self::MAX_FILE_SIZE;

            if ($file->getSize() > $maxSize) {
                \Log::warning("File too large for {$documentType}: {$file->getSize()}");

                continue;
            }

            // Store the file
            $storagePath = "applications/{$application->id}/{$documentType}";
            $fileName = time().'_'.str_replace(' ', '_', $file->getClientOriginalName());

            try {
                $filePath = $file->storeAs($storagePath, $fileName, 'private');

                if ($filePath) {
                    // Create document record
                    ApplicationDocument::create([
                        'application_id' => $application->id,
                        'document_type' => $documentType,
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $filePath,
                        'mime_type' => $file->getMimeType(),
                        'file_size' => $file->getSize(),
                        'status' => 'pending',
                    ]);

                    \Log::info("Document stored successfully: {$documentType} for application {$application->id}");
                }
            } catch (\Exception $e) {
                \Log::error("Error storing document {$documentType}: {$e->getMessage()}");
            }
        }
    }

    /**
     * View a document (for images, display in browser)
     */
    public function viewDocument(Application $application, ApplicationDocument $document)
    {
        // Ensure the document belongs to this application
        if ($document->application_id !== $application->id) {
            abort(404);
        }

        // Authorize: user must own the application
        $this->authorize('view', $application);

        // Only allow viewing images
        if (! $document->isImage()) {
            return redirect()->route('driver.application.show', $application)
                ->with('error', 'Cannot preview this file type.');
        }

        // Get file content
        if (! Storage::disk('private')->exists($document->file_path)) {
            abort(404, 'File not found');
        }

        return response()->file(
            Storage::disk('private')->path($document->file_path),
            ['Content-Type' => $document->mime_type]
        );
    }

    /**
     * Download a document
     */
    public function downloadDocument(Application $application, ApplicationDocument $document)
    {
        // Ensure the document belongs to this application
        if ($document->application_id !== $application->id) {
            abort(404);
        }

        // Authorize: user must own the application
        $this->authorize('view', $application);

        // Check if file exists
        if (! Storage::disk('private')->exists($document->file_path)) {
            abort(404, 'File not found');
        }

        // Return file download
        return response()->download(
            Storage::disk('private')->path($document->file_path),
            $document->file_name,
            ['Content-Type' => $document->mime_type]
        );
    }

    /**
     * Re-upload a rejected document
     */
    public function reuploadDocument(Request $request, Application $application)
    {
        // Authorize: user must own the application
        $this->authorize('update', $application);

        // Validate request
        $validated = $request->validate([
            'document_id' => 'required|integer|exists:application_documents,id',
            'document_type' => 'required|string|in:id_picture,cedula,lto_certificate,lto_receipt,engine_stencil,chassis_stencil,tricycle_front,tricycle_side,tricycle_back',
            'file' => 'required|file',
        ]);

        // Get the document to be replaced
        $oldDocument = ApplicationDocument::find($validated['document_id']);

        // Verify the document belongs to this application
        if ($oldDocument->application_id !== $application->id) {
            return response()->json([
                'success' => false,
                'message' => 'Document does not belong to this application',
            ], 403);
        }

        // Verify the document is rejected
        if ($oldDocument->status !== 'rejected') {
            return response()->json([
                'success' => false,
                'message' => 'Only rejected documents can be re-uploaded',
            ], 422);
        }

        $file = $request->file('file');
        $documentType = $validated['document_type'];

        // Validate file type
        $allowedMimes = self::DOCUMENT_TYPES[$documentType];
        if (! in_array($file->getMimeType(), $allowedMimes)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid file type for this document',
            ], 422);
        }

        // Validate file size
        $maxSize = in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'])
            ? self::MAX_IMAGE_SIZE
            : self::MAX_FILE_SIZE;

        if ($file->getSize() > $maxSize) {
            return response()->json([
                'success' => false,
                'message' => 'File size exceeds maximum allowed',
            ], 422);
        }

        try {
            // Delete old file if it exists
            if (Storage::disk('private')->exists($oldDocument->file_path)) {
                Storage::disk('private')->delete($oldDocument->file_path);
            }

            // Store new file
            $storagePath = "applications/{$application->id}/{$documentType}";
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $filePath = $file->storeAs($storagePath, $fileName, 'private');

            if ($filePath) {
                // Update the document record (reset to pending for review)
                $oldDocument->update([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $filePath,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'status' => 'pending',
                    'rejection_reason' => null,
                    'reviewed_by' => null,
                    'reviewed_at' => null,
                ]);

                // Also reset application status to pending_review if it was incomplete
                if ($application->status === 'incomplete') {
                    $application->update([
                        'status' => 'pending_review',
                        'date_submitted' => now(),
                    ]);
                }

                \Log::info("Document re-uploaded successfully: {$documentType} for application {$application->id}");

                return response()->json([
                    'success' => true,
                    'message' => 'Document re-uploaded successfully',
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to store file',
            ], 500);
        } catch (\Exception $e) {
            \Log::error("Error re-uploading document {$documentType}: {$e->getMessage()}");

            return response()->json([
                'success' => false,
                'message' => 'Error uploading file: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Preview payment breakdown as PDF
     */
    public function previewPaymentPdf(Application $application)
    {
        $this->authorize('view', $application);

        $payment = $application->latestPayment;
        if (!$payment) {
            return redirect()->route('driver.application.show', $application)
                ->with('error', 'No payment record found');
        }

        try {
            $html = view('driver.application.partials.payment-pdf', [
                'application' => $application,
                'payment' => $payment,
            ])->render();

            // Using DomPDF if available, otherwise return HTML view
            if (class_exists('Barryvdh\DomPDF\Facade\Pdf')) {
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('driver.application.partials.payment-pdf', [
                    'application' => $application,
                    'payment' => $payment,
                ]);

                return $pdf->stream('payment-breakdown.pdf');
            } else {
                // Fallback: return as HTML with print styles
                return response()->view('driver.application.partials.payment-pdf', [
                    'application' => $application,
                    'payment' => $payment,
                ], 200, [
                    'Content-Type' => 'text/html; charset=utf-8',
                ]);
            }
        } catch (\Exception $e) {
            \Log::error("Error previewing payment PDF: {$e->getMessage()}");

            return redirect()->route('driver.application.show', $application)
                ->with('error', 'Error generating PDF preview');
        }
    }

    /**
     * Download payment breakdown as PDF
     */
    public function downloadPaymentPdf(Application $application)
    {
        $this->authorize('view', $application);

        $payment = $application->latestPayment;
        if (!$payment) {
            return redirect()->route('driver.application.show', $application)
                ->with('error', 'No payment record found');
        }

        try {
            if (class_exists('Barryvdh\DomPDF\Facade\Pdf')) {
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('driver.application.partials.payment-pdf', [
                    'application' => $application,
                    'payment' => $payment,
                ]);

                $fileName = "payment-breakdown-{$payment->payment_no}.pdf";

                return $pdf->download($fileName);
            } else {
                // Fallback: send HTML as downloadable file
                $html = view('driver.application.partials.payment-pdf', [
                    'application' => $application,
                    'payment' => $payment,
                ])->render();

                $fileName = "payment-breakdown-{$payment->payment_no}.html";

                return response($html)
                    ->header('Content-Type', 'application/octet-stream')
                    ->header('Content-Disposition', "attachment; filename=\"{$fileName}\"");
            }
        } catch (\Exception $e) {
            \Log::error("Error downloading payment PDF: {$e->getMessage()}");

            return redirect()->route('driver.application.show', $application)
                ->with('error', 'Error generating PDF download');
        }
    }
}

