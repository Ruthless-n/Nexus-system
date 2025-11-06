<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bandeira;
use App\Models\GrupoEconomico;

class BandeiraComponent extends Component
{
    public $bandeiras, $nome, $grupo_economico_id, $bandeiraId;
    public $gruposEconomicos;

    public function mount()
    {
        $this->bandeiras = Bandeira::with('grupoEconomico')->get();
        $this->gruposEconomicos = GrupoEconomico::all();
    }

    public function store()
    {
        if ($this->bandeiraId) {
            // Se estiver editando, usar validação de update
            $this->validate([
                'nome' => 'required|string|max:255|min:3',
                'grupo_economico_id' => 'required|exists:grupo_economicos,id'
            ]);
            
            $bandeira = Bandeira::find($this->bandeiraId);
            if ($bandeira) {
                $bandeira->update([
                    'nome' => trim($this->nome),
                    'grupo_economico_id' => $this->grupo_economico_id
                ]);
                $this->reset(['nome', 'grupo_economico_id', 'bandeiraId']);
            }
        } else {
            // Se não estiver editando, usar validação de criação
            $this->validate([
                'nome' => 'required|string|max:255|min:3',
                'grupo_economico_id' => 'required|exists:grupo_economicos,id'
            ]);
            
            Bandeira::create([
                'nome' => trim($this->nome),
                'grupo_economico_id' => $this->grupo_economico_id
            ]);
            $this->reset(['nome', 'grupo_economico_id']);
        }
        
        $this->bandeiras = Bandeira::with('grupoEconomico')->get();
    }

    public function edit($id)
    {
        $bandeira = Bandeira::find($id);
        if ($bandeira) {
            $this->bandeiraId = $bandeira->id;
            $this->nome = $bandeira->nome;
            $this->grupo_economico_id = $bandeira->grupo_economico_id;
        }
    }

    public function update()
    {
        $this->validate([
            'nome' => 'required|string|max:255|min:3',
            'grupo_economico_id' => 'required|exists:grupo_economicos,id'
        ]);
        
        if ($this->bandeiraId) {
            $bandeira = Bandeira::find($this->bandeiraId);
            if ($bandeira) {
                $bandeira->update([
                    'nome' => trim($this->nome),
                    'grupo_economico_id' => $this->grupo_economico_id
                ]);
                $this->reset(['nome', 'grupo_economico_id', 'bandeiraId']);
            }
        }
        
        $this->bandeiras = Bandeira::with('grupoEconomico')->get();
    }

    public function cancel()
    {
        $this->reset(['nome', 'grupo_economico_id', 'bandeiraId']);
    }

    public function delete($id)
    {
        Bandeira::find($id)->delete();
        $this->bandeiras = Bandeira::with('grupoEconomico')->get();
    }

    public function render()
    {
        return view('livewire.bandeira-component');
    }
}
