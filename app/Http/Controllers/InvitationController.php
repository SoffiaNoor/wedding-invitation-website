<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show(Invitation $invitation)
    {
        return view('invitation.show', compact('invitation'));
    }
}
