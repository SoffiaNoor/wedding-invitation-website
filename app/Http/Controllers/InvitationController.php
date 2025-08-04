<?php

namespace App\Http\Controllers;

use App\Exports\InvitationsExport;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class InvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::with('attendances')->paginate(15);
        return view('invitations.index', compact('invitations'));
    }

    public function create()
    {
        return view('invitations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'side' => 'required|in:pria,wanita',
        ]);

        do {
            $code = Str::upper(Str::random(10));
        } while (Invitation::where('code', $code)->exists());

        $data['code'] = $code;
        Invitation::create($data);

        return redirect()
            ->route('invitations.index')
            ->with('success', 'Tamu undangan berhasil ditambahkan. Kode: ' . $code);
    }

    public function export()
    {
        return Excel::download(new InvitationsExport, 'invitations.xlsx');
    }

    public function show($slug)
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();

        return view('home', compact('invitation'));
    }
}
