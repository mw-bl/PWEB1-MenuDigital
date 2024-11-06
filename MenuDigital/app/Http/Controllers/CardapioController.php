<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public function index()
    {
        $cardapios = Cardapio::all();
        return view('cardapio.index', compact('cardapios'));
    }

    public function create()
    {
        return view('cardapio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:500',
            'link_imagem' => 'required|url',
            'fk_Empresa_id_empresa' => 'required|integer|exists:empresas,id_empresa'
        ]);

        Cardapio::create($request->all());
        return redirect()->route('cardapio.index')->with('success', 'Cardápio criado com sucesso.');
    }

    public function show($id)
    {
        $cardapio = Cardapio::findOrFail($id);
        return view('cardapio.show', compact('cardapio'));
    }

    public function edit($id)
    {
        $cardapio = Cardapio::findOrFail($id);
        return view('cardapio.edit', compact('cardapio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descricao' => 'required|string|max:500',
            'link_imagem' => 'required|url',
            'fk_Empresa_id_empresa' => 'required|integer|exists:empresas,id_empresa'
        ]);

        $cardapio = Cardapio::findOrFail($id);
        $cardapio->update($request->all());
        return redirect()->route('cardapio.index')->with('success', 'Cardápio atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $cardapio = Cardapio::findOrFail($id);
        $cardapio->delete();
        return redirect()->route('cardapio.index')->with('success', 'Cardápio deletado com sucesso.');
    }
}

