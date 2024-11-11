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

        $empresaId = $request->empresaId;

        $imagePath = $request->file('imagem')->store('cardapios', 'public');

        $cardapio = Cardapio::create([
            'descricao' => $request->descricao,
            'imagem' => $imagePath,
            'fk_Empresa_id_empresa' => $empresaId,
        ]);

        if ($request->hasFile('imagem_itens')) {
            foreach ($request->file('imagem_itens') as $index => $file) {
                $itemImagePath = $file->store('itens_cardapio', 'public');

                ItensCardapio::create([
                    'nome_produto' => $request->nome_produto[$index],
                    'descricao' => $request->descricao_produto[$index],
                    'preco' => $request->preco[$index],
                    'imagem' => $itemImagePath,
                    'fk_Cardapio_id_cardapio' => $cardapio->id_cardapio,
                ]);
            }
        }

        return redirect()->route('cardapio.manage_and_create', ['empresaId' => $empresaId]);
    }

    public function manageAndCreate()
    {
        $empresaId = Auth::user()->id_empresa;
        $cardapios = Cardapio::where('fk_Empresa_id_empresa', $empresaId)->get();
        
        return view('cardapio.manage_and_create', compact('cardapios', 'empresaId'));
    }

    public function index()
    {
        $cardapios = Cardapio::with('itens', 'empresa')->get();
        return view('welcome', compact('cardapios'));
    }

    public function edit($cardapioId)
    {
        $cardapio = Cardapio::findOrFail($cardapioId);
        return view('cardapio.edit', compact('cardapio'));
    }

    public function update(Request $request, $cardapioId)
    {
        $request->validate([
            'descricao' => 'required|string|max:500',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

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
        $cardapio = Cardapio::findOrFail($cardapioId);
        $itens = $cardapio->itens;

        return view('cardapio.itens', compact('cardapio', 'itens', 'empresaId'));
    }

    public function destroy($cardapioId)
    {
        $cardapio = Cardapio::findOrFail($cardapioId);
        $cardapio->delete();

        return redirect()->route('cardapio.index', ['empresaId' => $cardapio->empresa_id])
                         ->with('success', 'Cardápio excluído com sucesso!');
    }

    public function create($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        return view('cardapio.create', compact('empresa'));
    }

    public function showForm($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        return view('cardapio.create', compact('empresa'));
    }
}