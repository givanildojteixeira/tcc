<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use App\Models\Familia;
use App\Models\Configuracao;
use Illuminate\Http\Request;
use App\Models\Veiculo;

class FamiliaController extends Controller
{


    public function index(Request $request)
    {
        $query = Familia::query(); // inicia query dinâmica
    
        // Se a busca for preenchida, filtra por descrição
        if ($request->filled('busca')) {
            $query->where('descricao', 'like', '%' . $request->busca . '%');
        }
    
        $familias = $query->orderBy('descricao')->get(); // carrega ordenado
    
        $cores = Cor::orderBy('cor_desc')->get();
        $familia = null;
    
        // Preenchimento automático se veio de um veículo
        if ($request->has('from')) {
            $veiculo = Veiculo::find($request->input('from'));
            if ($veiculo && $veiculo->familia) {
                $familia = Familia::where('descricao', $veiculo->familia)->first();
            }
        }
    
        return view('familia.index', compact('familias', 'cores', 'familia'));
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

        // Salvar Arquivo MEV
        if ($request->hasFile('arquivo_mev')) {
            $extensao = $request->file('arquivo_mev')->getClientOriginalExtension();
            $nomeArquivoMev = str_replace(' ', '_', $request->descricao) . '.' . $extensao;
            $request->file('arquivo_mev')->move(public_path('mev'), $nomeArquivoMev);
        }

        // Salvar Documento Adicional
        if ($request->hasFile('documentos')) {
            $extensao = $request->file('documentos')->getClientOriginalExtension();
            $nomeArquivoDoc = str_replace(' ', '_', $request->descricao) . '.' . $extensao;
            $request->file('documentos')->move(public_path('docs'), $nomeArquivoDoc);
        }

        return redirect()->route('familia.index')->with('success', 'Família cadastrada com sucesso!');
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'site' => 'required|string|max:255',
            'imagem' => 'nullable|image|mimes:jpg,jpeg|max:2048',
            'arquivo_mev' => 'nullable|mimes:pdf|max:5120',
            'documentos' => 'nullable|file|max:5120',
        ]);

        $familia = Familia::findOrFail($id);

        // Caminhos para imagem antiga
        $nomeAntigo = str_replace(' ', '_', $familia->descricao) . '.jpg';
        $caminhoAntigo = public_path('images/familia/' . $nomeAntigo);

        // Atualiza os dados no banco
        $descricaoOriginal = $familia->getOriginal('descricao');
        $familia->descricao = $request->descricao;
        $familia->site = $request->site;
        $familia->save();

        // Substituição da imagem
        if ($request->hasFile('imagem')) {
            if (file_exists($caminhoAntigo)) {
                unlink($caminhoAntigo);
            }

            $extensao = $request->file('imagem')->getClientOriginalExtension();
            $novoNome = str_replace(' ', '_', $request->descricao) . '.' . $extensao;

            $request->file('imagem')->move(public_path('images/familia'), $novoNome);
        } else {
            // Se apenas renomeou
            if ($request->descricao !== $descricaoOriginal && file_exists($caminhoAntigo)) {
                $novoNome = str_replace(' ', '_', $request->descricao) . '.jpg';
                rename($caminhoAntigo, public_path('images/familia/' . $novoNome));
            }
        }

        // Upload do arquivo MEV
        if ($request->hasFile('arquivo_mev')) {
            $extensao = $request->file('arquivo_mev')->getClientOriginalExtension();
            $nomeArquivoMev = str_replace(' ', '_', $request->descricao) . '.' . $extensao;
            $request->file('arquivo_mev')->move(public_path('mev'), $nomeArquivoMev);
        }

        // Upload do documento adicional
        if ($request->hasFile('documentos')) {
            $extensao = $request->file('documentos')->getClientOriginalExtension();
            $nomeArquivoDoc = str_replace(' ', '_', $request->descricao) . '.' . $extensao;
            $request->file('documentos')->move(public_path('docs'), $nomeArquivoDoc);
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

    public function upload(Request $request, $tipo)
    {
        $arquivo = $request->file('arquivo');

        if ($arquivo) {
            $nomeArquivo = match ($tipo) {
                'imagem' => 'imagem_' . time() . '.' . $arquivo->getClientOriginalExtension(),
                'mev' => 'mev_' . time() . '.' . $arquivo->getClientOriginalExtension(),
                'documentos' => 'doc_' . time() . '.' . $arquivo->getClientOriginalExtension(),
                default => 'arquivo_' . time() . '.' . $arquivo->getClientOriginalExtension(),
            };

            $arquivo->move(public_path('uploads/familia'), $nomeArquivo);

            return back()->with('success', 'Arquivo enviado com sucesso!');
        }

        return back()->with('error', 'Nenhum arquivo selecionado.');
    }

    public function excluirArquivoSimples(Request $request)
{
    $arquivo = $request->input('arquivo');
    $caminho = public_path('docs/' . $arquivo);

    if (file_exists($caminho)) {
        unlink($caminho);
        return back()->with('success', 'Arquivo removido com sucesso!');
    }

    return back()->with('error', 'Arquivo não encontrado.');
}


}
