<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use Illuminate\Http\Request;

class CorController extends Controller
{
    public function index(Request $request)
    {
        $query = Cor::query();
    
        if ($request->filled('busca')) {
            $query->where('cor_desc', 'like', '%' . $request->busca . '%');
        }
    
        $cores = $query->orderBy('cor_desc')->paginate(10); // ou qualquer número desejado
    
        return view('cores.index', compact('cores'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'cor_desc' => 'required|string|max:50'
        ]);

        Cor::create($request->all());
        return redirect()->route('cores.index')->with('success', 'Cor cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $cores = Cor::all();
        $cor = Cor::findOrFail($id);
        return view('cores.index', compact('cores', 'cor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cor_desc' => 'required|string|max:50'
        ]);

        $cor = Cor::findOrFail($id);
        $cor->update($request->all());

        return redirect()->route('cores.index')->with('success', 'Cor atualizada com sucesso!');
    }

    public function destroy($id)
    {
        Cor::destroy($id);
        return redirect()->route('cores.index')->with('success', 'Cor excluída com sucesso!');
    }
}
