<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\Auth;


class ClienteController extends Controller
{

    // Criando restrição para quem pode acessar o metodo index
    public function __construct()
    {
        $this->middleware(middleware: 'can:level')->only(methods: 'index');
    }

    public function clientes_to_user(User $id)
    {
        $user = User::where('id', $id->id)->first();
        $clientes = $user->customers()->get();

        return view('clientes.clientes_to_user', [
            'clientes' => $clientes
        ]);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clientes.index', [
            'clientes' => Cliente::orderBy('nome')->paginate('20')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->user_id      = $request->user_id;
        $cliente->nome         = $request->nome;
        $cliente->email        = $request->email;
        $cliente->telefone     = $request->telefone;
        $cliente->telefonecom  = $request->telefonecom;
        $cliente->endereco     = $request->endereco;
        $cliente->bairro       = $request->bairro;
        $cliente->cidade       = $request->cidade;
        $cliente->uf           = $request->uf;
        $cliente->sexo         = $request->sexo;

        $cliente->save();
        return redirect()->route(route: 'cliente.create')->with('msg', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        Cliente::findOrFail($cliente->id)->update($request->all());
        return redirect()->route('cliente.show', $cliente->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        Cliente::findOrFail($cliente->id)->delete();
        return redirect()->route('meus-clientes', Auth::user()->id);
    }

    public function confirma_delete(Cliente $id)
    {
        return view('clientes.confirma_delete',['id' => $id]);
    }
}
