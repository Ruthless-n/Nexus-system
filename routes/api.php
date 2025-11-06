<?php
use App\Http\Controllers\RelatorioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('grupos', GrupoEconomicoController::class);
    });

    Route::middleware('permission:gerenciar unidades')->group(function () {
        Route::apiResource('unidades', UnidadeController::class);
    });

    Route::middleware('permission:gerenciar colaboradores')->group(function () {
        Route::apiResource('colaboradores', ColaboradorController::class);
    });

    Route::apiResource('bandeiras', BandeiraController::class);
    Route::middleware('role:admin')->get('/relatorios', [RelatorioController::class, 'index']);

    Route::get('/export/colaboradores', [ExportController::class, 'exportColaboradores']);
    Route::get('/export/grupos', [ExportController::class, 'exportGrupos']);
    Route::get('/export/bandeiras', [ExportController::class, 'exportBandeiras']);
    Route::get('/export/unidades', [ExportController::class, 'exportUnidades']);
    
    Route::get('/export/colaboradores-async', [ExportController::class, 'exportColaboradoresAsync']);
    Route::get('/export/grupos-async', [ExportController::class, 'exportGruposAsync']);
    Route::get('/export/bandeiras-async', [ExportController::class, 'exportBandeirasAsync']);
    Route::get('/export/unidades-async', [ExportController::class, 'exportUnidadesAsync']);
});