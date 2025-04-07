<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;
use App\Models\Familia;
use App\Models\Opcionais;

class VeiculoController extends Controller
{


    public function edit($id)
    {
        $veiculo = Veiculo::findOrFail($id);
        $familias = Familia::all(); // <- aqui você pega os dados do banco


        if ($veiculo->novo_usado === 'Novo') {
            $opcionalDescricao = Opcionais::where('modelo_fab', $veiculo->modelo_fab)
                ->where('cod_opcional', $veiculo->cod_opcional)
                ->value('descricao');
        } else {
            $opcionalDescricao = Opcionais::where('chassi', $veiculo->chassi)
                ->value('descricao');
        }

        return view('veiculos.edit', compact('veiculo', 'familias', 'opcionalDescricao'));
    }



    public function update(Request $request, $id)
    {
        // validações
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg|max:2048',
            'descricao' => 'nullable|string|max:10000',
        ]);


        $veiculo = Veiculo::findOrFail($id);

        // Corrige os valores monetários
        $dados = $request->all();
        $dados['vlr_tabela'] = limparMoeda($dados['vlr_tabela']);
        $dados['vlr_bonus'] = limparMoeda($dados['vlr_bonus']);
        $dados['vlr_nota'] = limparMoeda($dados['vlr_nota']);

        //Corrige dados de usados que nao sao necessarios por comparação com novos
        if ($veiculo->novo_usado === 'Usado') {
            $dados['familia'] = 'Seminovos';
        }

        $veiculo->update($dados);

        // Gravação de imagens
        if ($request->hasFile('images')) {
            $arquivos = $request->file('images');
            $chassiBase = str_replace(' ', '_', $veiculo->chassi);
            $destino = public_path('images/cars');

            if (!file_exists($destino)) {
                mkdir($destino, 0755, true);
            }

            // Verifica quais arquivos já existem
            $arquivosExistentes = collect(range(1, 10))
                ->map(function ($i) use ($chassiBase, $destino) {
                    $nome = $chassiBase . '_' . str_pad($i, 2, '0', STR_PAD_LEFT) . '.jpg';
                    return file_exists($destino . '/' . $nome) ? $i : null;
                })
                ->filter()
                ->values()
                ->toArray();

            $proximaPosicao = 1;

            foreach ($arquivos as $arquivo) {
                if ($arquivo->isValid()) {
                    // Encontra a próxima posição livre
                    while (in_array($proximaPosicao, $arquivosExistentes) && $proximaPosicao <= 10) {
                        $proximaPosicao++;
                    }

                    if ($proximaPosicao > 10) break; // Já atingiu o limite

                    $numero = str_pad($proximaPosicao, 2, '0', STR_PAD_LEFT);
                    $nomeArquivo = $chassiBase . '_' . $numero . '.jpg';

                    $arquivo->move($destino, $nomeArquivo);

                    $proximaPosicao++;
                }
            }
        }

        // grava opcioanais para novos
        // Atualiza ou cria o registro na tabela opcionais
        if ($veiculo->novo_usado === 'Novo') {
            Opcionais::updateOrCreate(
                [
                    'modelo_fab' => $veiculo->modelo_fab,
                    'cod_opcional' => $veiculo->cod_opcional,
                ],
                [
                    'descricao' => str_replace("\n", '/', $request->descricao),
                ]
            );
        } else {
            Opcionais::updateOrCreate(
                [
                    'chassi' => $veiculo->chassi,
                ],
                [
                    'descricao' => str_replace("\n", '/', $request->descricao),
                    'modelo_fab' => 'SemModelo',
                    'cod_opcional' => '000',
                ]
            );
        }


        // return com o item from para nao se perder entre as views
        return redirect()
            ->route('veiculos.edit', ['id' => $veiculo->id, 'from' => $request->input('from')])
            ->with('success', 'Veículo atualizado com sucesso!');
    }



    public function excluirImagem(Request $request)
    {
        $request->validate([
            'imagem' => 'required|string'
        ]);

        $caminho = public_path('images/cars/' . $request->imagem);

        if (file_exists($caminho)) {
            unlink($caminho);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Arquivo não encontrado.'], 404);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Veiculo $veiculo)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Veiculo $veiculo)
    {
        //
    }
}
