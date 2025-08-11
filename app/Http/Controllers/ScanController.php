<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        try {
            $result = DB::transaction(function () use ($inv, $todayStart) {
                $inv = Invitation::where('id', $inv->id)->lockForUpdate()->first();

                $existing = $inv->attendances()
                    ->where('arrived_at', '>=', $todayStart)
                    ->first();

                if ($existing) {
                    return [
                        'created' => false,
                        'attendance' => $existing,
                        'invitation' => $inv,
                    ];
                }

                $attendance = $inv->attendances()->create([
                    'arrived_at' => now(),
                ]);

                return [
                    'created' => true,
                    'attendance' => $attendance,
                    'invitation' => $inv,
                ];
            }, 5);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server saat mencatat kedatangan.',
            ], 500);
        }

        $invPayload = [
            'id' => $result['invitation']->id,
            'name' => $result['invitation']->name,
            'code' => $result['invitation']->code,
            'side' => $result['invitation']->side,
            'slug' => $result['invitation']->slug ?? null,
        ];

        $att = $result['attendance'];
        $attendancePayload = [
            'id' => $att->id,
            'arrived_at' => optional($att->arrived_at)->toDateTimeString(),
        ];

        if ($result['created']) {
            return response()->json([
                'status' => 'ok',
                'message' => "{$invPayload['name']} — Kedatangan tercatat.",
                'invitation' => $invPayload,
                'attendance' => $attendancePayload,
                'today_count' => $result['invitation']->attendances()->where('arrived_at', '>=', $todayStart)->count(),
            ], 200);
        }

        return response()->json([
            'status' => 'already',
            'message' => "{$invPayload['name']} — Kedatangan sudah tercatat sebelumnya.",
            'invitation' => $invPayload,
            'attendance' => $attendancePayload,
        ], 200);
    }
}
