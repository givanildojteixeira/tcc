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
Route::get('/veiculos/buscar-chassi/{chassi}', function ($chassi) {
    return Veiculo::where('chassi', 'like', '%' . $chassi . '%')
        ->where('novo_usado', 'Novo')
        ->limit(5)
        ->get(); // agora retorna uma lista
});

Route::get('/clientes/buscar/{query}', function ($query) {
    return Cliente::where('nome', 'like', "%{$query}%")
        ->orWhere('cpf_cnpj', 'like', "%{$query}%")
        ->limit(10)
        ->get();
});
Route::get('/veiculos-usados/buscar-chassi/{chassi}', function ($chassi) {
    return Veiculo::where('chassi', $chassi)
        ->where('novo_usado', 'Usado')
        ->firstOrFail();
});
Route::get('/veiculos/{id}', function ($id) {
    return Veiculo::findOrFail($id);
});