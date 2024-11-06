<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

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
            'nome' => 'required',
            'cnpj' => 'required|unique:empresas',
            'email' => 'required|email',
            'telefone' => 'required',
            'endereco' => 'required',
            'senha' => 'required|min:6|confirmed',
        ]);

        // Criar e salvar a nova empresa
        Empresa::create([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'senha' => bcrypt($request->senha),
        ]);

        // Redirecionar ou retornar uma resposta
        return redirect()->route('empresa.cadastro')->with('status', 'Empresa cadastrada com sucesso!');
    }
}
