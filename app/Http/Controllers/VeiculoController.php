<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Familia;
use App\Models\Cor;
use App\Models\Opcionais;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


// VIEW PARA CRIAÇÃO DE VEICULO
class VeiculoController extends Controller
{

    public function edit($id)
    {
        $veiculo = Veiculo::with('vendedor')->findOrFail($id);

        $familias = Familia::all(); // aqui pega os dados do banco

        //relacionamento de familia <> cor
        $familia = Familia::where('descricao', $veiculo->familia)->first();
        $coresRelacionadas = $familia ? $familia->cores : collect();


        if ($veiculo->novo_usado === 'Novo') {
            $opcionalDescricao = Opcionais::where('modelo_fab', $veiculo->modelo_fab)
                ->where('cod_opcional', $veiculo->cod_opcional)
                ->value('descricao');
        } else {
            $opcionalDescricao = Opcionais::where('chassi', $veiculo->chassi)
                ->value('descricao');
        }

        return view('veiculos.edit', compact('veiculo', 'familias', 'opcionalDescricao', 'coresRelacionadas'));
    }


    public function update(Request $request, $id)
    {
        $veiculo = Veiculo::findOrFail($id);

        // dd($request);

        // Corrige os valores monetários ANTES da validação
        $request->merge([
            'vlr_tabela' => limparMoeda($request['vlr_tabela']),
            'vlr_bonus' => limparMoeda($request['vlr_bonus']),
            'vlr_nota' => limparMoeda($request['vlr_nota']),
        ]);

        // Validador manual
        $validator = Validator::make($request->all(), [
            'familia' => 'required|string|max:255',
            'desc_veiculo' => 'required|string|max:255',
            'chassi' => 'required|string|max:50|unique:veiculos,chassi,' . $id,
            'placa' => 'nullable|string|max:8',
            'Ano_Mod' => 'nullable|string|max:20',
            'cor' => 'nullable|string|max:50',
            'motor' => 'nullable|string|max:10',
            'transmissao' => 'required|string|in:Automática,Mecânica',
            'portas' => 'nullable|integer',
            'combustivel' => 'nullable|string|max:50',
            'vlr_nota' => 'nullable|numeric',
            'vlr_bonus' => 'nullable|numeric',
            'vlr_tabela' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpg,jpeg|max:2048',
            'descricao' => 'nullable|string|max:10000',
            'local' => 'required|string|in:Matriz,Filial,Transito,Consignado,Avaliação',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $validator->errors()->all()));
        }

        $dados = $validator->validated();

        // Força maiúsculas
        $dados['desc_veiculo'] = mb_strtoupper($dados['desc_veiculo'], 'UTF-8');
        
        // Somente parea veiculos usados
        if ($veiculo->novo_usado === 'Usado') {
            $dados['placa'] = mb_strtoupper($dados['placa'], 'UTF-8');
            // $dados['familia'] = $request['marca'];
        }

        $veiculo->update($dados);

        // Upload de imagens 
        if ($request->hasFile('images')) {
            $arquivos = $request->file('images');
            $chassiBase = str_replace(' ', '_', $veiculo->chassi);
            $destino = public_path('images/cars');

            if (!file_exists($destino)) {
                mkdir($destino, 0755, true);
            }

            $arquivosExistentes = collect(range(1, 10))
                ->map(fn($i) => file_exists("$destino/{$chassiBase}_" . str_pad($i, 2, '0', STR_PAD_LEFT) . '.jpg') ? $i : null)
                ->filter()
                ->values()
                ->toArray();

            $proximaPosicao = 1;

            foreach ($arquivos as $arquivo) {
                if ($arquivo->isValid()) {
                    while (in_array($proximaPosicao, $arquivosExistentes) && $proximaPosicao <= 10) {
                        $proximaPosicao++;
                    }

                    if ($proximaPosicao > 10)
                        break;

                    $numero = str_pad($proximaPosicao, 2, '0', STR_PAD_LEFT);
                    $nomeArquivo = $chassiBase . '_' . $numero . '.jpg';
                    $arquivo->move($destino, $nomeArquivo);
                    $proximaPosicao++;
                }
            }
        }

