<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\ItensCardapio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Empresa;

class CardapioController extends Controller
{
    // Exibe a página de gerenciamento de cardápios da empresa
    public function manage()
    {
        $empresaId = \Illuminate\Support\Facades\Auth::user()->id; // Assumindo que a empresa está logada
        $cardapios = Cardapio::where('fk_Empresa_id_empresa', $empresaId)->get();
        
        return view('cardapio.manage', compact('cardapios'));
    }

    // Exibe a página para criação de um novo cardápio
    public function create()
    {
        return view('cardapio.create');
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

        $empresaId = \Illuminate\Support\Facades\Auth::user()->id;

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
            ]);
        }

        

        return redirect()->route('cardapio.manage')->with('success', 'Cardápio e itens criados com sucesso.');
    }

    public function show($id)
    {
        $cardapio = Cardapio::with('itens')->findOrFail($id); // Assumindo que há uma relação entre Cardapio e ItensCardapio
        return view('cardapio.show', compact('cardapio'));
    }

    public function index(){
        // Buscar todos os cardápios do banco de dados
        $cardapios = Cardapio::all(); // Pega todos os cardápios cadastrados

        // Passa a variável para a view paginaPrincipal
        return view('paginaPrincipal', compact('cardapios')); // Alterado para o nome correto da view
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    // Buscar cardápios com base no nome da empresa
    $cardapios = Cardapio::whereHas('empresa', function($queryEmpresa) use ($query) {
        $queryEmpresa->where('nome', 'like', "%{$query}%");
    })->get();

    // Buscar empresas que correspondem ao termo pesquisado
    $empresas = Empresa::where('nome', 'like', "%{$query}%")->get();

    return view('cardapio.search_results', compact('cardapios', 'empresas'));
}




}
