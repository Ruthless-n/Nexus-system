<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function index()
    {
        return response()->json(Unidade::with('bandeira')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:unidades,cnpj',
            'bandeira_id' => 'required|exists:bandeiras,id'
        ]);

        $unidade = Unidade::create($validated);
        return response()->json($unidade, 201);
    }

    public function show($id)
    {
        $unidade = Unidade::with(['bandeira', 'colaboradores'])->findOrFail($id);
        return response()->json($unidade);
    }

    public function update(Request $request, $id)
    {
        $unidade = Unidade::findOrFail($id);
        $unidade->update($request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:unidades,cnpj,' . $id,
            'bandeira_id' => 'required|exists:bandeiras,id'
        ]));

        return response()->json($unidade);
    }

    public function destroy($id)
    {
        Unidade::findOrFail($id)->delete();
        return response()->json(['message' => 'Unidade deletada com sucesso']);
    }
}