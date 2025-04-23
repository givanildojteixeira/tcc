<?php

namespace App\Http\Controllers;

use App\Models\CondicaoPagamento;
use Illuminate\Http\Request;

class CondicaoPagamentoController extends Controller
{
    public function index()
    {
        $condicoes = CondicaoPagamento::orderBy('descricao')->paginate(7);
        return view('condicao_pagamentos.index', compact('condicoes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:100|unique:condicao_pagamentos,descricao',
        ]);

        CondicaoPagamento::create($request->only('descricao'));

        return redirect()->back()->with('success', 'Condição de pagamento cadastrada com sucesso!');
    }

    public function update(Request $request, CondicaoPagamento $condicao_pagamento)
    {
        $request->validate([
            'descricao' => 'required|string|max:100|unique:condicao_pagamentos,descricao,' . $condicao_pagamento->id,
        ]);

        $condicao_pagamento->update($request->only('descricao'));

        return redirect()->back()->with('success', 'Condição de pagamento atualizada com sucesso!');
    }

    public function destroy(CondicaoPagamento $condicao_pagamento)
    {
        $condicao_pagamento->delete();

        return redirect()->back()->with('success', 'Condição de pagamento excluída com sucesso!');
    }
}
