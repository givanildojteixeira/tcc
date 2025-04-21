<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Trata sobre a autenticação de um usuario, 
     * ele ja existe e agora vai entrar no sistema.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->level === 'user') {
            return redirect()->route('aguarde.validacao');
        }

        // Redirecionamento com base no nível
        switch ($user->level) {
            case 'Assistente':
                return redirect()->route('financeiro.index');


            case 'Vendedor':
                return redirect()->route('veiculos.novos.index');

            case 'user':
                return redirect()->route('veiculos.novos.index');


            default:
                return redirect()->route('dashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
