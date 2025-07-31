<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function showScannerForm()
    {
        return view('attendance.scan');
    }

    public function record(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $invitation = Invitation::where('code', $request->code)->first();
        if (!$invitation) {
            return back()->withErrors(['code' => 'Invitation not found.']);
        }

        // Prevent duplicate check-ins on the same day
        if (
            $invitation->attendances()
                ->whereDate('arrived_at', now())->exists()
        ) {
            return back()->with('status', 'Already checked in.');
        }

        $invitation->attendances()->create();
        return back()->with('status', "Welcome, {$invitation->name}!");
    }
}
