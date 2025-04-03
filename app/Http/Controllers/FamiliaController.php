<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use App\Models\Familia;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{

    public function index()
    {
        $familias = Familia::all();
        return view('familia.index', compact('familias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'site' => 'required|string|max:255',
            'imagem' => 'nullable|image|mimes:jpg,jpeg|max:2048',
        ]);

        // Salva a família no banco
        $familia = Familia::create([
            'descricao' => $request->descricao,
            'site' => $request->site,
        ]);

        // Salva a imagem com o nome da família
        if ($request->hasFile('imagem')) {
            $extensao = $request->file('imagem')->getClientOriginalExtension();
            $nomeArquivo = str_replace(' ', '_', $request->descricao) . '.' . $extensao;
            $request->file('imagem')->move(public_path('images/familia'), $nomeArquivo);
        }

        return redirect()->route('familia.index')->with('success', 'Família cadastrada com sucesso!');
    }




    public function update(Request $request, $id)
    {
        // Antes de iniciar a gravar familia, verifique a opçao de
        // Mostrar todas as famílias no carrossel (mesmo sem veículos)
        // ela grava no config
        if ($request->has('mostrar_todas')) {
            Configuracao::updateOrCreate(
                ['chave' => 'mostrar_todas_familias'],
                ['valor' => 'true']
            );
        } else {
            Configuracao::updateOrCreate(
                ['chave' => 'mostrar_todas_familias'],
                ['valor' => 'false']
            );
        }

        // Continua a gravação e dados
        $request->validate([
            'descricao' => 'required|string|max:255',
            'site' => 'required|string|max:255',
            'imagem' => 'nullable|image|mimes:jpg,jpeg|max:2048',
        ]);

        $familia = Familia::findOrFail($id);

        // Se o nome foi alterado, renomear a imagem
        $nomeAntigo = str_replace(' ', '_', $familia->descricao) . '.jpg';
        $caminhoAntigo = public_path('images/familia/' . $nomeAntigo);

        // Atualiza descrição no banco
        $familia->descricao = $request->descricao;
        $familia->site = $request->site;
        $familia->save();

        // Se enviou nova imagem, substituir
        if ($request->hasFile('imagem')) {
            // Deleta imagem antiga
            if (file_exists($caminhoAntigo)) {
                unlink($caminhoAntigo);
            }

            $extensao = $request->file('imagem')->getClientOriginalExtension();
            $novoNome = str_replace(' ', '_', $request->descricao) . '.' . $extensao;

            $request->file('imagem')->move(public_path('images/familia'), $novoNome);
        } else {
            // Se apenas o nome foi alterado, renomeia a imagem
            if ($request->descricao !== $familia->getOriginal('descricao') && file_exists($caminhoAntigo)) {
                $novoNome = str_replace(' ', '_', $request->descricao) . '.jpg';
                rename($caminhoAntigo, public_path('images/familia/' . $novoNome));
            }
        }

        return redirect()->route('familia.index')->with('success', 'Família atualizada com sucesso!');
    }


    public function destroy($id)
    {
        $familia = Familia::findOrFail($id);

        // Monta o nome do arquivo com base na descrição
        $nomeArquivo = str_replace(' ', '_', $familia->descricao) . '.jpg';
        $caminhoImagem = public_path('images/familia/' . $nomeArquivo);

        // Remove o arquivo se existir
        if (file_exists($caminhoImagem)) {
            unlink($caminhoImagem);
        }

        // Exclui o registro do banco
        $familia->delete();

        return redirect()->route('familia.index')->with('success', 'Família excluída com sucesso!');
    }





}
