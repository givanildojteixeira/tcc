<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class UsadosController extends Controller
{

    // Criando restrição para quem pode acessar o metodo index
    public function __construct()
    {
        // $this->middleware(middleware: 'can:level')->only(methods: 'index');
    }

    //paginador
    public function pg()
    {
        return 50;
    }

    // Método privado que carrega os dados gerais, desconsiderando qualquer filtro
    // com objetivo de alimentar as combos da view

    private function carregarDadosVeiculos(Request $request)
{
    $campos = ['desc_veiculo', 'cor', 'Ano_Mod', 'combustivel', 'portas'];
    $dados = [];

    // Marca: sempre todas
    $dados['marca'] = Veiculo::select('marca')
        ->distinct()
        ->where('novo_usado', 'Usado')
        ->orderBy('marca')
        ->get();

    foreach ($campos as $campo) {
        $query = Veiculo::select($campo)
            ->distinct()
            ->where('novo_usado', 'Usado');

        if ($request->filled('marca')) {
            $query->where('marca', $request->marca);
        }
        if ($request->filled('cor')) {
            $query->where('cor', $request->cor);
        }
        if ($request->filled('ano')) {
            $query->where('Ano_Mod', $request->ano);
        }
        if ($request->filled('modelo')) {
            $query->where('desc_veiculo', $request->modelo);
        }
        if ($request->filled('portas')) {
            $query->where('portas', $request->portas);
        }
        if ($request->filled('combustivel') && $campo !== 'combustivel') {
            $query->where('combustivel', $request->combustivel);
        }

        $dados[$campo] = $query->orderBy($campo)->get();
    }

    return [
        'veiculosUnicos' => $dados['desc_veiculo'],
        'cores' => $dados['cor'],
        'marcas' => $dados['marca'],
        'anos' => $dados['Ano_Mod'],
        'combustiveis' => $dados['combustivel'],
        'portas' => $dados['portas'],
    ];
}




    public function index(Request $request)
    {
        //limpa filtros da sessão
        session()->forget('marca_selecionado');
        session()->forget('modelo_selecionado');
        session()->forget('ano_selecionado');
        session()->forget('combustivel_selecionado');
        session()->forget('transmissao_selecionado');
        session()->forget('cor_selecionado');
        session()->forget('portas_selecionado');
        session()->forget('chassi_selecionado');

        // Se um novo filtro for aplicado, salva na sessão
        if ($request->has('marca'))        session(['marca_selecionado' => $request->marca]);
        if ($request->has('modelo'))       session(['modelo_selecionado' => $request->modelo]);
        if ($request->has('ano'))          session(['ano_selecionado' => $request->ano]);
        if ($request->has('combustivel'))  session(['combustivel_selecionado' => $request->combustivel]);
        if ($request->has('transmissao'))  session(['transmissao_selecionado' => $request->transmissao]);
        if ($request->has('cor'))          session(['cor_selecionado' => $request->cor]);
        if ($request->has('portas'))       session(['portas_selecionado' => $request->portas]);
        if ($request->has('chassi'))       session(['chassi_selecionado' => $request->chassi]);
        // Armazena na sessão para manter os filtros após recarga  de Preço
        $valorMin = floatval($request->input('valor_min', 0));
        $valorMax = floatval($request->input('valor_max', 1000000));

        session(['valor_min' => $valorMin, 'valor_max' => $valorMax]);

        // Carrega os dados compartilhados
        $dados = $this->carregarDadosVeiculos($request);

        // Inicia a query
        $query = Veiculo::where('novo_usado', 'Usado')
            ->where('status', '!=', 'avaliacao');


        // Aplica filtros se existirem
        if ($request->filled('marca'))         $query->where('marca', $request->input('marca'));
        if ($request->filled('modelo'))        $query->where('desc_veiculo', $request->input('modelo'));
        if ($request->filled('combustivel'))   $query->where('combustivel', $request->input('combustivel'));
        if ($request->filled('ano'))           $query->where('Ano_Mod', $request->input('ano'));
        if ($request->filled('cor'))           $query->where('cor', $request->input('cor'));
        if ($request->filled('portas'))        $query->where('portas', $request->input('portas'));
        if ($request->filled('chassi'))        $query->where('chassi', 'LIKE', '%' . $request->input('chassi') . '%');

        if ($request->filled('valor'))         $query->where('vlr_tabela', '<=', $request->input('valor'));


        // Filtro de preço
        // Se valor único for informado, aplica ele
        if ($request->filled('valor')) {
            $query->where('vlr_tabela', '<=', floatval($request->input('valor')));
        } else {
            // Caso contrário, aplica o range
            $query->whereBetween('vlr_tabela', [$valorMin, $valorMax]);
        }

        // Executa a consulta
        $veiculos = $query->orderBy('desc_veiculo')
            ->paginate($this->pg())
            ->appends(request()->query());  // Mantém os parâmetros de filtro na URL

        // Verifica se o usuário quer ver como relatório
        if ($request->filled('relatorio')) {
            return view('veiculos.usados.relatorios.lista', array_merge($dados, ['veiculos' => $veiculos]));
        }

        // Retorna a view com os dados filtrados
        return view('veiculos.usados.index', array_merge($dados, ['veiculos' => $veiculos]));
    }

    public function limparFiltros()
    {
        session()->forget('marca_selecionado');
        session()->forget('modelo_selecionado');
        session()->forget('ano_selecionado');
        session()->forget('combustivel_selecionado');
        session()->forget('transmissao_selecionado');
        session()->forget('cor_selecionado');
        session()->forget('portas_selecionado');
        session()->forget('chassi_selecionado');

        return redirect()->route('veiculos.usados.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('veiculos.novos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $cliente = new Cliente();
        // $cliente->user_id      = $request->user_id;
        // $cliente->nome         = $request->nome;
        // $cliente->email        = $request->email;
        // $cliente->telefone     = $request->telefone;
        // $cliente->telefonecom  = $request->telefonecom;
        // $cliente->endereco     = $request->endereco;
        // $cliente->bairro       = $request->bairro;
        // $cliente->cidade       = $request->cidade;
        // $cliente->uf           = $request->uf;
        // $cliente->sexo         = $request->sexo;

        // $cliente->save();
        // return redirect()->route(route: 'cliente.create')->with('msg', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('veiculos.novos.show', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('veiculos.novos.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Cliente::findOrFail($cliente->id)->update($request->all());
        // return redirect()->route('cliente.show', $cliente->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        // Cliente::findOrFail($cliente->id)->delete();
        // return redirect()->route('meus-clientes', Auth::user()->id);
    }

    public function confirma_delete(Cliente $id)
    {
        // return view('clientes.confirma_delete',['id' => $id]);
    }
}
