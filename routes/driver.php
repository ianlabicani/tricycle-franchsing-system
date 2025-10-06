<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('driver')->name('driver.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('driver.dashboard');
    })->name('dashboard');

    // Requirements Management
    Route::get('/requirements', function () {
        return view('driver.requirements');
    })->name('requirements');

    // Inspection Management
    Route::get('/inspection', function () {
        return view('driver.inspection');
    })->name('inspection');

    // Application Management
    Route::get('/application', function () {
        return view('driver.application');
    })->name('application');

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
