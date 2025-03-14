<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelatoriosController extends Controller
{
    //
    public function index()
    {
        return view('relatorios.index');
    }
}
