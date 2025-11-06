<?php

namespace App\Exports;

use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UnidadesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Unidade::all(['id','nome','bandeira_id']);
    }

    public function headings(): array
    {
        return ['ID','Nome','Bandeira ID'];
    }
}