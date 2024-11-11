<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\ItensCardapio;

class CardapioController extends Controller
{
    // Método para exibir a página principal com todos os cardápios
    

    // Método para armazenar um novo cardápio
    public function store(Request $request)
    {
        $validated = $request->validate([
            'descricao' => 'required|string|max:500',
            'imagem' => 'required|image|mimes:jpeg,png,jpg|max:10000',
            'nome_produto.*' => 'required|string|max:500',
            'descricao_produto.*' => 'required|string|max:500',
            'preco.*' => 'required|numeric',
            'imagem_itens.*' => 'required|image|mimes:jpeg,png,jpg|max:10000'
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
        if ($request->hasFile('imagem_itens')) {
            foreach ($request->file('imagem_itens') as $index => $file) {
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

        return redirect()->route('cardapio.index')->with('success', 'Cardápio e itens criados com sucesso.');
    }

    // Método para exibir a página de gerenciamento e criação de cardápios
    public function manageAndCreate()
    {
        $empresaId = Auth::user()->id_empresa; // Assumindo que a empresa está logada
        $cardapios = Cardapio::where('fk_Empresa_id_empresa', $empresaId)->get();
        
        return redirect()->route('cardapio.manage_and_create', ['empresaId' => $empresaId]);

    }

    // Método para exibir um cardápio específico
    public function index()
{
    // Pega todos os cardápios
    $cardapios = Cardapio::with('itens', 'empresa')->get(); // Carrega também os itens e a empresa

    return view('welcome', compact('cardapios'));
}


    // Formulário de edição do cardápio
    public function edit($cardapioId)
    {
        // Encontra o cardápio
        $cardapio = Cardapio::findOrFail($cardapioId);

        return view('cardapio.edit', compact('cardapio'));
    }

    // Atualizar cardápio
    public function update(Request $request, $cardapioId)
    {
        // Validação dos dados
        $request->validate([
            'descricao' => 'required|string|max:500',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        // Atualizar o cardápio
        $cardapio = Cardapio::findOrFail($cardapioId);
        $cardapio->descricao = $request->descricao;

        if ($request->hasFile('imagem')) {
            $cardapio->imagem = $request->file('imagem')->store('cardapios', 'public');
        }

        $cardapio->save();

        return redirect()->route('cardapio.index', ['empresaId' => $cardapio->empresa_id])
                 ->with('success', 'Cardápio atualizado com sucesso!');

    }

    public function itens($empresaId, $cardapioId)
{
    // Obtenha os itens do cardápio. Supondo que você tenha uma relação entre Cardápio e Itens
    $cardapio = Cardapio::findOrFail($cardapioId);
    $itens = $cardapio->itens; // Isso pressupõe que você tenha uma relação de itens no seu model Cardapio

    return view('cardapio.itens', compact('cardapio', 'itens', 'empresaId'));
}

    // Excluir cardápio
    public function destroy($cardapioId)
    {
        $cardapio = Cardapio::findOrFail($cardapioId);
        $cardapio->delete();

        return redirect()->route('cardapio.index', ['empresaId' => $cardapio->empresa_id])
                         ->with('success', 'Cardápio excluído com sucesso!');
    }
}
