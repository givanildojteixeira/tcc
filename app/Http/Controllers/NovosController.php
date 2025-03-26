<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class NovosController extends Controller
{

    // Criando restrição para quem pode acessar o metodo index
    public function __construct()
    {
        $this->middleware(middleware: 'can:level')->only(methods: 'index');
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera os valores únicos da coluna 'desc_veiculo' da tabela 'veiculos'
        $veiculosUnicos = Veiculo::select('desc_veiculo')
            ->distinct()  // Garante que não haja repetições
            ->where('marca', 'GM')  // Filtro pela marca 'GM' principal da View
            ->where('novo_usado', 'Novo')
            ->get();

        // Busca todos os arquivos na pasta public/images/familia/
        $imagens = File::allFiles(public_path('images/familia'));

        //limpa filtros da sessão
        session()->forget('modelo_selecionado');
        session()->forget('ano_modelo_selecionado');
        session()->forget('combustivel_selecionado');

        return view('veiculos.novos.index', [
            'veiculos' => Veiculo::where('marca', 'GM')
                ->orderBy('desc_veiculo')
                ->paginate(50),
            'imagens' => $imagens, // Passa as imagens para a view
            'veiculosUnicos' => $veiculosUnicos, // Passa os veículos únicos para a view
        ]);
    }

    //   FILTROS   **************************************

    // Método privado que carrega os dados compartilhados
    private function carregarDadosVeiculos()
    {
        // Carrega os veículos únicos
        $veiculosUnicos = Veiculo::select('desc_veiculo')
            ->distinct()  // Garante que não haja repetições
            ->where('marca', 'GM')  // Filtro pela marca 'GM'
            ->where('novo_usado', 'Novo')  // Filtro de "Novo"
            ->get();

        // Carrega as imagens das famílias
        $imagens = File::allFiles(public_path('images/familia'));
        return compact('veiculosUnicos', 'imagens');
    }

    public function filtrarPorFamilia($familia)
    {
        // Carrega os dados compartilhados
        $dados = $this->carregarDadosVeiculos();

        // Filtro
        $veiculos = Veiculo::where('desc_veiculo', 'LIKE', "%$familia%")
            ->where('marca', 'GM')
            ->where('novo_usado', 'Novo')
            ->orderBy('desc_veiculo')
            ->paginate(50);

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
            ->paginate(5);

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
            ->paginate(5);

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
            ->paginate(5);

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
            ->paginate(50);

        // Retorna a view com os dados filtrados
        return view('veiculos.novos.index', array_merge($dados, [
            'veiculos' => $veiculos,
            'combustivel_selecionado' => $combustivel
        ]));
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
