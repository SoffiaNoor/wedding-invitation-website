<?php

namespace App\Http\Controllers;

use App\Exports\InvitationsExport;
use App\Imports\InvitationsImport;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class InvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::with('attendances')->get()->map(function ($inv) {
            return [
                'id' => $inv->id,
                'name' => $inv->name,
                'side' => ucfirst($inv->side),
                'code' => $inv->code,
                'barcode_svg' => \Milon\Barcode\Facades\DNS2DFacade::getBarcodeSVG($inv->code, 'QRCODE', 4, 4),
                'arrived_at' => optional($inv->attendances->last())->arrived_at
                    ? $inv->attendances->last()->arrived_at->format('d M Y H:i')
                    : null,
                'slug' => $inv->slug,
                'checkedIn' => $inv->attendances->isNotEmpty()
            ];
        });

        return view('invitations.index', [
            'invitationsJson' => $invitations->toJson()
        ]);
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

    public function printBarcode($slug)
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();

        return view('invitations.print', compact('invitation'));
    }

    public function checkIn(Request $request, Invitation $invitation)
    {
        $request->validate([
            'checked_in' => 'required|boolean'
        ]);

        if ($request->checked_in) {
            $attendance = $invitation->attendances()->latest()->first();

            if (!$attendance) {
                $attendance = $invitation->attendances()->create([
                    'arrived_at' => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'checked_in' => true,
                'arrived_at' => $attendance->arrived_at->format('d M Y H:i'),
            ]);
        }

        $last = $invitation->attendances()->latest()->first();
        if ($last) {
            $last->delete();
        }

        return response()->json([
            'success' => true,
            'checked_in' => false,
            'arrived_at' => null,
        ]);
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:xlsx,xls,csv']);

        $file = $request->file('file');

        $saved = $file->storeAs('imports', uniqid() . '_' . $file->getClientOriginalName());
        $fullPath = storage_path('app/' . $saved);

        if (!file_exists($fullPath) || filesize($fullPath) === 0) {
            return back()->with('error', 'Uploaded file could not be read or is empty.');
        }

        try {
            $reader = IOFactory::createReaderForFile($fullPath);
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($fullPath);
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            return back()->with('error', 'Failed to read spreadsheet: ' . $e->getMessage());
        }

        $sheetNames = $spreadsheet->getSheetNames();

        $summary = [
            'inserted' => 0,
            'skipped' => 0,
            'errors' => []
        ];

        $normalize = function ($s) {
            $s = trim((string) $s);
            $s = preg_replace('/\s+/', ' ', $s);
            return mb_strtolower($s);
        };

        $existingBySide = [];

        DB::beginTransaction();
        try {
            foreach ($sheetNames as $sheetName) {
                $sheet = $spreadsheet->getSheetByName($sheetName);
                if (!$sheet)
                    continue;

                $rows = $sheet->toArray();

                $lowerName = strtolower(trim($sheetName));
                if ($lowerName === 'nabiilah') {
                    $side = 'wanita';
                } elseif ($lowerName === 'zulfi') {
                    $side = 'pria';
                } else {
                    if (str_contains($lowerName, 'nabi'))
                        $side = 'wanita';
                    elseif (str_contains($lowerName, 'zulf'))
                        $side = 'pria';
                    else
                        $side = 'pria';
                }

                if (!array_key_exists($side, $existingBySide)) {
                    $existingBySide[$side] = Invitation::where('side', $side)
                        ->pluck('name')
                        ->map(function ($n) use ($normalize) {
                            return $normalize($n);
                        })
                        ->flip()
                        ->all();
                }

                foreach ($rows as $rowIndex => $cols) {
                    $rawName = trim((string) ($cols[0] ?? ($cols[1] ?? '')));

                    if ($rawName === '') {
                        $summary['skipped']++;
                        continue;
                    }

                    if ($rowIndex === 0) {
                        $lowerFirst = strtolower($rawName);
                        if (str_contains($lowerFirst, 'nama') || str_contains($lowerFirst, 'name')) {
                            $summary['skipped']++;
                            continue;
                        }
                    }

                    $formattedName = $this->formatName($rawName);
                    $nameNorm = $normalize($formattedName);

                    if (isset($existingBySide[$side][$nameNorm])) {
                        $summary['skipped']++;
                        continue;
                    }

                    try {
                        $baseSlug = Str::slug($rawName) ?: 'guest';
                        $slug = $baseSlug;
                        $i = 1;
                        while (Invitation::where('slug', $slug)->exists()) {
                            $slug = $baseSlug . '-' . $i++;
                        }

                        do {
                            $code = strtoupper(Str::random(10));
                        } while (Invitation::where('code', $code)->exists());

                        Invitation::create([
                            'name' => $formattedName,
                            'slug' => $slug,
                            'side' => $side,
                            'code' => $code,
                        ]);

                        $existingBySide[$side][$nameNorm] = true;

                        $summary['inserted']++;
                    } catch (\Throwable $e) {
                        $summary['errors'][] = [
                            'sheet' => $sheetName,
                            'row' => $rowIndex + 1,
                            'message' => $e->getMessage()
                        ];
                    }
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('success', "Import gagal: " . $e->getMessage())
                ->with('import_summary', $summary);
        }

        $msg = "Import selesai. Inserted: {$summary['inserted']}, Skipped: {$summary['skipped']}";
        return back()->with('success', $msg)->with('import_summary', $summary);
    }

    protected function formatName(string $name): string
    {
        $name = trim(preg_replace('/\s+/', ' ', $name));

        $name = mb_strtolower($name, 'UTF-8');
        $name = mb_convert_case($name, MB_CASE_TITLE, 'UTF-8');

        $name = preg_replace_callback("/(['-])([a-z])/u", function ($m) {
            return $m[1] . mb_strtoupper($m[2], 'UTF-8');
        }, $name);

        $name = preg_replace_callback("/\bMc([a-z])/u", function ($m) {
            return 'Mc' . mb_strtoupper($m[1], 'UTF-8');
        }, $name);

        return $name;
    }
}
