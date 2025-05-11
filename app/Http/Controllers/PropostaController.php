<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Proposta;
use App\Models\Negociacao;
use Illuminate\Http\Request;
use App\Models\CondicaoPagamento;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PropostaController extends Controller
{
    //lista as propostas
    public function index(Request $request)
    {
        $busca = $request->input('busca');
    
        $propostas = Proposta::with(['cliente', 'veiculoNovo', 'usuario', 'negociacoes'])
            ->when($busca, function ($query, $busca) {
                $query->whereHas('cliente', function ($q) use ($busca) {
                    $q->where('nome', 'like', "%{$busca}%");
                })
                ->orWhere('status', 'like', "%{$busca}%")
                ->orWhereHas('veiculoNovo', function ($q) use ($busca) {
                    $q->where('modelo', 'like', "%{$busca}%");
                });
            })
            ->orderByDesc('data_proposta')
            ->paginate(10);
    
        return view('propostas.index', compact('propostas'));
    }



    //Aqui inicia a view de propostas para criação de uma nova
    public function create()
    {
        $proposta = session('proposta', []);
        $condicoes = CondicaoPagamento::orderBy('descricao')->get();

        return view('propostas.create', compact('proposta', 'condicoes'));
    }

    //Aqui é feita a inclusao de um veiculo vindo do estoque de novos
    public function iniciar(Request $request)
    {
        $idVeiculoNovo = $request->input('id_veiculoNovo'); // Pega o dado certo
        $veiculo = Veiculo::find($idVeiculoNovo);

        if (!$veiculo) {
            return response()->json(['success' => false, 'message' => 'Veículo não encontrado'], 404);
        }

        session()->put('proposta.id_veiculoNovo', $veiculo->id);
        session()->put('proposta.valor_veiculoNovo', $veiculo->vlr_tabela);
        return response()->json(['success' => true]);
    }

    //Remove o veiculo novo na Session
    public function removerVeiculoNovo(Request $request)
    {
        $proposta = session('proposta', []);
        $proposta['id_veiculoNovo'] = null;
        $proposta['valor_veiculoNovo'] = 0;
        session(['proposta' => $proposta]);
        return response()->json(['success' => true]);
    }


    public function inserirVeiculoNovo()
    {
        $id = session('proposta.id_veiculoNovo');

        if (!$id) {
            return response()->json(null);
        }

        return Veiculo::find($id);
    }

    //Salva o Veiculo novo na Session
    public function salvarVeiculoSession(Request $request)
    {
        $veiculo = Veiculo::find($request->id_veiculoNovo);

        if (!$veiculo) {
            return response()->json(['success' => false, 'message' => 'Veículo não encontrado'], 404);
        }

        session()->put('proposta.id_veiculoNovo', $veiculo->id);
        session()->put('proposta.valor_veiculoNovo', $veiculo->vlr_tabela);

        return response()->json(['success' => true]);
    }

    // 3. Salvar cliente selecionado
    public function selecionarCliente(Request $request)
    {
        session(['proposta.cliente' => $request->cliente_id]);

        return redirect()->back();
    }
    public function adicionarCliente(Request $request)
    {
        $clienteId = $request->input('id_cliente');
        $proposta = session('proposta', []);
        $proposta['id_cliente'] = $clienteId;
        session(['proposta' => $proposta]);
        return response()->json(['success' => true]);
    }

    public function removerCliente(Request $request)
    {
        $proposta = session('proposta', []);
        $proposta['id_cliente'] = null;
        session(['proposta' => $proposta]);
        return response()->json(['success' => true]);
    }

    // Aqui carrega veiculos usados pela session
    public function carregarVeiculoUsado(Request $request)
    {
        $id = session('proposta.id_veiculo_usado');

        if (!$id) {
            return response()->json(null);
        }

        return Veiculo::find($id);
    }

    //Aqui Insere uma session com a Id do veiculo usado
    public function inserirVeiculoUsado(Request $request)
    {
        $id_vusado = $request->input('id_veiculo_usado');

        $veiculo = Veiculo::find($id_vusado);

        if (!$veiculo) {
            return response()->json(['success' => false, 'message' => 'Veículo não encontrado'], 404);
        }

        session()->put('proposta.id_veiculo_usado', $veiculo->id);
        session()->put('proposta.valor_veiculoUsado', $veiculo->vlr_tabela);


        return response()->json(['success' => true]);
    }
    //Aqui remove o veiculo usado da session
    public function removerVeiculoUsado(Request $request)
    {
        $proposta = session('proposta', []);

        $proposta['id_veiculo_usado'] = null;
        $proposta['valor_veiculoUsado'] = 0;

        session(['proposta' => $proposta]);
        return response()->json(['success' => true]);
    }


    public function salvarNegociacoesSession(Request $request)
    {
        session()->put('proposta.negociacoes', $request->negociacoes);
        return response()->json(['success' => true]);
    }
    public function salvarObservacoesSession(Request $request)
    {
        session()->put('proposta.observacao_nota', $request->observacao_nota);
        session()->put('proposta.observacao_interna', $request->observacao_interna);

        return response()->json(['success' => true]);
    }



    // 6. Finalizar proposta (Salvar no Banco)
    public function store(Request $request)
    {
        $sessao = session('proposta');

        if (!$sessao) {
            return back()->withErrors('Sessão de proposta não encontrada.');
        }

        DB::beginTransaction();

        try {
            // 1. Cria a proposta
            $proposta = Proposta::create([
                'id_cliente' => $sessao['id_cliente'],
                'id_veiculoNovo' => $sessao['id_veiculoNovo'] ?? null,
                'id_veiculoUsado1' => $sessao['id_veiculo_usado'] ?? null,
                'id_usuario' => auth()->id(),
                'data_proposta' => now(),
                'status' => 'pendente',
                'observacao_nota' => $sessao['observacao_nota'] ?? null,
                'observacao_interna' => $sessao['observacao_interna'] ?? null,
            ]);
    
            // 2. Cria as negociações (se houver)
            foreach ($sessao['negociacoes'] ?? [] as $negociacao) {
                Negociacao::create([
                    'id_proposta' => $proposta->id,
                    'id_cond_pagamento' => $negociacao['condicao'],
                    'descricao_pagamento' => $negociacao['condicao_texto'],
                    'valor' => $negociacao['valor'],
                    'data_vencimento' => $negociacao['vencimento'],
                ]);
            }
    
            DB::commit();
    
            // Limpar a sessão depois de gravar
            Session::forget('proposta');
    
            return redirect()->route('propostas.index')->with('success', '✅ Proposta salva com sucesso!');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Erro ao salvar proposta: ' . $e->getMessage());
        }
    }

    

    //Cancelar a Proposta
    public function cancelar()
    {
        session()->forget('proposta');

        return redirect()->route('veiculos.novos.index')->with('info', 'Proposta cancelada com sucesso!');
    }

    public function relatorioResumo()
    {
        // Recupera dados da sessão da proposta
        $proposta = session('proposta', []);

        // Cliente
        $cliente = null;
        if (!empty($proposta['id_cliente'])) {
            $cliente = Cliente::find($proposta['id_cliente']);
        }

        // Veículo novo
        $veiculo = null;
        if (!empty($proposta['id_veiculoNovo'])) {
            $veiculo = Veiculo::find($proposta['id_veiculoNovo']);
        }

        // Veículo usado (exemplo com 1, mas pode adaptar para mais)
        $veiculoUsado = null;
        if (!empty($proposta['id_veiculo_usado'])) {
            $veiculoUsado = Veiculo::find($proposta['id_veiculo_usado']);
        }

        // Negociações
        $proposta = session('proposta', []);
        $negociacoes = $proposta['negociacoes'] ?? [];


        return view('propostas.relatorio', compact(
            'cliente',
            'veiculo',
            'veiculoUsado',
            'proposta',
            'negociacoes'
        ));
    }


}
