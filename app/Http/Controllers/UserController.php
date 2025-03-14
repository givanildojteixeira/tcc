<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // restringir o acesso de controle
    public function __construct()
    {
        $this->middleware('can:level')->only('edit');  // oque nao pode acesar
    }

    public function index()
    {
        return view('users.index',[
            'users' => DB::table('users')->orderBy('name')->paginate('20')
        ]);
    }

    public function edit($id)
    {
        return view('users.edit',[
            'user'=>User::findOrfail($id)
        ]);
    }

    public function update(Request $id)
    {
        User::findOrfail($id->id)->update($id->all());
        return redirect()->route('user.index');
    }

}
