<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    // Cadastro de uma nova empresa
    public function cadastrarEmpresa(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'email' => 'required|email|unique:empresas,email',
            'telefone' => 'required|string',
            'cnpj' => 'required|string|unique:empresas,cnpj',
            'metodos_pagamento' => 'required|string'
        ]);

        $empresa = Empresa::create($request->all());
        
        
        return response()->json(['message' => 'Empresa cadastrada com sucesso!', 'empresa' => $empresa], 201);
    }

    public function atualizarEmpresa(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);

        $request->validate([
            'nome' => 'string|max:255',
            'endereco' => 'string|max:255',
            'email' => 'email|unique:empresas,email,' . $id,
            'telefone' => 'string',
            'cnpj' => 'string|unique:empresas,cnpj,' . $id,
            'metodos_pagamento' => 'string'
        ]);

        $empresa->update($request->all());
        
        return response()->json(['message' => 'Empresa atualizada com sucesso!', 'empresa' => $empresa], 200);
    }

    public function deletarEmpresa($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();

        return response()->json(['message' => 'Empresa deletada com sucesso!'], 200);
    }


    public function listarEmpresas(Request $request)
    {
        $empresas = Empresa::query();

        if ($request->has('filtro')) {
            $empresas->where('nome', 'like', '%' . $request->filtro . '%');
        }

        return response()->json(['empresas' => $empresas->get()], 200);
    }

    public function visualizarEmpresa($id)
    {
        $empresa = Empresa::findOrFail($id);
        
        return response()->json(['empresa' => $empresa], 200);
    }
}
