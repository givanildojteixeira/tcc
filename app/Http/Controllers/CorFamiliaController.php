<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Familia;
use App\Models\Cor;
use Illuminate\Support\Facades\DB;

class CorFamiliaController extends Controller
{

   public function relacionar(Request $request)
    {
        // dd($request->all());

        if (!$request->filled('familia_id')) {
            return back()->with('error', 'Selecione uma família antes de relacionar as cores.');
        }

        $request->validate([
            'familia_id' => 'required|exists:familias,id',
            'cores' => 'array',
            'cores.*' => 'exists:cores,id',
        ]);


        DB::table('cor_familia')->where('familia_id', $request->familia_id)->delete();

        foreach ($request->cores ?? [] as $corId) {
            DB::table('cor_familia')->insert([
                'familia_id' => $request->familia_id,
                'cor_id' => $corId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Cores relacionadas com sucesso!');
    }
}
