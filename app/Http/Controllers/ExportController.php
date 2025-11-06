<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\{ColaboradoresExport, GruposExport, BandeirasExport, UnidadesExport};
use App\Jobs\{ExportColaboradoresJob, ExportGruposJob, ExportBandeirasJob, ExportUnidadesJob};
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    // Exportação síncrona
    public function exportColaboradores(Request $request)
    {
        $filters = $request->only(['nome', 'unidade_id']);
        return Excel::download(new ColaboradoresExport($filters), 'colaboradores.xlsx');
    }

    public function exportGrupos(Request $request)
    {
        return Excel::download(new GruposExport(), 'grupos.xlsx');
    }

    public function exportBandeiras(Request $request)
    {
        return Excel::download(new BandeirasExport(), 'bandeiras.xlsx');
    }

    public function exportUnidades(Request $request)
    {
        return Excel::download(new UnidadesExport(), 'unidades.xlsx');
    }

    // Exportação assíncrona (fila)
    public function exportColaboradoresAsync(Request $request)
    {
        $filters = $request->only(['nome', 'unidade_id']);
        $filename = 'colaboradores_' . now()->format('Y_m_d_H_i_s') . '.xlsx';
        ExportColaboradoresJob::dispatch($filters, $filename);

        return response()->json([
            'message' => 'Exportação iniciada. O arquivo será gerado em background.',
            'filename' => $filename
        ]);
    }

    public function exportGruposAsync()
    {
        $filename = 'grupos_' . now()->format('Y_m_d_H_i_s') . '.xlsx';
        ExportGruposJob::dispatch([], $filename);

        return response()->json([
            'message' => 'Exportação de grupos iniciada.',
            'filename' => $filename
        ]);
    }

    public function exportBandeirasAsync()
    {
        $filename = 'bandeiras_' . now()->format('Y_m_d_H_i_s') . '.xlsx';
        ExportBandeirasJob::dispatch([], $filename);

        return response()->json([
            'message' => 'Exportação de bandeiras iniciada.',
            'filename' => $filename
        ]);
    }

    public function exportUnidadesAsync()
    {
        $filename = 'unidades_' . now()->format('Y_m_d_H_i_s') . '.xlsx';
        ExportUnidadesJob::dispatch([], $filename);

        return response()->json([
            'message' => 'Exportação de unidades iniciada.',
            'filename' => $filename
        ]);
    }
}
