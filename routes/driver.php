<?php

use App\Http\Controllers\Driver\ApplicationController;
use App\Http\Controllers\Driver\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('driver')->name('driver.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Requirements Management
    Route::get('/requirements', function () {
        return view('driver.requirements');
    })->name('requirements');

    // Inspection Management
    Route::get('/inspection', function () {
        return view('driver.inspection');
    })->name('inspection');

    // Application Management
    Route::get('/application', [ApplicationController::class, 'index'])->name('application');
    Route::get('/application/create', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/application', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('/application/{application}', [ApplicationController::class, 'show'])->name('application.show');
    Route::get('/application/{application}/edit', [ApplicationController::class, 'edit'])->name('application.edit');
    Route::put('/application/{application}', [ApplicationController::class, 'update'])->name('application.update');
    Route::delete('/application/{application}', [ApplicationController::class, 'destroy'])->name('application.destroy');
    Route::get('/application/{application}/document/{document}/view', [ApplicationController::class, 'viewDocument'])->name('application.document.view');
    Route::get('/application/{application}/document/{document}/download', [ApplicationController::class, 'downloadDocument'])->name('application.document.download');
    Route::post('/applications/{application}/documents/reupload', [ApplicationController::class, 'reuploadDocument'])->name('application.document.reupload');

    // Payment Breakdown
    Route::get('/application/{application}/payment/{payment}/preview', [ApplicationController::class, 'previewPaymentPdf'])->name('payment.preview');
    Route::get('/application/{application}/payment/{payment}/download', [ApplicationController::class, 'downloadPaymentPdf'])->name('payment.download');

    // Payments
    Route::get('/payments', function () {
        return view('driver.payments');
    })->name('payments');

    // Profile
    Route::get('/profile', function () {
        return view('driver.profile');
    })->name('profile');

    // Renewals
    Route::get('/renewals', function () {
        return view('driver.renewals');
    })->name('renewals');

    // Notifications
    Route::get('/notifications', function () {
        return view('driver.notifications');
    })->name('notifications');

    // Help & Support
    Route::get('/help', function () {
        return view('driver.help');
    })->name('help');
});
