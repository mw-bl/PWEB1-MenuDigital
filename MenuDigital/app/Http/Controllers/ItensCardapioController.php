<?php

namespace App\Http\Controllers;

use App\Models\ItensCardapio;
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
        $item = ItensCardapio::create($request->all());
        return response()->json($item, 201);
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

