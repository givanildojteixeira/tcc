<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Proposta;
use App\Models\Negociacao;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    public function index(Request $request)
    {
        // Carrega Variáveis para busca
        $search = $request->input('search');
        $mostrarPagos = $request->has('mostrar_pagos');

        $propostas = Proposta::with(['cliente', 'veiculo']) // carrega os relacionamentos
            ->whereHas('veiculo', fn($query) => $query->where('status', 'Vendido'))
            ->when(!$mostrarPagos, function ($query) {
                $query->whereHas('veiculo', fn($q) => $q->where('pago', false));
            })
            ->when(
                $search,
                fn($q) =>
                $q->where(function ($sub) use ($search) {
                    $sub->where('id', 'like', "%$search%")
                        ->orWhereHas(
                            'cliente',
                            fn($c) =>
                            $c->where('nome', 'like', "%$search%")
                        )
                        ->orWhereHas(
                            'veiculo',
                            fn($v) =>
                            $v->where('chassi', 'like', "%$search%")
                                ->orWhere('desc_veiculo', 'like', "%$search%")
                        );
                })
            )
            ->paginate(6);

        return view('financeiro.index', compact('propostas', 'search'));
    }

    public function pagar($veiculoId)
    {
        $veiculo = Veiculo::findOrFail($veiculoId);

        $veiculo->pago = 1;
        $veiculo->save();

        return back()->with('success', 'Pagamento confirmado com sucesso.');
    }

    public function receber(Request $request)
    {
        // Carregue as variáveis a partir do request
        $search = $request->input('search');
        $searchProposta = $request->input('searchProposta');  // pesquisar somente propostas
        $mostrarRecebidas = $request->has('mostrar_recebidas'); // checkbox marcada = mostrar tudo

        // Em negociações 
        $negociacoes = Negociacao::with(['proposta.cliente', 'proposta.veiculo', 'condicaoPagamento']) // 🔧 aqui corrigido
            // pesquise somente financeira = true em condicaoPagamento
            ->whereHas('condicaoPagamento', fn($q) => $q->where('financeira', true))
            // Atenção com o check box mostrar_recebidas, ignorando quando for pesquisa por Proposta (searchProposta)
            ->when(!$mostrarRecebidas && !$searchProposta, fn($q) => $q->where('pago', false))
            // então se for pesquisa  normal, pesquise por 'proposta.cliente', 'veiculo'
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->whereHas('proposta.cliente', fn($c) => $c->where('nome', 'like', "%$search%"))
                        ->orWhereHas('proposta.veiculo', fn($v) =>
                            $v->where('chassi', 'like', "%$search%")
                                ->orWhere('desc_veiculo', 'like', "%$search%"));
                });
            })
            // ou, se for pesquisa por proposta pesquise exclusivamente propostas e mostre tudo
            ->when(
                $searchProposta,
                fn($q) =>
                $q->whereHas('proposta', fn($p) =>
                    $p->where('id', 'like', "%$searchProposta%"))
            )
            ->paginate(6);

        return view('financeiro.receber', compact('negociacoes', 'search', 'searchProposta', 'mostrarRecebidas'));
    }


    public function marcarRecebido($id)
    {
        $negociacao = Negociacao::findOrFail($id);
        $negociacao->pago = 1;
        $negociacao->save();

        return back()->with('success', 'Recebimento confirmado com sucesso.');
    }



}