        // Atualiza ou cria opcionais
        $descricao = str_replace("\n", '/', $request->descricao);
        $descricao = trim($descricao) === '' ? 'Opcional não cadastrado' : $descricao;

        if ($veiculo->novo_usado === 'Novo') {
            Opcionais::updateOrCreate(
                ['modelo_fab' => $veiculo->modelo_fab, 'cod_opcional' => $veiculo->cod_opcional],
                ['descricao' => $descricao]
            );
        } else {
            Opcionais::updateOrCreate(
                ['chassi' => $veiculo->chassi],
                [
                    'descricao' => $descricao,
                    'modelo_fab' => 'SemModelo',
                    'cod_opcional' => '000',
                ]
            );
        }

        // Redireciona com sucesso
        $rota = $request->from === 'usados' ? 'veiculos.usados.index' : 'veiculos.novos.index';
        return redirect()->route($rota, [
            'openModal' => 1,
            'veiculo_id' => $veiculo->id
        ])->with('success', 'Veículo atualizado com sucesso!');
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


    public function create(Request $request)
    {
        $familias = Familia::all();
        $cores = Cor::orderBy('cor_desc')->get();

        return view('veiculos.create', [
            'familias' => $familias,
            'cores' => $cores,
            'from' => $request->input('from') // 'novos' ou 'usados'
        ]);
    }

