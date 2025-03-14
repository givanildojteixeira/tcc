<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsadosController extends Controller
{
    //
    public function index()
    {
        return view('veiculos.usados.index');
    }
}
