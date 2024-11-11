<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            'senha' => 'required|string|min:3|confirmed',
        ]);

        // Criar e salvar a nova empresa
        $empresa = Empresa::create([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'senha' => Hash::make($request->senha),
        ]);

        // Redirecionar para a página de gerenciamento e criação de cardápios
        return redirect()->route('cardapio.manage_and_create', ['empresaId' => $empresa->id_empresa])->with('success', 'Empresa cadastrada com sucesso!');
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

          return redirect()->route('cardapio.manage_and_create', ['empresaId' => $empresa->id_empresa])->with('success', 'Logged in');
    }

    public function destroy()
  {
    Auth::logout();

    return redirect()->route('empresa.login');
  }
}