    // criação de novos veiculos
    public function store(Request $request)
    {

        // Corrige os valores monetários
        $request['vlr_tabela'] = limparMoeda(valor: $request['vlr_tabela']);
        $request['vlr_bonus'] = limparMoeda($request['vlr_bonus']);
        $request['vlr_nota'] = limparMoeda($request['vlr_nota']);

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'familia' => request('from') === 'usados' ? 'nullable|string|max:255' : 'required|string|max:255',
            'desc_veiculo' => 'required|string|max:255',
            'placa' => 'nullable|string|max:255',
            'marca' => 'nullable|string|max:255',
            'chassi' => 'required|string|max:50|unique:veiculos,chassi',
            'Ano_Mod' => 'nullable|string|max:20',
            'cor' => 'nullable|string|max:50',
            'motor' => 'nullable|string|max:10',
            'transmissao' => request('from') === 'usados' ? 'nullable' : 'required|string|in:Automática,Mecânica',
            'portas' => 'nullable|integer',
            'combustivel' => 'nullable|string|max:50',
            'vlr_nota' => 'nullable|numeric',
            'vlr_bonus' => 'nullable|numeric',
            'vlr_tabela' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpg|max:2048',
            'descricao' => 'nullable|string|max:10000',
            'local' => 'required|string|in:matriz,filial,transito,consignado,Avaliação',
        ]);

        //Caso nao valide volta com o erros ou
        if ($validator->fails()) {
            // Retorna com todos os erros unidos por <br>
            return redirect()->back()
                ->withInput()
                ->with('error', $validator->errors()->all() ? implode('<br>', $validator->errors()->all()) : 'Erro de validação.');
        }
        //validado
        $validated = $validator->validated();

        // Criação do veiculo
        $veiculo = new Veiculo();
        $veiculo->fill($validated);

        // Forçar descrição em letras maiúsculas
        $veiculo->desc_veiculo = mb_strtoupper($veiculo->desc_veiculo, 'UTF-8');
        $veiculo->marca = mb_strtoupper($veiculo->marca, 'UTF-8');
        $veiculo->placa = mb_strtoupper($veiculo->placa, 'UTF-8');

        //espeficificos:
        // $veiculo->modelo_fab = $request->modelo_fab;
        // $veiculo->cod_opcional = $request->cod_opcional;
        $veiculo->novo_usado = ($request->from === 'novos') ? 'novo' : 'usado';
        $veiculo->marca = ($request->from === 'novos') ? 'GM' : $request->marca;
        $veiculo->dta_faturamento = date('Y-m-d');  //now()
        $veiculo->user_reserva = Auth::id(); // ou Auth::user()->id;
        $veiculo->desc_nota = ($request->from === 'novos') ? 'veiculo novo' : 'veiculo semi novo';
        //para usados
        if ($request->from === 'usados') {
            // $veiculo->marca = 'Seminovos';
            $veiculo->familia = $veiculo->marca;
            $veiculo->modelo_fab = $request->desc_veiculo;
            $veiculo->cod_opcional = ' ';
        }
        if ($request->origem === 'propostas') {
            $veiculo->status = 'avaliacao';
        }


        $veiculo->save();

        //  Salvar imagens
        if ($request->hasFile('images')) {
            $chassiBase = str_replace(' ', '_', $veiculo->chassi);
            foreach ($request->file('images') as $index => $image) {
                if ($index < 10) {
                    $nome = $chassiBase . '_' . str_pad($index + 1, 2, '0', STR_PAD_LEFT) . '.jpg';
                    $image->move(public_path('images/cars'), $nome);
                }
            }
        }

        // Atualiza ou cria opcionais
        $descricao = str_replace("\n", '/', $request->descricao);
        $descricao = trim($descricao) === '' ? 'Opcional não cadastrado' : $descricao;

        if ($veiculo->novo_usado === 'Novo') {
            Opcionais::updateOrCreate(
                ['modelo_fab' => $veiculo->modelo_fab, 'cod_opcional' => $veiculo->cod_opcional],
                ['descricao' => $descricao]
            );
        } else {
            Opcionais::updateOrCreate(
                ['chassi' => $veiculo->chassi],
                [
                    'descricao' => $descricao,
                    'modelo_fab' => '',
                    'cod_opcional' => '',
                ]
            );
        }

        // Devolve a URL
        if ($request->from === 'usados') {
            if ($request->origem === 'propostas') {
                //Se tiver vindo de propostas , grava o veiculo, acerta a url e devolve para proposta com o veiculo ou veiculos gravados
                $novoVeiculoUsadoId = $veiculo->id;                                     //pega a id
                $parametrosAtuais["id_veic_usado"] = $novoVeiculoUsadoId;               //grava paratro novo
                return redirect()->route('propostas.create', $parametrosAtuais);
            } else {
                return redirect()->route('veiculos.usados.index')->with('success', 'Veículo cadastrado com sucesso!');
            }
        } else {
            return redirect()->route('veiculos.novos.index')->with('success', 'Veículo cadastrado com sucesso!');
        }
    }


    public function alterarStatus(Request $request, $id)
    {
        $veiculo = Veiculo::findOrFail($id);

        $campo = $request->input('campo');
        $valor = filter_var($request->input('valor'), FILTER_VALIDATE_BOOLEAN);

        if (!in_array($campo, ['ativo', 'promocao'])) {
            return response()->json(['error' => 'Campo inválido'], 400);
        }

        $veiculo->$campo = $valor;
        $veiculo->save();

        return response()->json(['success' => true, 'campo' => $campo, 'valor' => $valor]);
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Veiculo $veiculo)
    {
        // Excluir imagens do veículo, se necessário
        $chassiBase = str_replace(' ', '_', $veiculo->chassi);
        for ($i = 1; $i <= 10; $i++) {
            $arquivo = public_path("images/cars/{$chassiBase}_" . str_pad($i, 2, '0', STR_PAD_LEFT) . '.jpg');
            if (file_exists($arquivo)) {
                unlink($arquivo);
            }
        }

        $veiculo->delete();

        return redirect()->route(
            request('from') === 'usados' ? 'veiculos.usados.index' : 'veiculos.novos.index'
        )->with('success', 'Veículo excluído com sucesso!');
    }
}
