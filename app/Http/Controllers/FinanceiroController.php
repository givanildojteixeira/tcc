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
        $search = $request->input('search');

        $propostas = Proposta::with(['veiculo', 'cliente']) // carrega os relacionamentos
            ->whereHas('veiculo', fn($query) => $query->where('status', 'Vendido'))
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
            ->get();

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
        $search = $request->input('search');

        $negociacoes = Negociacao::with(['proposta.cliente', 'veiculo'])
            ->whereHas('condicaoPagamento', function ($query) {
                $query->where('financeira', true);
            })
            ->when(
                $search,
                fn($q) =>
                $q->where(function ($sub) use ($search) {
                    $sub->whereHas(
                        'proposta',
                        fn($p) =>
                        $p->where('id', 'like', "%$search%")
                            ->orWhereHas(
                                'cliente',
                                fn($c) =>
                                $c->where('nome', 'like', "%$search%")
                            )
                    )
                        ->orWhereHas(
                            'veiculo',
                            fn($v) =>
                            $v->where('chassi', 'like', "%$search%")
                                ->orWhere('desc_veiculo', 'like', "%$search%")
                        );
                })
            )
            ->get();

        return view('financeiro.receber', compact('negociacoes', 'search'));
    }


    public function marcarRecebido($id)
    {
        $negociacao = Negociacao::findOrFail($id);
        $negociacao->pago = 1;
        $negociacao->save();

        return back()->with('success', 'Recebimento confirmado com sucesso.');
    }



}
