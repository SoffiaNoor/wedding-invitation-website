<?php

namespace App\Exports;

use App\Models\Invitation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvitationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Invitation::select('id', 'name', 'side', 'code')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama', 'Pengantin', 'Kode'];
    }
}
