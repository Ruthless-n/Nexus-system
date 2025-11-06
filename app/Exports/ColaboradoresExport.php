<?php

namespace App\Exports;

use App\Models\Colaborador;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ColaboradoresExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Colaborador::query()->with('unidade');

        if (!empty($this->filters['unidade_id'])) {
            $query->where('unidade_id', $this->filters['unidade_id']);
        }

        if (!empty($this->filters['nome'])) {
            $query->where('nome', 'like', '%' . $this->filters['nome'] . '%');
        }

        return $query->get(['id', 'nome', 'email', 'cpf', 'unidade_id']);
    }

    public function headings(): array
    {
        return ['ID','Nome','Email','CPF','Unidade ID'];
    }
}