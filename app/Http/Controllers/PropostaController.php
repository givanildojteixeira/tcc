<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Proposta;
use Illuminate\Http\Request;
use App\Models\CondicaoPagamento;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PropostaController extends Controller
{
    // 1. Iniciar proposta
    public function iniciar(Request $request)
    {
        $idVeiculoNovo = $request->input('id_veiculoNovo'); // Pega o dado certo

        session([
            'proposta' => [
                'id_veiculoNovo' => $idVeiculoNovo,
                // 'cliente' => null,
                // 'veiculos_usados' => [],
                // 'negociacoes' => [],
                // 'observacao_nota' => '',
                // 'observacao_interna' => '',
            ]
        ]);

        return response()->json(['success' => true]);
    }


    public function removerVeiculoNovo(Request $request)
    {
        $proposta = session('proposta', []);
        $proposta['id_veiculoNovo'] = null;
        session(['proposta' => $proposta]);
        return response()->json(['success' => true]);
    }



    // 2. Mostrar tela de criação
    public function create()
    {
        $proposta = session('proposta', []);

        return view('propostas.create', compact('proposta'));
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

    // 4. Adicionar veículo usado
    public function carregarVeiculoUsado(Request $request)
    {
        return response()->json(session('veiculos_usados', []));
    }
    
    public function inserirVeiculoUsado(Request $request)
    {
        $id_vusado = $request->input('id_veiculo_usado');

        $proposta = session('proposta', []);

        $proposta['id_veiculo_usado'] = $id_vusado;

        session(['proposta' => $proposta]);
        return response()->json(['success' => true]);
    }

    public function removerVeiculoUsado(Request $request)
    {
       //TODO: resolver totalemnte
        $id = $request->input('id');
        $veiculos = session('veiculos_usados', []);

        // Remove o veículo da sessão
        $veiculos = array_filter($veiculos, fn($vid) => $vid != $id);
        session(['veiculos_usados' => array_values($veiculos)]);

        return response()->json(['success' => true]);
    }


    // 5. Adicionar negociação
    public function adicionarNegociacao(Request $request)
    {
        session()->push('proposta.negociacoes', [
            'condicao' => $request->condicao,
            'valor' => $request->valor,
            'vencimento' => $request->vencimento,
        ]);

        return redirect()->back();
    }

    // 6. Finalizar proposta (Salvar no Banco)
    public function store(Request $request)
    {
        $propostaSession = session('proposta');

        $proposta = Proposta::create([
            'id_cliente' => $propostaSession['cliente'],
            'id_veiculoNovo' => $propostaSession['veiculo_novo'],
            'observacao_nota' => $propostaSession['observacao_nota'] ?? '',
            'observacao_interna' => $propostaSession['observacao_interna'] ?? '',
            'data_proposta' => now(),
            'status' => 'Aberta',
            'id_usuario' => auth()->id(),
        ]);

        // Relacionar veículos usados
        foreach ($propostaSession['veiculos_usados'] ?? [] as $veiculoUsadoId) {
            $proposta->veiculosUsados()->attach($veiculoUsadoId);
        }

        // Relacionar negociações
        foreach ($propostaSession['negociacoes'] ?? [] as $negociacao) {
            $proposta->negociacoes()->create($negociacao);
        }

        session()->forget('proposta'); // Limpa a sessão

        return redirect()->route('propostas.index')->with('success', 'Proposta criada com sucesso!');
    }

    //Cancelar a Proposta
    public function cancelar()
    {
        session()->forget('proposta');

        return redirect()->route('veiculos.novos.index')->with('info', 'Proposta cancelada com sucesso!');
    }

}
