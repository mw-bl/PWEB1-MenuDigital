<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\ItensCardapio;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;



use function Laravel\Prompts\search;

class CardapioController extends Controller
{
    // Método para exibir a página principal com a pesquisa
    /*public function index(Request $request)
    {
       
            $search = $request->input('search');
            
            if ($search) {
                $empresas = Empresa::where('nome', 'LIKE', '%' . $search . '%')->get();
                $cardapios = Cardapio::whereIn('fk_Empresa_id_empresa', $empresas->pluck('id_empresa'))->with('itens')->get();

                if ($cardapios->isEmpty()) {
                    return redirect()->route('paginaPrincipal')->with('error', 'Nenhum cardápio encontrado para a pesquisa: ' . $search);
                } else {
                    return view('paginaPrincipal', compact('cardapios', 'search'))->with('success', 'Pesquisa realizada com sucesso.');
                }
            } else {
                $cardapios = Cardapio::with('itens')->get();
                return view('paginaPrincipal', compact('cardapios', 'search'));
            }
       
    }*/

    public function getItens($id)
{
    $cardapio = Cardapio::with('itens')->find($id);
    
    

    if (!$cardapio) {
        return response()->json(['message' => 'Cardápio não encontrado.'], 404);
    }

    return response()->json(['itens' => $cardapio->itens]);
}



    
public function index()
{
    // Carrega os cardápios com os itens e as empresas associadas
    $cardapios = Cardapio::with(['empresa', 'itens'])->get();

    // Passa os dados para a view
    return view('welcome', compact('cardapios'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'descricao' => 'required|string|max:500',
        'imagem' => 'required|image|mimes:jpeg,png,jpg|max:10000',
        'nome_produto.*' => 'required|string|max:500',
        'descricao_produto.*' => 'required|string|max:500',
        'preco.*' => 'required|numeric',
        'imagem_itens.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $empresaId = Auth::user()->id_empresa;

    // Upload da imagem do cardápio
    $imagePath = $request->file('imagem')->store('cardapios', 'public');

    // Cria o cardápio
    $cardapio = Cardapio::create([
        'descricao' => $request->descricao,
        'imagem' => $imagePath,
        'fk_Empresa_id_empresa' => $empresaId,
    ]);

    // Cria os itens do cardápio
    if ($request->hasFile('imagem')) {
        foreach ($request->file('imagem') as $index => $file) {
            // Upload da imagem do item do cardápio
            $itemImagePath = $file->store('itens_cardapio', 'public');

            // Cria o item do cardápio
            ItensCardapio::create([
                'nome_produto' => $request->nome_produto[$index],
                'descricao' => $request->descricao_produto[$index],
                'preco' => $request->preco[$index],
                'imagem' => $itemImagePath,
                'fk_Cardapio_id_cardapio' => $cardapio->id_cardapio,
            ]);
        }
    }

    return redirect()->route('cardapio.manageAndCreate')->with('success', 'Cardápio e itens criados com sucesso.');
}




    // Método para exibir a página de gerenciamento e criação de cardápios
    public function manageAndCreate()
    {
        $empresaId = Auth::user()->id_empresa; // Assumindo que a empresa está logada
        $cardapios = Cardapio::where('fk_Empresa_id_empresa', $empresaId)->get();
        
        return view('cardapio.manage_and_create', compact('cardapios'));
    }

    // Método para exibir um cardápio específico
    public function show($id)
    {
        $cardapio = Cardapio::with('itens', 'empresa')->findOrFail($id);
        return view('cardapio.show', compact('cardapio'));
    }

    // Método para exibir o formulário de edição de um cardápio
    

    // Método para atualizar um cardápio
    public function update(Request $request, $id)
    {
        $request->validate([
            'descricao' => 'required|string|max:500',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $cardapio = Cardapio::findOrFail($id);
        $cardapio->descricao = $request->descricao;

        if ($request->hasFile('imagem')) {
            // Upload da nova imagem do cardápio
            $imagePath = $request->file('imagem')->store('cardapios', 'public');
            $cardapio->imagem = $imagePath;
        }

        $cardapio->save();

        return redirect()->route('cardapio.manageAndCreate')->with('success', 'Cardápio atualizado com sucesso.');
    }

// Método para excluir um cardápio

public function destroy($id)
    {
        $cardapio = Cardapio::findOrFail($id);
        $cardapio->delete();

        return redirect()->route('cardapio.manageAndCreate')->with('success', 'Cardápio excluído com sucesso.');
    }
    
    public function edit($id)
    {
        $cardapio = Cardapio::with('itens')->findOrFail($id);
        return view('edit', compact('cardapio'));
    }

    // Método para adicionar itens a um cardápio existente
    public function addItems(Request $request, $id)
    {
        $request->validate([
            'nome_produto.*' => 'required|string|max:500',
            'descricao_produto.*' => 'required|string|max:500',
            'preco.*' => 'required|numeric',
            'imagem.*' => 'required|image|mimes:jpeg,png,jpg|max:10000' // Corrigido o nome do campo
        ]);

        $cardapio = Cardapio::findOrFail($id);

        // Adiciona os itens ao cardápio
        if ($request->hasFile('imagem')) {
            foreach ($request->file('imagem') as $index => $file) {
                // Upload da imagem do item do cardápio
                $itemImagePath = $file->store('itens_cardapio', 'public');

                // Cria o item do cardápio
                ItensCardapio::create([
                    'nome_produto' => $request->nome_produto[$index],
                    'descricao' => $request->descricao_produto[$index],
                    'preco' => $request->preco[$index],
                    'imagem' => $itemImagePath,
                    'fk_Cardapio_id_cardapio' => $cardapio->id_cardapio,
                ]);
            }
        }

        return redirect()->route('cardapio.manageAndCreate', $id)->with('success', 'Itens adicionados com sucesso.');
    }
}