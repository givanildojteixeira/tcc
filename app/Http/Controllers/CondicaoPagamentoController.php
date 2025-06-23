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
            'descricao' => 'required|string|max:100|unique:condicao_pagamentos,descricao,'
        ]);

        CondicaoPagamento::create($request->only('descricao'));

        return redirect()->back()->with('success', 'Condição de pagamento cadastrada com sucesso!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'descricao' => 'required|string|max:100',
        ]);

        $condicao = CondicaoPagamento::findOrFail($id);

        $condicao->descricao = $request->input('descricao');
        $condicao->financeira = $request->boolean('financeira'); 

        $condicao->save();

        return back()->with('success', 'Condição de pagamento atualizada.');
    }


    public function destroy(CondicaoPagamento $condicao_pagamento)
    {
        $condicao_pagamento->delete();

        return redirect()->back()->with('success', 'Condição de pagamento excluída com sucesso!');
    }
}
