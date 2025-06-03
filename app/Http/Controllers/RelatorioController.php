<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }
    public function estoqueNovos()
    {
        $veiculos = Veiculo::where('novo_usado', 'Novo')->get();

        return view('relatorios.base.estoque', compact('veiculos'));
    }


    public function vendasNovos()
    {
        $veiculos = Veiculo::with(['proposta.vendedor'])
            ->where('novo_usado', 'Novo')
            ->where('status', 'vendido')
            ->orderBy('desc_veiculo')
            ->get();

        return view('relatorios.base.vendas', compact('veiculos'));
    }

    public function estoqueUsados()
    {
        $veiculos = Veiculo::where('novo_usado', 'usado')->get();
        return view('relatorios.base.estoqueusados', compact('veiculos'));
    }

    public function lucroUsados()
    {
        return view('relatorios.usados.lucro');
    }

    public function propostasAprovadas()
    {
        $propostas = Proposta::with(['vendedor', 'veiculo', 'negociacoes'])
            ->where('status', 'aprovada')
            ->orderByDesc('id')
            ->get();

        return view('relatorios.base.aprovadas', compact('propostas'));
    }

    public function propostasRejeitadas()
    {
        $propostas = Proposta::with(['vendedor', 'veiculo', 'negociacoes'])
            ->where('status', 'rejeitada')
            ->orderByDesc('id')
            ->get();

        return view('relatorios.base.rejeitadas', compact('propostas'));
    }

    public function propostasFaturadas()
    {
        $propostas = Proposta::with(['vendedor', 'veiculo', 'negociacoes'])
            ->where('status', 'faturada')
            ->orderByDesc('id')
            ->get();

        return view('relatorios.base.faturadas', compact('propostas'));
    }

    public function contasPagar(Request $request)
    {
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');

        $sql = "SELECT 
            p.id ,
            c.nome AS nome,
            v.chassi,
            v.desc_veiculo,
            v.vlr_tabela,
            v.pago,
            p.dta_faturamento
        FROM propostas p
        JOIN veiculos v ON v.id = p.id_veiculoNovo
        JOIN clientes c ON c.id = p.id_cliente
        WHERE v.status = 'Vendido'
    ";

        $bindings = [];

        if ($dataInicio && $dataFim) {
            $sql .= " AND p.dta_faturamento BETWEEN ? AND ?";
            $bindings[] = $dataInicio;
            $bindings[] = $dataFim;
        }

        $sql .= " ORDER BY p.id DESC";

        $propostas = DB::select($sql, $bindings);

        return view('relatorios.base.pagar', compact('propostas', 'dataInicio', 'dataFim'));
    }


    public function contasReceber(Request $request)
    {
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');

        $sql = "SELECT 
            n.id AS id,
            p.id AS proposta_id,
            c.nome AS cliente_nome,
            v.desc_veiculo,
            v.chassi,
            cp.descricao AS condicao_pagamento,
            p.dta_faturamento,
            n.valor,
            n.pago,
            n.data_vencimento
        FROM negociacoes n
        JOIN propostas p ON p.id = n.id_proposta
        JOIN clientes c ON c.id = p.id_cliente
        JOIN veiculos v ON v.id = p.id_veiculoNovo
        JOIN condicao_pagamentos cp ON cp.id = n.id_cond_pagamento
        WHERE cp.financeira = 1";

        $bindings = [];

        if ($dataInicio && $dataFim) {
            $sql .= " AND n.data_vencimento BETWEEN ? AND ?";
            $bindings[] = $dataInicio;
            $bindings[] = $dataFim;
        }

        $sql .= " ORDER BY n.data_vencimento";

        $negociacoes = DB::select($sql, $bindings);

        return view('relatorios.base.receber', compact('negociacoes', 'dataInicio', 'dataFim'));
    }


    public function clientes()
    {
        return view('relatorios.cadastros.clientes');
    }

    public function familias()
    {
        return view('relatorios.cadastros.familias');
    }

    public function opcionais()
    {
        return view('relatorios.cadastros.opcionais');
    }

    public function cores()
    {
        return view('relatorios.cadastros.cores');
    }

    public function condicoesPagamento()
    {
        return view('relatorios.cadastros.condicoes');
    }
}
