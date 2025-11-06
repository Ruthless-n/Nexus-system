<?php

namespace App\Http\Controllers;

use App\Models\GrupoEconomico;
use Illuminate\Http\Request;

class GrupoEconomicoController extends Controller
{
    public function index()
    {
        return response()->json(GrupoEconomico::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $grupo = GrupoEconomico::create($validated);
        return response()->json($grupo, 201);
    }

    public function show($id)
    {
        $grupo = GrupoEconomico::with('bandeiras')->findOrFail($id);
        return response()->json($grupo);
    }

    public function update(Request $request, $id)
    {
        $grupo = GrupoEconomico::findOrFail($id);
        $grupo->update($request->validate(['nome' => 'required|string|max:255']));
        return response()->json($grupo);
    }

    public function destroy($id)
    {
        GrupoEconomico::findOrFail($id)->delete();
        return response()->json(['message' => 'Grupo Econômico deletado com sucesso']);
    }
}
