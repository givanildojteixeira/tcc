<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $clientes = Cliente::when($busca, function ($query, $busca) {
            $query->where('nome', 'like', "%$busca%")
                ->orWhere('email', 'like', "%$busca%")
                ->orWhere('cpf_cnpj', 'like', "%$busca%");
        })
            ->orderBy('nome')
            ->paginate(15);

        return view('clientes.index', compact('clientes'));
    }

    public function store(Request $request)
    {
        // DEBUG (veja se cpf ou cnpj estão chegando corretamente)
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'tipo_pessoa' => 'required|in:Física,Jurídica',

            // VALIDANDO SEPARADAMENTE
            'cpf' => 'nullable|required_if:tipo_pessoa,Física|string|max:20',
            'cnpj' => 'nullable|required_if:tipo_pessoa,Jurídica|string|max:20',

            'email' => 'nullable|email|max:255',
            'celular' => 'nullable|string|max:20',
            'telefone' => 'nullable|string|max:20',
            'telefone_comercial' => 'nullable|string|max:20',
            'cep' => 'nullable|string|max:9',
            'endereco' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:2',
            'sexo' => 'nullable|in:M,F,Outro,Não Informado',
            'estado_civil' => 'nullable|string|max:50',
            'data_nascimento' => 'nullable|date',
            'data_fundacao' => 'nullable|date',
            'razao_social' => 'nullable|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'inscricao_estadual' => 'nullable|string|max:50',
            'inscricao_municipal' => 'nullable|string|max:50',
            'observacoes' => 'nullable|string',
            'ativo' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $validator->errors()->all()))
                ->with('abrirModalCreate', true);
        }

        $dados = $validator->validated();

        // MONTA CPF_CNPJ (usa o que estiver preenchido)
        $dados['cpf_cnpj'] = $request->input('cpf') ?: $request->input('cnpj');

        // Validação extra: CPF_CNPJ precisa ser único na tabela clientes
        if (Cliente::where('cpf_cnpj', $dados['cpf_cnpj'])->exists()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Já existe um cliente com esse CPF ou CNPJ!')
                ->with('abrirModalCreate', true);
        }

        // Completa com dados extras
        $dados['ativo'] = $request->has('ativo') ? 1 : 0;
        $dados['user_id'] = auth()->id();

        Cliente::create($dados);

        // Se veio da proposta, salva na sessão e volta para ela
        if ($request->filled('voltar_para_proposta')) {
            session()->flash('cliente_id', $cliente->id); // usado para carregar automaticamente
            session()->flash('aba', 'cliente'); // se quiser controlar qual aba abrir

            return redirect()->route('propostas.create')->with('success', 'Cliente cadastrado com sucesso!');
        }

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }


    public function update(Request $request, Cliente $cliente)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'tipo_pessoa' => 'required|in:Física,Jurídica',
            'cpf_cnpj' => 'required|string|max:20|unique:clientes,cpf_cnpj,' . $cliente->id,
            'email' => 'nullable|email|max:255',
            'celular' => 'nullable|string|max:20',
            'telefone' => 'nullable|string|max:20',
            'telefone_comercial' => 'nullable|string|max:20',
            'cep' => 'nullable|string|max:9',
            'endereco' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:2',
            'sexo' => 'required|in:M,F,Outro,Não Informado',
            'estado_civil' => 'required|string|max:50',
            'data_nascimento' => 'required|date',
            'data_fundacao' => 'nullable|date',
            'razao_social' => 'nullable|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'inscricao_estadual' => 'nullable|string|max:50',
            'inscricao_municipal' => 'nullable|string|max:50',
            'observacoes' => 'nullable|string',
            'ativo' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $validator->errors()->all()))
                ->with('abrirModalEdit', true)
                ->with('editData', $cliente->only([
                    'id',
                    'nome',
                    'tipo_pessoa',
                    'cpf_cnpj',
                    'email',
                    'celular',
                    'telefone',
                    'telefone_comercial',
                    'cep',
                    'endereco',
                    'numero',
                    'complemento',
                    'bairro',
                    'cidade',
                    'uf',
                    'sexo',
                    'estado_civil',
                    'data_nascimento',
                    'data_fundacao',
                    'razao_social',
                    'nome_fantasia',
                    'inscricao_estadual',
                    'inscricao_municipal',
                    'observacoes',
                    'ativo'
                ]));
        }

        $dados = $validator->validated();
        $dados['ativo'] = $request->has('ativo');

        $cliente->update($dados);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }


    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }
}
