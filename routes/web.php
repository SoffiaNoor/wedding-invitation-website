<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ScanController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Admin Features
Route::get('/print-barcode/{slug}', [InvitationController::class, 'printBarcode'])
    ->name('invitations.print');

Route::get('/invitations/export', [InvitationController::class, 'export'])
    ->name('invitations.export');

Route::post('/invitations/import', [InvitationController::class, 'import'])
    ->name('invitations.import');

Route::resource('invitations', InvitationController::class)
    ->except(['edit', 'update', 'destroy', 'show']);

Route::post('/invitations/{invitation}/check-in', [InvitationController::class, 'checkIn'])
    ->name('invitations.checkin');

Route::get('scan', fn() => view('scan'))->name('scan.form');
Route::post('scan', [ScanController::class, 'scan'])->name('scan');

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'Cache and config cleared!';
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});


Route::get('{slug}', [InvitationController::class, 'show'])
    ->name('invitations.show');