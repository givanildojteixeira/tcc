<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Familia;
use App\Models\Opcionais;
use Illuminate\Support\Facades\Auth;

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

        // Prepara a descrição, substitui quebra de linha por barra
        $descricao = str_replace("\n", '/', $request->descricao);

        // Se vier em branco ou só com espaços, define um texto padrão
        if (trim($descricao) === '') {
            $descricao = 'Opcional não cadastrado';
        }

        if ($veiculo->novo_usado === 'Novo') {
            // Atualiza ou cria para veículos novos
            Opcionais::updateOrCreate(
                [
                    'modelo_fab' => $veiculo->modelo_fab,
                    'cod_opcional' => $veiculo->cod_opcional,
                ],
                [
                    'descricao' => $descricao,
                ]
            );
        } else {
            // Atualiza ou cria para veículos usados
            Opcionais::updateOrCreate(
                [
                    'chassi' => $veiculo->chassi,
                ],
                [
                    'descricao' => $descricao,
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

    public function create(Request $request)
    {
        $familias = Familia::all();

        return view('veiculos.create', [
            'familias' => $familias,
            'from' => $request->input('from') // 'novos' ou 'usados'
        ]);
    }

    public function store(Request $request)
    {
        // Corrige os valores monetários
        $request['vlr_tabela'] = limparMoeda(valor: $request['vlr_tabela']);
        $request['vlr_bonus'] = limparMoeda($request['vlr_bonus']);
        $request['vlr_nota'] = limparMoeda($request['vlr_nota']);

        // dd($request->all());
        $validated = $request->validate([
            'familia' => 'required|string|max:255',
            'desc_veiculo' => 'required|string|max:255',
            'chassi' => 'required|string|max:50|unique:veiculos,chassi',
            'Ano_Mod' => 'nullable|string|max:20',
            'cor' => 'nullable|string|max:50',
            'motor' => 'nullable|string|max:10',
            'portas' => 'nullable|integer',
            'combustivel' => 'nullable|string|max:50',
            'vlr_nota' => 'nullable|numeric',
            'vlr_bonus' => 'nullable|numeric',
            'vlr_tabela' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpg|max:2048',
            'descricao' => 'nullable|string|max:5000',
            'local' => 'required|string|in:matriz,filial,transito,consignado',
        ]);

        $veiculo = new Veiculo();
        $veiculo->fill($validated);

        //espeficificos:
        $veiculo->modelo_fab = $request->modelo_fab;
        $veiculo->cod_opcional = $request->cod_opcional;
        $veiculo->novo_usado = ($request->from === 'novos') ? 'novo' : 'usado';
        $veiculo->marca = ($request->from === 'novos') ? 'GM' : $request->marca;
        $veiculo->dta_faturamento = date('Y-m-d');  //now()
        $veiculo->user_reserva = Auth::id(); // ou Auth::user()->id;
        $veiculo->desc_nota = ($request->from === 'novos') ? 'veiculo novo' : 'veiculo semi novo';



        $veiculo->save();

        // ⬇️ Salvar imagens
        if ($request->hasFile('images')) {
            $chassiBase = str_replace(' ', '_', $veiculo->chassi);
            foreach ($request->file('images') as $index => $image) {
                if ($index < 10) {
                    $nome = $chassiBase . '_' . str_pad($index + 1, 2, '0', STR_PAD_LEFT) . '.jpg';
                    $image->move(public_path('images/cars'), $nome);
                }
            }
        }

        // Redirecionamento inteligente
        $rota = $request->from === 'usados' ? 'veiculos.usados.index' : 'veiculos.novos.index';
        return redirect()->route($rota)->with('success', 'Veículo cadastrado com sucesso!');
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
