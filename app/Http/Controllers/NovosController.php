<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class NovosController extends Controller
{

    // Criando restrição para quem pode acessar o metodo index
    public function __construct()
    {
        $this->middleware(middleware: 'can:level')->only(methods: 'index');
    }

    //paginador
    public function pg()
    {
        return 50;
    }

    // Método privado que carrega os dados compartilhados
    private function carregarDadosVeiculos($familia = null)
    {
        $campos = ['desc_veiculo', 'cor'];
        $dados = [];

        foreach ($campos as $campo) {
            $query = Veiculo::select($campo)
                ->distinct()
                ->where([
                    ['marca', 'GM'],
                    ['novo_usado', 'Novo']
                ]);

            // Se houver um filtro de família, aplica o filtro no desc_veiculo
            if ($familia) {
                $query->where('desc_veiculo', 'LIKE', "%{$familia}%");
            }

            $dados[$campo] = $query->get();
        }

        // Carrega as imagens das famílias
        $imagens = File::allFiles(public_path('images/familia'));

        return [
            'veiculosUnicos' => $dados['desc_veiculo'],
            'cores' => $dados['cor'],
            'imagens' => $imagens
        ];
    }

    public function index(Request $request)
    {
        // Verifica se o filtro de 'familia' foi alterado
        $familia = $request->filled('familia') ? $request->input('familia') : null;

        // Se a família foi alterada, limpa os filtros e redireciona para a URL apenas com 'familia'
        if ($familia && session('familia_selecionado') !== $familia) {
            // Limpa todos os filtros de sessão, exceto 'familia'
            session()->forget([
                'modelo_selecionado',
                'chassi_selecionado',
                'combustivel_selecionado',
                'ano_selecionado',
                'transmissao_selecionado',
                'cor_selecionado'
            ]);

            // Salva apenas a nova família na sessão
            session(['familia_selecionado' => $familia]);

            // Redireciona para a URL atual com apenas o filtro 'familia'
            return redirect()->route('veiculos.novos.index', ['familia' => $familia]);
        }

        // Se não houver alteração na família, mantém os filtros atuais na sessão
        if ($request->has('familia'))      session(['familia_selecionado'     => $request->familia]);
        if ($request->has('modelo'))       session(['modelo_selecionado'      => $request->modelo]);
        if ($request->has('chassi'))       session(['chassi_selecionado'      => $request->chassi]);
        if ($request->has('combustivel'))  session(['combustivel_selecionado' => $request->combustivel]);
        if ($request->has('ano'))          session(['ano_selecionado'         => $request->ano]);
        if ($request->has('transmissao'))  session(['transmissao_selecionado' => $request->transmissao]);
        if ($request->has('cor'))          session(['cor_selecionado'         => $request->cor]);

        // Carrega os dados compartilhados
        $dados = $this->carregarDadosVeiculos($familia);

        // Inicia a query
        $query = Veiculo::where('novo_usado', 'Novo')
            ->where('marca', 'GM');

        // Aplica os filtros baseados nos parâmetros da URL
        if ($request->filled('familia'))       $query->where('familia', 'LIKE', '%' . $request->input('familia') . '%');
        if ($request->filled('modelo'))        $query->where('desc_veiculo', $request->input('modelo'));
        if ($request->filled('chassi'))        $query->where('chassi', 'LIKE', '%' . $request->input('chassi'));
        if ($request->filled('cor'))           $query->where('cor', $request->input('cor'));
        if ($request->filled('ano'))           $query->where('Ano_Mod', $request->input('ano'));
        if ($request->filled('combustivel'))   $query->where('combustivel', $request->input('combustivel'));
        if ($request->filled('transmissao'))   $query->where('transmissao', $request->input('transmissao'));

        // Executa a consulta
        $veiculos = $query->orderBy('desc_veiculo')
            ->paginate($this->pg())
            ->appends(request()->query());  // Mantém os parâmetros de filtro na URL

        // Verifica se o usuário quer ver como relatório
        if ($request->filled('relatorio')) {
            return view('veiculos.novos.relatorios.lista', array_merge($dados, ['veiculos' => $veiculos]));
        }

        // Retorna a view
        return view('veiculos.novos.index', array_merge($dados, ['veiculos' => $veiculos]));
    }

    public function limparFiltros()
    {
        session()->forget([
            'familia_selecionado',
            'modelo_selecionado',
            'chassi_selecionado',
            'combustivel_selecionado',
            'ano_selecionado',
            'transmissao_selecionado',
            'cor_selecionado',
        ]);

        return redirect()->route('veiculos.novos.index');
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
