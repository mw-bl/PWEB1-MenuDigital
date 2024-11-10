<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EmpresaController extends Controller
{
    public function cadastro()
    {
        return view('empresa.cadastro');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14|unique:empresas',
            'email' => 'required|email|max:255|unique:empresas',
            'telefone' => 'required|string|max:15',
            'endereco' => 'required|string|max:255',
            'senha' => 'required|string|min:3|confirmed',
        ]);

        Empresa::create([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'senha' => Hash::make($request->senha),
        ]);

        return redirect()->route('cardapio.manageAndCreate')->with('success', 'Empresa cadastrada com sucesso!');
    }

    public function loginForm()
    {
        return view('empresa.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ], [
            'email.required' => 'Esse campo de email é obrigatório',
            'email.email' => 'Esse campo tem que ter um email válido',
            'password.required' => 'Esse campo password é obrigatório',
            // 'password.min' => 'Esse campo tem que ter no mínimo :min caracteres'
          ]);

          $empresa = Empresa::where('email', $request->input('email'))->first();

          if (!$empresa) {
            return redirect()->route('empresa.login')->withErrors(['error' => 'Email or password invalid']);
          }

          if (!Hash::check($request->input('senha'), $empresa->senha)) {
            return redirect()->route('empresa.login')->withErrors(['error' => 'Email or password invalid']);
          }

          Auth::loginUsingId($empresa->id_empresa);

          return redirect()->route('cardapio.manageAndCreate')->with('success', 'Logged in');
    }

    public function destroy()
  {
    Auth::logout();

    return redirect()->route('empresa.login');
  }
}
