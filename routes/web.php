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
    return view('home');
});

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'Cache and config cleared!';
});