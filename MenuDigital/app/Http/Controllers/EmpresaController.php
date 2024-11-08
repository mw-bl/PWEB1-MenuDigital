<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{
    // Método para exibir o formulário de cadastro
    public function cadastro()
    {
        return view('empresa.cadastro');
    }

    // Método para armazenar a empresa no banco
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14|unique:empresas',
            'email' => 'required|email|max:255|unique:empresas',
            'telefone' => 'required|string|max:15',
            'endereco' => 'required|string|max:255',
            'senha' => 'required|string|min:8|confirmed',
        ]);

        // Criar e salvar a nova empresa
        Empresa::create([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'senha' => Hash::make($request->senha),
        ]);

        // Redirecionar ou retornar uma resposta
        return redirect()->route('empresa.cadastro')->with('status', 'Empresa cadastrada com sucesso!');
    }

    // Método para exibir o formulário de login
    public function loginForm()
    {
        return view('empresa.login');
    }

    // Método para autenticar a empresa
    public function login(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        // Tentativa de autenticação
        if (Auth::attempt(['email' => $request->email, 'password' => $request->senha])) {
            // Autenticação bem-sucedida
            return redirect()->intended('dashboard');
        }

        // Autenticação falhou
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }

    
}