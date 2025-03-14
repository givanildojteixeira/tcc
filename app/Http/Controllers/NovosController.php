<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NovosController extends Controller
{
    //
    public function index()
    {
        return view('veiculos.novos.index');
    }
}
