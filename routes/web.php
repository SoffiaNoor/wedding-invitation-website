<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Public invitation page
// Route::get('/{invitation}', [InvitationController::class, 'show'])
//     ->where('invitation', '[A-Za-z0-9\-]+')
//     ->name('invitation.show');

// // Attendance scanner
// Route::get('/scan', [AttendanceController::class, 'showScannerForm'])
//     ->name('attendance.scan.form');
// Route::post('/scan', [AttendanceController::class, 'record'])
//     ->name('attendance.record');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'Cache and config cleared!';
});

Route::get('/opening', function () {
    return view('partials.opening');
});

Route::get('/couple', function () {
    return view('partials.couple');
});

Route::get('/date', function () {
    return view('partials.date');
});

Route::get('/quotes', function () {
    return view('partials.quotes');
});

Route::get('/barcode', function () {
    return view('partials.barcode');
});

Route::get('/gallery', function () {
    return view('partials.gallery');
});

Route::get('/wedding-gift', function () {
    return view('partials.wedding-gift');
});