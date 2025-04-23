<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;
use App\Models\CondicaoPagamento;
use App\Http\Controllers\Controller;

class PropostaController extends Controller
{
    //
    public function index()
    {
        return view('propostas.index');
    }

    public function create(Request $request)
    {
        $veiculoNovo = null;
        if ($request->has('veiculo_id')) {
            $veiculoNovo = Veiculo::find($request->veiculo_id);
        }

        $condicoes = CondicaoPagamento::orderBy('descricao')->get();

        if ($request->filled('usado_chassi')) {
            $veiculoUsado = Veiculo::create([
                'marca' => $request->usado_marca,
                'modelo' => $request->usado_modelo,
                'chassi' => $request->usado_chassi,
                'ano_fabricacao' => $request->usado_ano,
                'novo_usado' => 'Usado',
            ]);
            // $proposta->id_veiculoUsado1 = $veiculoUsado->id;
        }
        

        return view('propostas.create', compact('veiculoNovo', 'condicoes'));
    }
}
