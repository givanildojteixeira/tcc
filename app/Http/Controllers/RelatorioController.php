<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
     public function index()
    {
        return view('relatorios.index');
    }
public function estoqueNovos()
{
    $veiculos = Veiculo::where('novo_usado', 'Novo')->get();

    return view('relatorios.novos.estoque', compact('veiculos'));
}


    public function vendasNovos()
    {
        return view('relatorios.novos.vendas');
    }

    public function estoqueUsados()
    {
        return view('relatorios.usados.estoque');
    }

    public function lucroUsados()
    {
        return view('relatorios.usados.lucro');
    }

    public function propostasAprovadas()
    {
        return view('relatorios.propostas.aprovadas');
    }

    public function propostasRejeitadas()
    {
        return view('relatorios.propostas.rejeitadas');
    }

    public function contasPagar()
    {
        return view('relatorios.financeiro.pagar');
    }

    public function contasReceber()
    {
        return view('relatorios.financeiro.receber');
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

