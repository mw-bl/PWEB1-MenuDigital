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

        // Procurar a empresa pelo email
        $empresa = Empresa::where('email', $request->email)->first();

        // Verificar se a empresa existe e a senha está correta
        if ($empresa && Hash::check($request->senha, $empresa->senha)) {
            // Login bem-sucedido, armazenar a empresa na sessão
            Auth::login($empresa);

            // Redirecionar para a página desejada após o login
            return redirect()->route('dashboard')->with('status', 'Login realizado com sucesso!');
        }

        // Redirecionar de volta com erro se falhar
        return back()->with('error', 'Credenciais inválidas');
    }
}
