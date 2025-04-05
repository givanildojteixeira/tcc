<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NovosController;
use App\Http\Controllers\PropostasController;
use App\Http\Controllers\RelatoriosController;
use App\Http\Controllers\UsadosController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\OpcionaisController;
use App\Http\Controllers\ConfiguracaoController;
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
    return view('dashboard', [
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
    Route::get('/users-index', [UserController::class, 'index'])->name('user.index');
    Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user-edit/{id}', [UserController::class, 'update'])->name('user.update');

    //Clientes
    Route::resources([
        'cliente' => ClienteController::class
    ]);
    Route::get('/meus-clientes/{id}', [ClienteController::class, 'clientes_to_user'])->name('meus-clientes');
    route::get('/confirma-delete/{id}', [ClienteController::class, 'confirma_delete'])->name('confirma_delete');

    // //Veiculos Geral
    Route::get('/veiculos/{id}/edit', [VeiculoController::class, 'edit'])->name('veiculos.edit');
    Route::put('/veiculos/{id}', [VeiculoController::class, 'update'])->name('veiculos.update');
    Route::delete('/veiculos/imagem/excluir', [VeiculoController::class, 'excluirImagem'])->name('veiculos.imagem.excluir');


    //Veiculos novos
    Route::get('/novos', [NovosController::class, 'index'])->name('veiculos.novos.index');
    Route::get('/veiculos/novos/limpar-filtros', [NovosController::class, 'limparFiltros'])->name('veiculos.novos.limparFiltros');

    //Veiculos usados
    Route::get('/usados', [UsadosController::class, 'index'])->name('veiculos.usados.index');
    Route::get('/veiculos/usados/limpar-filtros', [UsadosController::class, 'limparFiltros'])->name('veiculos.usados.limparFiltros');

    //Familias
    Route::resource('/veiculos/familia', FamiliaController::class)->only(['index', 'store', 'update', 'destroy']);

    //Configurações
    Route::post('/configuracoes/salvar', [ConfiguracaoController::class, 'salvar'])->name('configuracoes.salvar');



    //Opcionais
    Route::resource('opcionais', OpcionaisController::class);

    //Propostas
    Route::get('/propostas.index', [PropostasController::class, 'index'])->name('propostas.index');

    //Financeiro
    Route::get('/financeiro.index', [FinanceiroController::class, 'index'])->name('financeiro.index');

    //Financeiro
    Route::get('/relatorios.index', [RelatoriosController::class, 'index'])->name('relatorios.index');
});

require __DIR__ . '/auth.php';
