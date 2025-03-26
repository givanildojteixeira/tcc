<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NovosController;
use App\Http\Controllers\PropostasController;
use App\Http\Controllers\RelatoriosController;
use App\Http\Controllers\UsadosController;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Veiculo;
use Illuminate\Support\Facades\Route;


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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard',[
        'clientes' => Cliente::all(),
        'users' => User::all(),
        'veiculos' => Veiculo::all(),
        'veiculosnovos' => Veiculo::where('novo_usado', 'Novo')->count(),
        'veiculosusados' => Veiculo::where('novo_usado', 'Usado')->count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users
    Route::get('/users-index',[UserController::class,'index'])->name('user.index');
    Route::get('/user-edit/{id}',[UserController::class,'edit'])->name('user.edit');
    Route::put('/user-edit/{id}',[UserController::class,'update'])->name('user.update');

    //Clientes
    Route::resources([
        'cliente'=>ClienteController::class
    ]);
    Route::get('/meus-clientes/{id}', [ClienteController::class, 'clientes_to_user'])->name('meus-clientes');
    route::get('/confirma-delete/{id}',[ClienteController::class, 'confirma_delete'])->name('confirma_delete');

    //Veiculos novos
    Route::get('/novos',[NovosController::class,'index'])->name('veiculos.novos.index');
    Route::get('/novos/chassi/{chassi}', [NovosController::class, 'filtrarPorChassi'])->name('veiculos.novos.filtroC');
    Route::get('/novos/familia/{familia}', [NovosController::class, 'filtrarPorFamilia'])->name('veiculos.novos.filtroF');
    Route::get('/novos/modelo/{veiculo}', [NovosController::class, 'filtrarPorVeiculo'])->name('veiculos.novos.filtroV');
    Route::get('/novos/combustivel/{combustivel}', [NovosController::class, 'filtrarPorCombustivel'])->name('veiculos.novos.filtroCombustivel');
    Route::get('/novos/ano-modelo/{ano_modelo}', [NovosController::class, 'filtrarPorAnoModelo'])
    ->where('ano_modelo', '.*') // Permite qualquer caractere, incluindo "/"
    ->name('veiculos.novos.filtroAnoModelo');



    //Veiculos usados
    Route::get('/usados.index',[UsadosController::class,'index'])->name('veiculos.usados.index');

    //Propostas
    Route::get('/propostas.index',[PropostasController::class,'index'])->name('propostas.index');

    //Financeiro
    Route::get('/financeiro.index',[FinanceiroController::class,'index'])->name('financeiro.index');

    //Financeiro
    Route::get('/relatorios.index',[RelatoriosController::class,'index'])->name('relatorios.index');

});

require __DIR__.'/auth.php';
