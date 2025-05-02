<?php

use App\Models\Cliente;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/veiculos/buscar-chassi/{query}', function ($query) {
    return Veiculo::where(function ($q) use ($query) {
        $q->where('chassi', 'like', "%{$query}%")
            ->orWhere('desc_veiculo', 'like', "%{$query}%")
            ->orWhere('placa', 'like', "%{$query}%");
    })
        ->where('novo_usado', 'Novo')
        ->get();
});

Route::get('/clientes/buscar/{query}', function ($query) {
    return Cliente::where('nome', 'like', "%{$query}%")
        ->orWhere('cpf_cnpj', 'like', "%{$query}%")
        ->limit(10)
        ->get();
});

Route::get('/veiculos-usados/buscar-chassi/{query}', function ($query) {
    return Veiculo::where(function ($q) use ($query) {
        $q->where('chassi', 'like', "%{$query}%")
            ->orWhere('desc_veiculo', 'like', "%{$query}%")
            ->orWhere('placa', 'like', "%{$query}%");
    })
        ->where('novo_usado', 'Usado')
        ->get();
});






Route::get('/veiculos/{id}', function ($id) {
    return Veiculo::findOrFail($id);
});


//novas apis
Route::get('/clientes/{id}', function ($id) {
    return Cliente::findOrFail($id);
});
