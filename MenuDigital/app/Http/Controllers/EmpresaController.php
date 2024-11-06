<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return response()->json($empresas);
    }

    public function store(Request $request)
    {
        $empresa = Empresa::create($request->all());
        return response()->json($empresa, 201);
    }

    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);
        return response()->json($empresa);
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->update($request->all());
        return response()->json($empresa);
    }

    public function destroy($id)
    {
        Empresa::destroy($id);
        return response()->json(['message' => 'Empresa deletada com sucesso']);
    }
}

