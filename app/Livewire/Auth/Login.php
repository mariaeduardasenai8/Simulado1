<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    public function login(){
       $credentials = $this->validate([
        'email'=>['required', 'email'],
        'password'=> [ 'required'],
       ], [

        'email.required'=>'O email é obrigatorio',
        'email.email'=> 'Formato de email incorreto',
        'password.required'=>'Senha obrigatoria'
       ]);

       if(!Auth::attempt($credentials, $this->remember)){
        session()->flash('error', 'email e senha invalidos');
       }
       $user = Auth::user();
        

       if(!$user()){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        session()->flash('error', 'nao autorizado');
       }
       request()->session()->regenerate();

       return redirect()->route('dashboard');
    }

    public function render()
    {

        return view('livewire.auth.login');
    }
}