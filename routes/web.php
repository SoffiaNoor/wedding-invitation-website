<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ScanController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Admin Features
Route::get('/invitations/export', [InvitationController::class, 'export'])
    ->name('invitations.export');

Route::resource('invitations', InvitationController::class)
    ->except(['edit', 'update', 'destroy', 'show']);

Route::get('scan', fn() => view('scan'))->name('scan.form');
Route::post('scan', [ScanController::class, 'scan'])->name('scan');

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'Cache and config cleared!';
});

Route::get('{slug}', [InvitationController::class, 'show'])
    ->name('invitations.show');