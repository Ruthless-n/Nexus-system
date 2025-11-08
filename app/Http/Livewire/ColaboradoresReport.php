<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Support\Facades\URL;

class ColaboradoresReport extends Component
{
    use WithPagination;

    public $unidade_id;
    public $nome;

    protected $queryString = [
        'unidade_id' => ['except' => ''],
        'nome' => ['except' => ''],
    ];

    public function render()
    {
        $query = Colaborador::with('unidade');

        if ($this->unidade_id) {
            $query->where('unidade_id', $this->unidade_id);
        }

        if ($this->nome) {
            $query->where('nome', 'like', '%' . $this->nome . '%');
        }

        return view('livewire.colaboradores-report', [
            'colaboradores' => $query->paginate(10),
            'unidades' => Unidade::orderBy('nome_fantasia')->get(),
        ]);
    }

    public function export()
    {
        return redirect()->route('export.colaboradores', [
            'unidade_id' => $this->unidade_id,
            'nome' => $this->nome,
        ]);
    }
}
