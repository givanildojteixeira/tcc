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
    private function carregarDadosVeiculos()
    {
        // Carrega os veículos únicos
        $veiculosUnicos = Veiculo::select('desc_veiculo')
            ->distinct()  // Garante que não haja repetições
            ->where('marca', 'GM')  // Filtro pela marca 'GM'
            ->where('novo_usado', 'Novo')  // Filtro de "Novo"
            ->get();

        // Carrega as cores dos veiculos
        $cores = Veiculo::select('cor')
            ->distinct()  // Garante que não haja repetições
            ->where('marca', 'GM')  // Filtro pela marca 'GM'
            ->where('novo_usado', 'Novo')  // Filtro de "Novo"
            ->get();

        // Carrega as imagens das famílias
        $imagens = File::allFiles(public_path('images/familia'));

        return compact('veiculosUnicos', 'cores', 'imagens');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carrega os dados compartilhados
        $dados = $this->carregarDadosVeiculos();

        //limpa filtros da sessão
        session()->forget('modelo_selecionado');
        session()->forget('ano_modelo_selecionado');
        session()->forget('combustivel_selecionado');
        session()->forget('transmissao_selecionada');
        session()->forget('corVeiculos_selecionada');

        // Filtra
        $veiculos = Veiculo::where('marca', 'GM')
            ->where('novo_usado', 'Novo')
            ->orderBy('desc_veiculo')
            ->paginate($this->pg());

        // Retorna a view
        return view('veiculos.novos.index', array_merge($dados, ['veiculos' => $veiculos]));
    }

    //   FILTROS   **************************************

    public function filtrarPorFamilia($familia)
    {
        // Carrega os dados compartilhados
        $dados = $this->carregarDadosVeiculos();

        // Filtro
        $veiculos = Veiculo::where('desc_veiculo', 'LIKE', "%$familia%")
            ->where('marca', 'GM')
            ->where('novo_usado', 'Novo')
            ->orderBy('desc_veiculo')
            ->paginate($this->pg());

        // Retorna a view
        return view('veiculos.novos.index', array_merge($dados, ['veiculos' => $veiculos]));
    }

    public function filtrarPorVeiculo($veiculo)
    {
        // Armazena o modelo na sessão
        session(['modelo_selecionado' => $veiculo]);

        // Carrega os dados compartilhados
        $dados = $this->carregarDadosVeiculos();

        // Filtra os veículos
        $veiculos = Veiculo::where('desc_veiculo', '=', $veiculo)
            ->where('marca', 'GM')
            ->where('novo_usado', 'Novo')
            ->orderBy('desc_veiculo')
            ->paginate($this->pg());

        // Retorna a view com os dados, incluindo o modelo selecionado na sessão
        return view('veiculos.novos.index', array_merge($dados, [
            'veiculos' => $veiculos,
            'modelo' => $veiculo, // Passa o modelo selecionado para a view
        ]));
    }


    public function filtrarPorChassi($chassi)
    {
        // Carrega os dados compartilhados
        $dados = $this->carregarDadosVeiculos();

        // Filtra
        $veiculos = Veiculo::where('chassi', 'LIKE', "%$chassi")
            ->where('marca', 'GM')
            ->where('novo_usado', 'Novo')
            ->orderBy('desc_veiculo')
            ->paginate($this->pg());

        // var_dump($veiculos); // Verifica se a consulta retorna resultados
        // Retorna a view
        return view('veiculos.novos.index', array_merge($dados, ['veiculos' => $veiculos]));
    }

    public function filtrarPorAnoModelo($ano_modelo)
    {
        // Salvar o valor selecionado na sessão para manter a seleção no combo
        session(['ano_modelo_selecionado' => $ano_modelo]);

        // Carregar dados compartilhados (caso tenha outros filtros)
        $dados = $this->carregarDadosVeiculos();

        // Filtrar os veículos com base no Ano/Modelo selecionado
        $veiculos = Veiculo::where('Ano_Mod', '=', $ano_modelo)
            ->where('marca', 'GM')
            ->where('novo_usado', 'Novo')
            ->orderBy('desc_veiculo')
            ->paginate($this->pg());

        // Retorna a view com os dados filtrados
        return view('veiculos.novos.index', array_merge($dados, [
            'veiculos' => $veiculos,
            'ano_modelo_selecionado' => $ano_modelo
        ]));
    }

    public function filtrarPorCombustivel($combustivel)
    {
        // Salva o combustível selecionado na sessão
        session(['combustivel_selecionado' => $combustivel]);

        // Convertendo a primeira letra para maiúscula e pegando os 3 primeiros caracteres
        $combustivelAbreviado = strtoupper(substr($combustivel, 0, 3));

        // Carregar dados compartilhados (se houver outros filtros)
        $dados = $this->carregarDadosVeiculos();

        // Filtrando os veículos com base no combustível
        $veiculos = Veiculo::whereRaw('UPPER(SUBSTRING(combustivel, 1, 3)) = ?', [$combustivelAbreviado])
            ->where('marca', 'GM')
            ->where('novo_usado', 'Novo')
            ->orderBy('desc_veiculo')
            ->paginate($this->pg());

        // Retorna a view com os dados filtrados
        return view('veiculos.novos.index', array_merge($dados, [
            'veiculos' => $veiculos,
            'combustivel_selecionado' => $combustivel
        ]));
    }

    public function filtrarPorTransmissao($transmissao)
    {
        // Salva o valor da transmissão na sessão
        session(['transmissao_selecionada' => $transmissao]);

        // Carrega os dados compartilhados
        $dados = $this->carregarDadosVeiculos();


        // Pegando os 3 primeiros caracteres da transmissão e convertendo para maiúsculo
        $transmissaoAbreviada = strtoupper(substr($transmissao, 0, 3));

        // Filtra veículos com base nos últimos 3 caracteres da coluna 'combustivel'
        $veiculos = Veiculo::whereRaw('UPPER(SUBSTRING(combustivel, -3)) = ?', [$transmissaoAbreviada])
            ->where('marca', 'GM')
            ->where('novo_usado', 'Novo')
            ->orderBy('desc_veiculo')
            ->paginate($this->pg()); // Paginação com 5 itens por página

        // Retorna a view com os dados filtrados
        return view('veiculos.novos.index', array_merge($dados, ['veiculos' => $veiculos]));
    }


    public function filtrarPorCor($cor)
    {
        // Salva o valor da cor na sessão para persistir a seleção
        session(['corVeiculos_selecionada' => $cor]);

        // Carrega os dados compartilhados
        $dados = $this->carregarDadosVeiculos();

        // Realiza a consulta com o filtro de cor
        $veiculos = Veiculo::where('cor', $cor)  // Filtra pelos veículos que possuem a cor selecionada
            ->where('marca', 'GM')  // Filtro pela marca 'GM'
            ->where('novo_usado', 'Novo')  // Filtro de "Novo"
            ->orderBy('desc_veiculo')  // Ordenação por nome
            ->paginate(10);  // Paginação de 10 resultados por página

        // Retorna a view com os dados filtrados
        return view('veiculos.novos.index', array_merge($dados, ['veiculos' => $veiculos]));
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
