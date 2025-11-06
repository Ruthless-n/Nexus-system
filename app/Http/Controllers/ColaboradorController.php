<?php

namespace App\Http\Controllers;
use App\Models\Colaborador;

use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    public function index()
    {
        return response()->json(Colaborador::with('unidade')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:colaboradors,email',
            'cpf' => 'required|string|max:14|unique:colaboradors,cpf',
            'unidade_id' => 'required|exists:unidades,id'
        ]);

        $colaborador = Colaborador::create($validated);
        return response()->json($colaborador, 201);
    }

    public function show($id)
    {
        $colaborador = Colaborador::with('unidade')->findOrFail($id);
        return response()->json($colaborador);
    }

    public function update(Request $request, $id)
    {
        $colaborador = Colaborador::findOrFail($id);
        $colaborador->update($request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:colaboradors,email,' . $id,
            'cpf' => 'required|string|max:14|unique:colaboradors,cpf,' . $id,
            'unidade_id' => 'required|exists:unidades,id'
        ]));

        return response()->json($colaborador);
    }

    public function destroy($id)
    {
        Colaborador::findOrFail($id)->delete();
        return response()->json(['message' => 'Colaborador deletado com sucesso']);
    }
}