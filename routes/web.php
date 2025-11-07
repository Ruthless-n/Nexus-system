<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Exports\ColaboradoresExport;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/homepage', function () {
    return view('homepage');
})->middleware(['auth', 'verified'])->name('homepage');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/grupos-economicos', function () {
        return view('grupos-economicos');
    })->name('grupos-economicos');

    Route::get('/bandeiras', function () {
        return view('bandeiras');
    })->name('bandeiras');

    Route::get('/unidades', function () {
        return view('unidades');
    })->name('unidades');

    Route::get('/colaboradores', function () {
        return view('colaboradores');
    })->name('colaboradores');

    Route::get('/relatorios/colaboradores', function () {
        return view('reports.colaboradores');
    })->name('reports.colaboradores');

    Route::get('/auditoria', function () {
        return view('audits.index');
    })->name('audits.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// export route (auth protected)
Route::get('/export/colaboradores', function (Request $request) {
    $filters = $request->only(['unidade_id','nome']);
    return Excel::download(new ColaboradoresExport($filters), 'colaboradores.xlsx');
})->middleware(['auth','verified'])->name('export.colaboradores');
