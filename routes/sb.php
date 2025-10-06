<?php

use App\Http\Controllers\SB\ApplicationController;
use App\Http\Controllers\SB\InspectionController;
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

