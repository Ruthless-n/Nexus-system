<?php

namespace App\Http\Controllers;

use App\Models\Bandeira;
use Illuminate\Http\Request;

class BandeiraController extends Controller
{
    public function index()
    {
        return response()->json(Bandeira::with('grupoEconomico')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'grupo_economico_id' => 'required|exists:grupo_economicos,id'
        ]);

        $bandeira = Bandeira::create($validated);
        return response()->json($bandeira, 201);
    }

    public function show($id)
    {
        $bandeira = Bandeira::with(['grupoEconomico', 'unidades'])->findOrFail($id);
        return response()->json($bandeira);
    }

    public function update(Request $request, $id)
    {
        $bandeira = Bandeira::findOrFail($id);
        $bandeira->update($request->validate([
            'nome' => 'required|string|max:255',
            'grupo_economico_id' => 'required|exists:grupo_economicos,id'
        ]));

        return response()->json($bandeira);
    }

    public function destroy($id)
    {
        Bandeira::findOrFail($id)->delete();
        return response()->json(['message' => 'Bandeira deletada com sucesso']);
    }
}