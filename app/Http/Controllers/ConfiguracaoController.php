<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracao; // ← aqui está o import

class ConfiguracaoController extends Controller
{
    public function salvar(Request $request)
    {
        Configuracao::updateOrCreate(
            ['chave' => $request->chave],
            ['valor' => $request->valor ? 'true' : 'false']
        );

        return response()->json(['success' => true]);
    }
}
