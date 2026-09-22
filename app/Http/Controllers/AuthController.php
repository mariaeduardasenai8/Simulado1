<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  
    public function showLogin()
    {
       return view('login');


    }

    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'senha' => 'required|string',
        ]);

       
        $usuario = Usuario::where('login', $credentials['login'])->first();

       
        if ($usuario && $usuario->senha === $credentials['senha']) {
            
            Auth::login($usuario);
            $request->session()->regenerate();

            return redirect()->route('estoque.index');
        }

        return back()->withErrors([
            'login' => 'As credenciais fornecidas não constam em nossos registros.',
        ]);
    }

    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
