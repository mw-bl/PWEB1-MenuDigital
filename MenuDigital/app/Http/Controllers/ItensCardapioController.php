<?php

namespace App\Http\Controllers;

use App\Models\ItensCardapio;
use App\Models\Cardapio;
use Illuminate\Http\Request;
use App\Models\Empresa;

class ItensCardapioController extends Controller
{
    public function create($empresaId, $cardapioId)
    {
        $cardapio = Cardapio::findOrFail($cardapioId);
        return view('itens.create', compact('cardapio', 'empresaId'));
    }

    // Método para armazenar o novo item
    public function store(Request $request, $empresaId, $cardapioId)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
        ]);

        $cardapio = Cardapio::findOrFail($cardapioId);

        $item = new ItensCardapio();
        $item->nome = $request->nome;
        $item->preco = $request->preco;
        $item->cardapio_id = $cardapio->id_cardapio;
        $item->save();

        return redirect()->route('cardapio.itens', ['empresaId' => $empresaId, 'cardapioId' => $cardapioId])
                         ->with('success', 'Item criado com sucesso!');
    }

    // Método para editar um item
    public function edit($empresaId, $cardapioId, $itemId)
{
    $item = ItensCardapio::findOrFail($itemId);
    return view('itens.edit', compact('item', 'empresaId', 'cardapioId'));
}

    // Método para atualizar um item
    public function update(Request $request, $empresaId, $cardapioId, $itemId)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
        ]);

        $item = ItensCardapio::findOrFail($itemId);
        $item->nome = $request->nome;
        $item->preco = $request->preco;
        $item->save();

        return redirect()->route('cardapio.itens', ['empresaId' => $empresaId, 'cardapioId' => $cardapioId])
                         ->with('success', 'Item atualizado com sucesso!');
    }

    // Método para excluir um item
    public function destroy($empresaId, $cardapioId, $itemId)
    {
        $item = ItensCardapio::findOrFail($itemId);
        $item->delete();

        return redirect()->route('cardapio.itens', ['empresaId' => $empresaId, 'cardapioId' => $cardapioId])
                         ->with('success', 'Item excluído com sucesso!');
    }

    

    public function index($empresaId)
    {
    $empresa = Empresa::findOrFail($empresaId);
    
    // Buscar todos os cardápios da empresa com os itens relacionados
    $cardapios = $empresa->cardapios()->with('itens')->get();

    return view('cardapios.index', compact('cardapios', 'empresaId'));
}

public function showItens($empresaId, $cardapioId)
{
    $cardapio = Cardapio::with('itens')->findOrFail($cardapioId);

    return view('itens.index', compact('cardapio', 'empresaId'));
}

}
