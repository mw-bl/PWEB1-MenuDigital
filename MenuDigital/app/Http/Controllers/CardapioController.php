<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\ItensCardapio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CardapioController extends Controller
{
    // Exibe a página combinada de gerenciamento e criação de cardápios
    public function manageAndCreate()
    {
        $empresaId = Auth::user()->id; // Assumindo que a empresa está logada
        $cardapios = Cardapio::where('fk_Empresa_id_empresa', $empresaId)->get();
        
        return view('cardapio.manage_and_create', compact('cardapios'));
    }

    // Armazena o novo cardápio e seus itens
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:500',
            'link_imagem' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nome_produto.*' => 'required|string|max:500',
            'descricao_produto.*' => 'required|string|max:500',
            'preco.*' => 'required|numeric',
            'link_imagem_itens.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $empresaId = Auth::user()->id;

        // Upload da imagem do cardápio
        $imagePath = $request->file('link_imagem')->store('cardapios', 'public');

        // Cria o cardápio
        $cardapio = Cardapio::create([
            'descricao' => $request->descricao,
            'link_imagem' => $imagePath,
            'fk_Empresa_id_empresa' => $empresaId,
        ]);

        // Cria os itens do cardápio
        foreach ($request->nome_produto as $index => $nomeProduto) {
            $itemImagePath = $request->file('link_imagem_itens')[$index]->store('itens_cardapio', 'public');
            ItensCardapio::create([
                'nome_produto' => $nomeProduto,
                'descricao' => $request->descricao_produto[$index],
                'preco' => $request->preco[$index],
                'link_imagem_itens' => $itemImagePath,
                'fk_Cardapio_id_cardapio' => $cardapio->id_cardapio,
            ]);
        }

        return redirect()->route('cardapio.manageAndCreate')->with('success', 'Cardápio e itens criados com sucesso.');
    }
}