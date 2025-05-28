<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Configuracao;
use App\Models\Veiculo;
use App\Models\Familia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class NovosController extends Controller
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

    // Método privado que carrega os dados compartilhados
    private function carregarDadosVeiculos($familia = null)
    {
        $campos = ['desc_veiculo', 'combustivel', 'transmissao', 'Ano_Mod'];
        $dados = [];

        foreach ($campos as $campo) {
            $query = Veiculo::select($campo)
                ->distinct()
                ->where([
                    ['marca', 'GM'],
                    ['novo_usado', 'Novo']
                ]);

            if ($familia) {
                $query->where('desc_veiculo', 'LIKE', "%{$familia}%");
            }

            $dados[$campo] = $query->get();
        }

        //  Carregar cores (Se tiver familia selecionada pega o relacionamento, caso contrario todas as cores do estoque)
        if ($familia) {
            $familiaModel = Familia::where('descricao', $familia)->first();

            if ($familiaModel) {
                $coresRelacionadas = $familiaModel->cores()->orderBy('cor_desc')->get();

                $cores = $coresRelacionadas->map(function ($cor) use ($familia) {
                    $temEstoque = Veiculo::where([
                        ['novo_usado', 'Novo'],
                        ['marca', 'GM'],
                        ['familia', $familia],
                        ['cor', $cor->cor_desc]
                    ])->exists();

                    return (object) [
                        'cor' => $cor->cor_desc,
                        'disponivel' => $temEstoque
                    ];
                });
            } else {
                $cores = collect();
            }
        } else {
            // Quando não há família, cores disponíveis no estoque (todas válidas)
            $cores = Veiculo::select('cor')
                ->distinct()
                ->where([
                    ['marca', 'GM'],
                    ['novo_usado', 'Novo']
                ])
                ->orderBy('cor')
                ->get()
                ->map(function ($cor) {
                    return (object) [
                        'cor' => $cor->cor,
                        'disponivel' => true
                    ];
                });
        }


        // Verificação de famílias válidas com imagem + veículo
        $mostrarTodas = Configuracao::where('chave', 'mostrar_todas_familias')->value('valor') === 'true';
        $familias = Familia::pluck('descricao')->toArray();
        $familiasValidas = [];

        foreach ($familias as $nomeFamilia) {
            $nomeArquivo = str_replace(' ', '_', $nomeFamilia) . '.jpg';
            $imagemExiste = File::exists(public_path('images/familia/' . $nomeArquivo));

            if (
                $mostrarTodas ||
                (
                    Veiculo::where('novo_usado', 'Novo')
                        ->where('familia', $nomeFamilia)
                        ->exists() && $imagemExiste
                )
            ) {
                $familiasValidas[] = [
                    'nome' => $nomeFamilia,
                    'imagem' => 'images/familia/' . $nomeArquivo,
                ];
            }
        }

        return [
            'veiculosUnicos' => $dados['desc_veiculo'],
            'cores' => $cores,
            'transmissoes' => $dados['transmissao'],
            'combustiveis' => $dados['combustivel'],
            'anosUnico' => $dados['Ano_Mod'],
            'familiasValidas' => $familiasValidas,
        ];
    }


    // Carrega a lista de veiculos para as tabelas 
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
        if ($request->has('familia'))
            session(['familia_selecionado' => $request->familia]);
        if ($request->has('modelo'))
            session(['modelo_selecionado' => $request->modelo]);
        if ($request->has('chassi'))
            session(['chassi_selecionado' => $request->chassi]);
        if ($request->has('combustivel'))
            session(['combustivel_selecionado' => $request->combustivel]);
        if ($request->has('ano'))
            session(['ano_selecionado' => $request->ano]);
        if ($request->has('transmissao'))
            session(['transmissao_selecionado' => $request->transmissao]);
        if ($request->has('cor'))
            session(['cor_selecionado' => $request->cor]);

        // Carrega os dados compartilhados
        $dados = $this->carregarDadosVeiculos($familia);

        // Inicia a query
        $query = Veiculo::where('novo_usado', 'Novo')
            ->where('marca', 'GM')
            ->where('status', '!=', 'vendido');

        // Aplica os filtros baseados nos parâmetros da URL
        if ($request->filled('familia'))
            $query->where('familia', 'LIKE', '%' . $request->input('familia') . '%');
        if ($request->filled('modelo'))
            $query->where('desc_veiculo', $request->input('modelo'));
        if ($request->filled('chassi'))
            $query->where('chassi', 'LIKE', '%' . $request->input('chassi'));
        if ($request->filled('cor'))
            $query->where('cor', $request->input('cor'));
        if ($request->filled('ano'))
            $query->where('Ano_Mod', $request->input('ano'));
        if ($request->filled('combustivel'))
            $query->where('combustivel', $request->input('combustivel'));
        if ($request->filled('transmissao'))
            $query->where('transmissao', $request->input('transmissao'));

        // Executa a consulta
        $veiculos = $query
            // ->when(request()->routeIs('veiculos.usados.index'), function ($q) {
            //     $q->with('vendedor'); // carrega o relacionamento apenas se for rota de usados
            // })
            ->orderBy('desc_veiculo')
            ->paginate($this->pg())
            ->appends(request()->query());


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

    public function create()
    {
        return view('veiculos.novos.create');
    }

}
