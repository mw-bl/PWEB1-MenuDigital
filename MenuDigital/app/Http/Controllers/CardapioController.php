<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cardapio;

class CardapioController extends Controller
{
    
    public function cadastrarProduto(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'imagem' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'empresa_id' => 'required|exists:empresas,id'
        ]);

        $produto = Cardapio::create($request->all());

        return response()->json(['message' => 'Produto adicionado ao cardápio com sucesso!', 'produto' => $produto], 201);
    }


    public function atualizarProduto(Request $request, $id)
    {
        $produto = Cardapio::findOrFail($id);

        $request->validate([
            'nome' => 'string|max:255',
            'descricao' => 'string',
            'preco' => 'numeric',
            'imagem' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $produto->update($request->all());

        return response()->json(['message' => 'Produto atualizado com sucesso!', 'produto' => $produto], 200);
    }

    
    public function listarProdutos($empresa_id)
    {
        $produtos = Cardapio::where('empresa_id', $empresa_id)->get();

        return response()->json(['produtos' => $produtos], 200);
    }

    
    public function deletarProduto($id)
    {
        $produto = Cardapio::findOrFail($id);
        $produto->delete();

        return response()->json(['message' => 'Produto removido do cardápio com sucesso!'], 200);
    }
}

