<?php

namespace App\Http\Controllers;

use App\Models\Opcionais;
use Illuminate\Http\Request;

class OpcionaisController extends Controller
{
    public function index()
    {
        $opcionais = Opcionais::all();
        return view('opcionais.index', compact('opcionais'));
    }

    public function create()
    {
        return view('opcionais.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo_fab' => 'required',
            'cod_opcional' => 'required',
            'descricao' => 'required',
        ]);

        Opcionais::create($request->all());

        return redirect()->route('opcionais.index')->with('success', 'Opcional criado com sucesso.');
    }

    public function edit(Opcionais $opcional)
    {
        return view('opcionais.edit', compact('opcional'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'modelo_fab' => 'required',
            'cod_opcional' => 'required',
            'descricao' => 'required',
        ]);

        $opcional = Opcionais::findOrFail($id);
        $opcional->update($request->all());

        return redirect()->route('opcionais.index')->with('success', 'Opcional atualizado com sucesso.');
    }


    public function destroy($id)
    {
        $opcional = Opcionais::findOrFail($id);
        $opcional->delete();

        return redirect()->route('opcionais.index')->with('success', 'Opcional removido com sucesso.');
    }

}
