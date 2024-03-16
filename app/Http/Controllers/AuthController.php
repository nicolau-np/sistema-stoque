<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $title = 'Iniciar Sessão';
        $menu = 'Login';
        $type = 'login';

        return view('auth.login', compact('title', 'menu', 'type'));
    }

    public function logar(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|exists:users,username',
            'password' => 'required|string',
        ], [], [
            'username' => 'Nome de Usuário',
            'password' => 'Palavra-Passe',
        ]);

        if (Auth::attempt($request->only('username', 'password')))
            return redirect()->route('home');

        return back()->with('error', 'Palavra-Passe Incorrecta');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
