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
