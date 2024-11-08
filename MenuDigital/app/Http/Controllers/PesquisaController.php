<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cardapio;
use App\Models\Empresa;

class PesquisaController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $cardapios = Cardapio::where('nome', 'like', "%{$query}%")->get();
        $empresas = Empresa::where('nome', 'like', "%{$query}%")->get();

        return view('cardapio.search_results', compact('cardapios', 'empresas'));
    }
}

