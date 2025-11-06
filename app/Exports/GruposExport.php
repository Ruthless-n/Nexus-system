<?php

namespace App\Exports;

use App\Models\GrupoEconomico;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GruposExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return GrupoEconomico::all(['id', 'nome']);
    }

    public function headings(): array
    {
        return ['ID', 'Nome'];
    }
}
