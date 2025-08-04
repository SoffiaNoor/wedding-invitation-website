<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function scan(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string',
        ]);

        $inv = Invitation::where('code', $data['code'])->first();

        if (!$inv) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode undangan tidak ditemukan.',
            ], 404);
        }

        $todayStart = now()->startOfDay();
        $already = $inv->attendances()
            ->where('arrived_at', '>=', $todayStart)
            ->exists();

        if ($already) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Kedatangan sudah tercatat sebelumnya.',
            ]);
        }

        $inv->attendances()->create([
            'arrived_at' => now(),
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Kedatangan tercatat.',
        ]);
    }
}
