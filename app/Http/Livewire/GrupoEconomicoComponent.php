<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\GrupoEconomico;

class GrupoEconomicoComponent extends Component
{
    public $grupos, $nome, $grupoId;

    public function mount()
    {
        $this->grupos = GrupoEconomico::all();
    }

    public function store()
    {
        $this->validate([
            'nome' => 'required|string|max:255|min:3'
        ]);
        
        if ($this->grupoId) {
            // Se estiver editando, atualizar
            $grupo = GrupoEconomico::find($this->grupoId);
            if ($grupo) {
                $grupo->update(['nome' => trim($this->nome)]);
                $this->reset(['nome', 'grupoId']);
            }
        } else {
            // Se não estiver editando, criar novo
            GrupoEconomico::create(['nome' => trim($this->nome)]);
            $this->reset('nome');
        }
        
        $this->grupos = GrupoEconomico::all();
    }

    public function edit($id)
    {
        $grupo = GrupoEconomico::find($id);
        if ($grupo) {
            $this->grupoId = $grupo->id;
            $this->nome = $grupo->nome;
        }
    }

    public function update()
    {
        $this->validate([
            'nome' => 'required|string|max:255|min:3'
        ]);
        
        if ($this->grupoId) {
            $grupo = GrupoEconomico::find($this->grupoId);
            if ($grupo) {
                $grupo->update(['nome' => trim($this->nome)]);
                $this->reset(['nome', 'grupoId']);
            }
        }
        
        $this->grupos = GrupoEconomico::all();
    }

    public function cancel()
    {
        $this->reset(['nome', 'grupoId']);
    }

    public function delete($id)
    {
        GrupoEconomico::find($id)->delete();
        $this->grupos = GrupoEconomico::all();
    }

    public function render()
    {
        return view('livewire.grupo-economico-component');
    }
}