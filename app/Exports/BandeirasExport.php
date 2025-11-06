<?php

namespace App\Exports;

use App\Models\Bandeira;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BandeirasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Bandeira::all(['id','nome','grupo_economico_id']);
    }

    public function headings(): array
    {
        return ['ID', 'Nome', 'Grupo Econômico ID'];
    }
}