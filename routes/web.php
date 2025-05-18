<?php

use App\Models\Cor;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Familia;
use App\Models\Veiculo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NovosController;
use App\Http\Controllers\UsadosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\PropostaController;
use App\Http\Controllers\OpcionaisController;
use App\Http\Controllers\CorFamiliaController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\RelatoriosController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\CondicaoPagamentoController;


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
    Route::view('/aguarde-validacao', 'auth.aguarde-validacao')->name('aguarde.validacao');

    // Users =>somente para o admin
    Route::middleware(['auth', 'check.level:admin'])->group(function () {
        Route::get('/users-index', [UserController::class, 'index'])->name('user.index');
        Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user-edit/{id}', [UserController::class, 'update'])->name('user.update');
        Route::patch('/user-ativo/{id}/{ativo}', [UserController::class, 'ativo'])->name('user.ativo');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });


    //Clientes
    // Route::resources(['cliente' => ClienteController::class ]);
    Route::resource('clientes', ClienteController::class)->except(['create', 'edit', 'show']);

    Route::get('/meus-clientes/{id}', [ClienteController::class, 'clientes_to_user'])->name('meus-clientes');
    route::get('/confirma-delete/{id}', [ClienteController::class, 'confirma_delete'])->name('confirma_delete');

    // //Veiculos Geral
    Route::patch('/veiculos/status/{id}', [VeiculoController::class, 'alterarStatus'])->name('veiculos.status');
    Route::get('/veiculos/{id}/edit', [VeiculoController::class, 'edit'])->name('veiculos.edit');
    Route::put('/veiculos/{id}', [VeiculoController::class, 'update'])->name('veiculos.update');
    Route::delete('/veiculos/imagem/excluir', [VeiculoController::class, 'excluirImagem'])->name('veiculos.imagem.excluir');
    Route::get('/veiculos/create', [VeiculoController::class, 'create'])->name('veiculos.create');
    Route::post('/veiculos', [VeiculoController::class, 'store'])->name('veiculos.store');
    Route::delete('/veiculos/{veiculo}', [VeiculoController::class, 'destroy'])->name('veiculos.destroy');

    //Veiculos novos
    Route::get('/novos', [NovosController::class, 'index'])->name('veiculos.novos.index');
    Route::get('/veiculos/novos/limpar-filtros', [NovosController::class, 'limparFiltros'])->name('veiculos.novos.limparFiltros');

    //Veiculos usados
    Route::get('/usados', [UsadosController::class, 'index'])->name('veiculos.usados.index');
    Route::get('/veiculos/usados/limpar-filtros', [UsadosController::class, 'limparFiltros'])->name('veiculos.usados.limparFiltros');

    //Familias
    Route::resource('/veiculos/familia', FamiliaController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::post('/familia/upload/{tipo}', [FamiliaController::class, 'upload'])->name('familia.upload');
    Route::post('/familia/excluir-arquivo', [FamiliaController::class, 'excluirArquivoSimples'])->name('familia.excluirArquivoSimples');
    Route::post('/familia/relacionar-cores', [CorFamiliaController::class, 'relacionar'])->name('cor_familia.relacionar');
    Route::get('/familia/{id}/cores', function ($id) {
        return DB::table('cor_familia')->where('familia_id', $id)->pluck('cor_id');
    });
    Route::get('/familia/{id}/arquivos', function ($id) {
        $familia = Familia::find($id);
        if (!$familia)
            return response()->json([]);

        $nomeSlug = Str::slug($familia->descricao, '-');
        $caminho = public_path("upload/familia");

        $arquivos = collect(File::files($caminho))->filter(function ($file) use ($nomeSlug) {
            return str_starts_with($file->getFilename(), $nomeSlug . '-');
        })->map(function ($file) use ($nomeSlug) {
            $nomeCompleto = $file->getFilename();
            return [
                'nome' => Str::after($nomeCompleto, $nomeSlug . '-'),
                'link' => asset("upload/familia/{$nomeCompleto}"),
                'arquivo' => $nomeCompleto
            ];
        });

        return response()->json($arquivos->values());
    });




    // cores
    Route::resource('cores', CorController::class);


    //Configurações
    Route::post('/configuracoes/salvar', [ConfiguracaoController::class, 'salvar'])->name('configuracoes.salvar');

    //Condições de Pagamento
    Route::prefix('condicoes-pagamento')->name('condicao_pagamento.')->group(function () {
        Route::get('/', [CondicaoPagamentoController::class, 'index'])->name('index');
        Route::post('/', [CondicaoPagamentoController::class, 'store'])->name('store');
        Route::put('/{condicao_pagamento}', [CondicaoPagamentoController::class, 'update'])->name('update');
        Route::delete('/{condicao_pagamento}', [CondicaoPagamentoController::class, 'destroy'])->name('destroy');
    });

    //Opcionais
    Route::resource('opcionais', OpcionaisController::class);

    //Propostas
    Route::get('/propostas/testar-session', function () {   return session('proposta');});
    
    Route::get('/propostas', [PropostaController::class, 'index'])->name('propostas.index');
    Route::get('/propostas/create', [PropostaController::class, 'create'])->name('propostas.create');
    Route::get('/propostas/nova', [PropostaController::class, 'limparECreate'])->name('propostas.limparECreate');
    Route::get('/propostas/editar/{id}', [PropostaController::class, 'carregarParaEditar'])->name('propostas.editar');
    Route::get('/propostas/aprovar/{id}', [PropostaController::class, 'carregarParaAprovar'])->name('propostas.aprovar');
    Route::get('/propostas/visualizar/{id}', [PropostaController::class, 'carregarParaVisualizar'])->name('propostas.visualizar');
    Route::post('/propostas/alterar/{id}/{chave}/{valor}', [PropostaController::class, 'alterarProposta'])->name('propostas.alterar');
    Route::post('/propostas/faturar/{id}', [PropostaController::class, 'faturar'])->name('propostas.faturar');

    Route::post('/propostas/salvar', [PropostaController::class, 'store'])->name('propostas.store');
    Route::post('/propostas/cancelar', [PropostaController::class, 'cancelar'])->name('proposta.cancelar');
    //Veiculos Novos
    Route::post('/propostas/iniciar', [PropostaController::class, 'iniciar'])->name('proposta.iniciar');   //Inicia quando vem de Estoque de Novos
    Route::get('/propostas/inserir-veiculo-novo', [PropostaController::class, 'inserirVeiculoNovo']);
    Route::post('/propostas/veiculo-session', [PropostaController::class, 'salvarVeiculoSession']);
    Route::post('/propostas/remover-veiculo-novo', [PropostaController::class, 'removerVeiculoNovo']);
    //cliente
    Route::post('/propostas/remover-veiculo-usado', [PropostaController::class, 'removerVeiculoUsado']);
    Route::post('/propostas/remover-cliente', [PropostaController::class, 'removerCliente']);
    Route::post('/propostas/adicionar-cliente', [PropostaController::class, 'adicionarCliente']);
    //Veículos Usados
    Route::post('/propostas/inserir-veiculo-usado', [PropostaController::class, 'inserirVeiculoUsado']);   //insere sesion com id de VU
    Route::get('/propostas/veiculos-usados-session', [PropostaController::class, 'carregarVeiculoUsado']); //busca veiculo usado na session
    Route::get('/propostas/veiculos-usados-session-remova', [PropostaController::class, 'removerVeiculoUsado']);   //Remove veiculo usado na session
    //Negociações
    Route::post('/propostas/negociacoes-session', [PropostaController::class, 'salvarNegociacoesSession']);
    //Observações
    Route::post('/propostas/observacoes-session', [PropostaController::class, 'salvarObservacoesSession']);
    //Resumo
    Route::get('/propostas/relatorio-resumo', [PropostaController::class, 'relatorioResumo'])->name('propostas.relatorioResumo');





    ///  http://200.195.138.74:911/propostas/create?id_veic_usado=624







    //Financeiro
    Route::get('/financeiro.index', [FinanceiroController::class, 'index'])->name('financeiro.index');

    //Financeiro
    Route::get('/relatorios.index', [RelatoriosController::class, 'index'])->name('relatorios.index');

    //Atividades
    Route::get('/atividades', function () {
        return view('atividades');
    })->name('atividades.index');

});

require __DIR__ . '/auth.php';
