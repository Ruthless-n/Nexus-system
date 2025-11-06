<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Validation\Rule;

class ColaboradorComponent extends Component
{
    public $colaboradores, $nome, $email, $cpf, $unidade_id, $colaboradorId;
    public $unidades;

    public function mount()
    {
        $this->colaboradores = Colaborador::with('unidade')->get();
        $this->unidades = Unidade::all();
    }

    public function store()
    {
        if ($this->colaboradorId) {
            $this->validate([
                'nome' => 'required|string|max:255|min:3',
                'email' => 'required|email|unique:colaboradors,email,' . $this->colaboradorId,
                'cpf' => [
                    'required',
                    'string',
                    'max:14',
                    Rule::unique('colaboradors', 'cpf')->ignore($this->colaboradorId),
                    function ($attribute, $value, $fail) {
                        if (!$this->validateCpf($value)) {
                            $fail('O CPF informado é inválido.');
                        }
                    }
                ],
                'unidade_id' => 'required|exists:unidades,id'
            ]);
            
            $colaborador = Colaborador::find($this->colaboradorId);
            if ($colaborador) {
                $colaborador->update([
                    'nome' => trim($this->nome),
                    'email' => trim($this->email),
                    'cpf' => $this->formatCpf($this->cpf),
                    'unidade_id' => $this->unidade_id
                ]);
                $this->reset(['nome', 'email', 'cpf', 'unidade_id', 'colaboradorId']);
            }
        } else {
            // Se não estiver editando, usar validação de criação
            $this->validate([
                'nome' => 'required|string|max:255|min:3',
                'email' => 'required|email|unique:colaboradors,email',
                'cpf' => [
                    'required',
                    'string',
                    'max:14',
                    'unique:colaboradors,cpf',
                    function ($attribute, $value, $fail) {
                        if (!$this->validateCpf($value)) {
                            $fail('O CPF informado é inválido.');
                        }
                    }
                ],
                'unidade_id' => 'required|exists:unidades,id'
            ]);
            
            Colaborador::create([
                'nome' => trim($this->nome),
                'email' => trim($this->email),
                'cpf' => $this->formatCpf($this->cpf),
                'unidade_id' => $this->unidade_id
            ]);
            $this->reset(['nome', 'email', 'cpf', 'unidade_id']);
        }
        
        $this->colaboradores = Colaborador::with('unidade')->get();
    }

    public function edit($id)
    {
        $colaborador = Colaborador::find($id);
        if ($colaborador) {
            $this->colaboradorId = $colaborador->id;
            $this->nome = $colaborador->nome;
            $this->email = $colaborador->email;
            $this->cpf = $colaborador->cpf;
            $this->unidade_id = $colaborador->unidade_id;
        }
    }

    public function update()
    {
        $this->validate([
            'nome' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:colaboradors,email,' . $this->colaboradorId,
            'cpf' => [
                'required',
                'string',
                'max:14',
                Rule::unique('colaboradors', 'cpf')->ignore($this->colaboradorId),
                function ($attribute, $value, $fail) {
                    if (!$this->validateCpf($value)) {
                        $fail('O CPF informado é inválido.');
                    }
                }
            ],
            'unidade_id' => 'required|exists:unidades,id'
        ]);
        
        if ($this->colaboradorId) {
            $colaborador = Colaborador::find($this->colaboradorId);
            if ($colaborador) {
                $colaborador->update([
                    'nome' => trim($this->nome),
                    'email' => trim($this->email),
                    'cpf' => $this->formatCpf($this->cpf),
                    'unidade_id' => $this->unidade_id
                ]);
                $this->reset(['nome', 'email', 'cpf', 'unidade_id', 'colaboradorId']);
            }
        }
        
        $this->colaboradores = Colaborador::with('unidade')->get();
    }

    public function cancel()
    {
        $this->reset(['nome', 'email', 'cpf', 'unidade_id', 'colaboradorId']);
    }

    public function delete($id)
    {
        Colaborador::find($id)->delete();
        $this->colaboradores = Colaborador::with('unidade')->get();
    }

    private function validateCpf($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        if (strlen($cpf) != 11) {
            return false;
        }
        
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        
        return true;
    }

    private function formatCpf($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }

    public function render()
    {
        return view('livewire.colaborador-component');
    }
}
