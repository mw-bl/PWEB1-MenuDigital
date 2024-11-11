<?php

namespace App\Http\Controllers;

use App\Models\ItensCardapio;
use App\Models\Cardapio;
use Illuminate\Http\Request;

class ItensCardapioController extends Controller
{
    public function index()
    {
        $itens = ItensCardapio::all();
        return response()->json($itens);
    }

    public function store(Request $request)
{
    // Validação
    $request->validate([
        'descricao' => 'required|string|max:500',
        'link_imagem' => 'required|image|mimes:jpeg,png,jpg|max:10000',
        'nome_produto.*' => 'required|string|max:500',
        'descricao_produto.*' => 'required|string|max:500',
        'preco.*' => 'required|numeric',
        'link_imagem_itens.*' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
    ]);

    // Criação do Cardápio
    $imagePath = $request->file('link_imagem')->store('cardapios', 'public');
    $cardapio = Cardapio::create([
        'descricao' => $request->descricao,
        'imagem' => $imagePath,
    ]);

    // Criação dos Itens do Cardápio
    foreach ($request->nome_produto as $index => $nomeProduto) {
        // Criação da imagem do produto, se houver
        $itemImagePath = null;
        if ($request->hasFile('link_imagem_itens') && isset($request->link_imagem_itens[$index])) {
            $itemImagePath = $request->file('link_imagem_itens')[$index]->store('itens_cardapio', 'public');
        }

        // Criação de cada item
        ItensCardapio::create([
            'nome_produto' => $nomeProduto,
            'descricao' => $request->descricao_produto[$index],
            'preco' => $request->preco[$index],
            'imagem' => $itemImagePath,
            'fk_Cardapio_id_cardapio' => $cardapio->id_cardapio,
        ]);
    }

    return response()->json(['success' => true, 'message' => 'Cardápio e itens criados com sucesso.']);
}


    public function show($id)
    {
        $item = ItensCardapio::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = ItensCardapio::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        ItensCardapio::destroy($id);
        return response()->json(['message' => 'Item deletado com sucesso']);
    }
}