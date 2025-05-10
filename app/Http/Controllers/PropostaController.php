<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Proposta;
use Illuminate\Http\Request;
use App\Models\CondicaoPagamento;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PropostaController extends Controller
{


    //Aqui inicia a view de propostas
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
    
        $proposta = Proposta::create([
            'id_cliente' => $sessao['id_cliente'] ?? null,
            'id_veiculoNovo' => $sessao['id_veiculoNovo'] ?? null,
            'id_veiculoUsado1' => $sessao['id_veiculo_usado'] ?? null,
            'id_usuario' => auth()->id(),
            'data_proposta' => now(),
            'status' => 'Pendente',
            'observacao_nota' => $sessao['observacao_nota'] ?? null,
            'observacao_interna' => $sessao['observacao_interna'] ?? null,
        ]);
    
        // salvar as negociações separadamente se desejar
        $negociacoes = $sessao['negociacoes'] ?? [];
        foreach ($negociacoes as $n) {
            $proposta->negociacoes()->create([
                'id_cond_pagamento' => $n['condicao'],
                'valor' => $n['valor'],
                'data_vencimento' => $n['vencimento']
            ]);
        }
    
        // limpar sessão se desejar
        session()->forget('proposta');
    
        return redirect()->route('propostas.create')->with('success', '✅ Proposta salva com sucesso!');
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
