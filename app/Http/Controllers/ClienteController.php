<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clientes.index',[
            'clientes'=> Cliente::orderBy('nome')->paginate('20')
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
        $cliente->user_id        = $request->user_id;
        $cliente->nome        = $request->nome;
        $cliente->email        = $request->email;
        $cliente->telefone        = $request->telefone;
        $cliente->telefonecom        = $request->telefonecom;
        $cliente->endereco        = $request->endereco;
        $cliente->bairro        = $request->bairro;
        $cliente->cidade        = $request->cidade;
        $cliente->uf        = $request->uf;
        $cliente->sexo        = $request->sexo;

        $cliente->save();
        return redirect()->route(route:'cliente.create')->with('msg','Cliente cadastrado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
