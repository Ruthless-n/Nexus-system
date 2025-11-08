<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Unidade;
use App\Models\Bandeira;
use Illuminate\Validation\Rule;

class UnidadeComponent extends Component
{
    public $unidades, $nome_fantasia, $razao_social, $cnpj, $bandeira_id, $unidadeId;
    public $bandeiras;

    public function mount()
    {
        $this->unidades = Unidade::with('bandeira')->get();
        $this->bandeiras = Bandeira::all();
    }

    public function store()
    {
        if ($this->unidadeId) {
            $this->validate([
                'nome_fantasia' => 'required|string|max:255|min:3',
                'razao_social' => 'required|string|max:255|min:3',
                'cnpj' => [
                    'required',
                    'string',
                    'max:18',
                    Rule::unique('unidades', 'cnpj')->ignore($this->unidadeId),
                    function ($attribute, $value, $fail) {
                        if (!$this->validateCnpj($value)) {
                            $fail('O CNPJ informado é inválido.');
                        }
                    }
                ],
                'bandeira_id' => 'required|exists:bandeiras,id'
            ]);
            
            $unidade = Unidade::find($this->unidadeId);
            if ($unidade) {
                $unidade->update([
                    'nome_fantasia' => trim($this->nome_fantasia),
                    'razao_social' => trim($this->razao_social),
                    'cnpj' => $this->formatCnpj($this->cnpj),
                    'bandeira_id' => $this->bandeira_id
                ]);
                $this->reset(['nome_fantasia', 'razao_social', 'cnpj', 'bandeira_id', 'unidadeId']);
            }
        } else {
            // Se não estiver editando, usar validação de criação
            $this->validate([
                'nome_fantasia' => 'required|string|max:255|min:3',
                'razao_social' => 'required|string|max:255|min:3',
                'cnpj' => [
                    'required',
                    'string',
                    'max:18',
                    'unique:unidades,cnpj',
                    function ($attribute, $value, $fail) {
                        if (!$this->validateCnpj($value)) {
                            $fail('O CNPJ informado é inválido.');
                        }
                    }
                ],
                'bandeira_id' => 'required|exists:bandeiras,id'
            ]);
            
            Unidade::create([
                'nome_fantasia' => trim($this->nome_fantasia),
                'razao_social' => trim($this->razao_social),
                'cnpj' => $this->formatCnpj($this->cnpj),
                'bandeira_id' => $this->bandeira_id
            ]);
            $this->reset(['nome_fantasia', 'razao_social', 'cnpj', 'bandeira_id']);
            session()->flash('message', 'Unidade criada com sucesso!');
        }
        
        $this->unidades = Unidade::with('bandeira')->get();
    }

    public function edit($id)
    {
        $unidade = Unidade::find($id);
        if ($unidade) {
            $this->unidadeId = $unidade->id;
            $this->nome_fantasia = $unidade->nome_fantasia;
            $this->razao_social = $unidade->razao_social;
            $this->cnpj = $unidade->cnpj;
            $this->bandeira_id = $unidade->bandeira_id;
        }
    }

    public function update()
    {
        $this->validate([
            'nome_fantasia' => 'required|string|max:255|min:3',
            'razao_social' => 'required|string|max:255|min:3',
            'cnpj' => [
                'required',
                'string',
                'max:18',
                Rule::unique('unidades', 'cnpj')->ignore($this->unidadeId),
                function ($attribute, $value, $fail) {
                    if (!$this->validateCnpj($value)) {
                        $fail('O CNPJ informado é inválido.');
                    }
                }
            ],
            'bandeira_id' => 'required|exists:bandeiras,id'
        ]);
        
        if ($this->unidadeId) {
            $unidade = Unidade::find($this->unidadeId);
            if ($unidade) {
                $unidade->update([
                    'nome_fantasia' => trim($this->nome_fantasia),
                    'razao_social' => trim($this->razao_social),
                    'cnpj' => $this->formatCnpj($this->cnpj),
                    'bandeira_id' => $this->bandeira_id
                ]);
                $this->reset(['nome_fantasia', 'razao_social', 'cnpj', 'bandeira_id', 'unidadeId']);
                session()->flash('message', 'Unidade atualizada com sucesso!');
            }
        }
        
        $this->unidades = Unidade::with('bandeira')->get();
    }

    public function cancel()
    {
        $this->reset(['nome_fantasia', 'razao_social', 'cnpj', 'bandeira_id', 'unidadeId']);
    }

    public function delete($id)
    {
        Unidade::find($id)->delete();
        $this->unidades = Unidade::with('bandeira')->get();
    }

    private function validateCnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        
        if (strlen($cnpj) != 14) {
            return false;
        }
        
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }
        
        $length = 12;
        $numbers = substr($cnpj, 0, $length);
        $digits = substr($cnpj, $length);
        
        // Validação do primeiro dígito verificador
        $sum = 0;
        $pos = 5;
        for ($i = 0; $i < $length; $i++) {
            $sum += $numbers[$i] * $pos;
            $pos = ($pos == 2) ? 9 : $pos - 1;
        }
        $result = $sum % 11;
        $result = ($result < 2) ? 0 : 11 - $result;
        
        if ($result != $digits[0]) {
            return false;
        }
        
        // Validação do segundo dígito verificador
        $length = 13;
        $numbers = substr($cnpj, 0, $length);
        $sum = 0;
        $pos = 6;
        for ($i = 0; $i < $length; $i++) {
            $sum += $numbers[$i] * $pos;
            $pos = ($pos == 2) ? 9 : $pos - 1;
        }
        $result = $sum % 11;
        $result = ($result < 2) ? 0 : 11 - $result;
        
        return $result == $digits[1];
    }

    private function formatCnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
    }

    public function render()
    {
        return view('livewire.unidade-component');
    }
}
