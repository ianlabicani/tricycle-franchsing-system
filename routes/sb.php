<?php

use App\Http\Controllers\SB\ApplicationController;
use App\Http\Controllers\SB\InspectionController;
use App\Http\Controllers\SB\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('sb')->name('sb.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('sb.dashboard');
    })->name('dashboard');

    // Application Management
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::post('/applications/{application}/approve', [ApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
    Route::post('/applications/{application}/review', [ApplicationController::class, 'review'])->name('applications.review');
    Route::post('/applications/{application}/release', [ApplicationController::class, 'release'])->name('applications.release');
    Route::post('/applications/{application}/complete', [ApplicationController::class, 'complete'])->name('applications.complete');

    // Document Management
    Route::post('/applications/{application}/documents/{document}/approve', [ApplicationController::class, 'approveDocument'])->name('documents.approve');
    Route::post('/applications/{application}/documents/{document}/reject', [ApplicationController::class, 'rejectDocument'])->name('documents.reject');
    Route::get('/applications/{application}/documents/{document}/view', [ApplicationController::class, 'viewDocument'])->name('documents.view');
    Route::get('/applications/{application}/documents/{document}/download', [ApplicationController::class, 'downloadDocument'])->name('documents.download');

    // Payment Management
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{payment}/verify', [PaymentController::class, 'verify'])->name('payments.verify');
    Route::post('/payments/{payment}/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel');
    Route::get('/payments/{payment}/pdf/preview', [PaymentController::class, 'previewPaymentPdf'])->name('payments.pdf.preview');
    Route::get('/payments/{payment}/pdf/download', [PaymentController::class, 'downloadPaymentPdf'])->name('payments.pdf.download');

    // Inspection Management
    Route::get('/inspections', [InspectionController::class, 'index'])->name('inspections.index');
    Route::get('/inspections/create', [InspectionController::class, 'create'])->name('inspections.create');
    Route::post('/inspections', [InspectionController::class, 'store'])->name('inspections.store');
    Route::get('/inspections/{inspection}', [InspectionController::class, 'show'])->name('inspections.show');
    Route::get('/inspections/{inspection}/edit', [InspectionController::class, 'edit'])->name('inspections.edit');
    Route::put('/inspections/{inspection}', [InspectionController::class, 'update'])->name('inspections.update');
    Route::post('/inspections/{inspection}/complete', [InspectionController::class, 'complete'])->name('inspections.complete');
    Route::post('/inspections/{inspection}/cancel', [InspectionController::class, 'cancel'])->name('inspections.cancel');
});

