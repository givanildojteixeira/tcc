<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposta;

class FinanceiroController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $propostas = Proposta::with('veiculo')
            ->whereHas('veiculo', fn($query) => $query->where('status', 'Vendido'))
            ->when(
                $search,
                fn($q) =>
                $q->where(function ($sub) use ($search) {
                    $sub->where('id', 'like', "%$search%")
                        ->orWhere('nome_cliente', 'like', "%$search%")
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
}
