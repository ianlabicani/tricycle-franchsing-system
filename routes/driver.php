<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('driver')->name('driver.')->group(function () {
    Route::get('/dashboard', function () {
        return view('driver.dashboard');
    })->name('dashboard');

});
