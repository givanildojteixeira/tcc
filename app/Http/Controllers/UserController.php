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

    public function index(Request $request)
    {
        $query = DB::table('users')->orderBy('name');

        // Filtro por texto (nome ou email)
        if ($request->filled('busca')) {
            $busca = $request->input('busca');
            $query->where(function ($q) use ($busca) {
                $q->where('name', 'like', "%{$busca}%")
                    ->orWhere('email', 'like', "%{$busca}%");
            });
        }

        // Filtro por nível de usuário
        if ($request->filled('nivel')) {
            $query->where('level', $request->input('nivel'));
        }

        // Paginação com filtros preservados
        $users = $query->paginate(15)->appends($request->only(['busca', 'nivel']));

        return view('users.index', compact('users'));
    }



    public function edit($id)
    {
        return view('users.edit', [
            'user' => User::findOrfail($id)
        ]);
    }

    public function update(Request $id)
    {
        User::findOrfail($id->id)->update($id->all());
        return redirect()->route('user.index');
    }

    public function ativo($id, $ativo)
    {
        $user = User::findOrFail($id);
        $user->active = filter_var($ativo, FILTER_VALIDATE_BOOLEAN);
        $user->save();

        return redirect()->route('user.index')->with('success', 'Status do usuário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Usuário removido com sucesso.');
    }
}
