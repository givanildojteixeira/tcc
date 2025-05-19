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
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PropostaController extends Controller
{
    //lista as propostas

    public function index(Request $request)
    {
        $busca = $request->input('busca');
        $status = $request->input('status');
        $usuario = Auth::user();

        $propostas = Proposta::with(['cliente', 'veiculoNovo', 'usuario', 'negociacoes'])
            ->when($usuario->level === 'Vendedor', function ($query) use ($usuario) {
                $query->where('id_usuario', $usuario->id);
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($busca, function ($query, $busca) {
                $query->where(function ($q) use ($busca) {
                    $q->whereHas('cliente', fn($sub) => $sub->where('nome', 'like', "%{$busca}%"))
                        ->orWhereHas('veiculoNovo', fn($sub) => $sub->where('desc_veiculo', 'like', "%{$busca}%"));
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

    //Aqui inicia a view de propostas para aprovação

    //Aqui é feita a inclusao de um veiculo vindo do estoque de novos
    public function iniciar(Request $request)
    {
        // Limpa sessão antiga
        Session::forget('proposta');

        // Pega o dado certo
        $idVeiculoNovo = $request->input('id_veiculoNovo');
        $veiculo = Veiculo::find($idVeiculoNovo);

        //Se não existe
        if (!$veiculo) {
            return response()->json(['success' => false, 'message' => 'Veículo não encontrado'], 404);
        }

        //Cria session com novos dados
        session()->put('proposta.id_veiculoNovo', $veiculo->id);
        session()->put('proposta.valor_veiculoNovo', $veiculo->vlr_tabela);

        //Retorna
        return response()->json(['success' => true]);
    }
    //Cria uma nova com session limpa
    public function limparECreate(Request $request)
    {
        Session::forget('proposta');
        return redirect()->route('propostas.create', ['aba' => $request->input('aba', 'veiculo')]);
    }

    //Monta a session e abre a proposta para edição
    public function carregarParaEditar($id)
    {
        $this->montarSessaoDaProposta($id);

        return redirect()->route('propostas.create', ['aba' => 'resumo']);
    }

    //Monta a session e abre a proposta para Aprovação
    public function carregarParaAprovar($id)
    {
        $this->montarSessaoDaProposta($id);

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


        return view('propostas.aprova', compact(
            'cliente',
            'veiculo',
            'veiculoUsado',
            'proposta',
            'negociacoes'
        ));
    }
    //Busca de aprovadores via api
    public function getAprovadores($id)
    {

        $proposta = Proposta::findOrFail($id);

        return response()->json([
            'gerencial' => optional(User::find($proposta->id_user_aprovacao_gerencial))->name,
            'financeira' => optional(User::find($proposta->id_user_aprovacao_financeira))->name,
            'banco' => optional(User::find($proposta->id_user_aprovacao_banco))->name,
            'diretoria' => optional(User::find($proposta->id_user_aprovacao_diretoria))->name,
        ]);
    }



    //promove alterações na proposta, receendo a id , a chave e o valor da alteração e testando os campos possiveis de alteração
    public function alterarProposta($id, $chave, $valor)
    {
        $proposta = Proposta::findOrFail($id);

        // Verifica se o campo é permitido para alteração
        $camposPermitidos = ['status', 'observacao_nota', 'observacao_interna', 'promocao', 'ativo'];
        if (!in_array($chave, $camposPermitidos)) {
            return response()->json(['success' => false, 'message' => 'Campo não permitido.'], 403);
        }

        $proposta->{$chave} = $valor;
        $proposta->save();

        return response()->json(['success' => true]);
    }
    // Enviar para faturamento
    public function faturar($id)
    {
        $proposta = Proposta::with('veiculoNovo')->findOrFail($id);

        // Atualiza status da proposta
        $proposta->status = 'Faturada';
        $proposta->save();

        // Atualiza status do veículo novo para vendido
        if ($proposta->veiculoNovo) {
            $proposta->veiculoNovo->status = 'vendido';
            $proposta->veiculoNovo->save();
        }
        // Atualiza veiculos usado para disponivel para venda, se existir
        if ($proposta->veiculoUsado1) {
            $proposta->veiculoUsado1->local = 'matriz';
            $proposta->veiculoUsado1->save();
        }

        return response()->json(['success' => true]);
    }

    //Monta a session e abre a proposta para visualização
    public function carregarParaVisualizar($id)
    {
        $this->montarSessaoDaProposta($id);

        return redirect()->route('propostas.relatorioResumo');
    }


    //Monta a session com a id da proposta
    private function montarSessaoDaProposta($id)
    {
        $proposta = Proposta::with(['negociacoes'])->findOrFail($id);

        // Monta a estrutura da sessão
        $sessao = [
            'id' => $proposta->id,
            'id_veiculoNovo' => $proposta->id_veiculoNovo,
            'valor_veiculoNovo' => number_format(optional($proposta->veiculoNovo)->preco ?? 0, 2, '.', ''),
            'id_cliente' => $proposta->id_cliente,
            'id_veiculo_usado' => $proposta->id_veiculoUsado1, // adaptável para outros usados
            'valor_veiculoUsado' => number_format(optional($proposta->veiculoUsado1)->preco ?? 0, 2, '.', ''),
            'observacao_nota' => $proposta->observacao_nota,
            'observacao_interna' => $proposta->observacao_interna,
            'negociacoes' => [],
        ];

        // Preenche as negociações
        foreach ($proposta->negociacoes as $n) {
            $sessao['negociacoes'][] = [
                'condicao' => $n->id_cond_pagamento,
                'condicao_texto' => $n->descricao_pagamento,
                'valor' => floatval($n->valor),
                'vencimento' => $n->data_vencimento,
                // 'fixo' => $n->descricao_pagamento === 'Usado(s)' // regra usada por você
            ];
        }

        // Salva a sessão
        Session::put('proposta', $sessao);
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

            // Captura a mensagem técnica (opcional para log)
            $erroOriginal = $e->getMessage();

            // Gera uma mensagem mais amigável
            $mensagemAmigavel = str_contains($erroOriginal, 'id_cliente')
                ? 'O cliente não foi informado corretamente. Verifique os dados antes de enviar.'
                : 'Ocorreu um erro ao salvar a proposta. Por favor, revise os dados e tente novamente.';

            return back()->with('error', $mensagemAmigavel);
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
