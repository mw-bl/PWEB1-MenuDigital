@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Itens do Cardápio: {{ $cardapio->descricao }}</h1>

    <a href="{{ route('item.create', ['empresaId' => $empresaId, 'cardapioId' => $cardapio->id_cardapio]) }}" class="btn btn-primary mb-3">Adicionar Novo Item</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cardapio->itens as $item)
                <tr>
                    <td>{{ $item->nome_produto }}</td>
                    <td>{{ $item->descricao }}</td>
                    <td>{{ $item->preco }}</td>
                    <td><img src="{{ asset('storage/'.$item->imagem) }}" alt="Imagem do item" width="50"></td>
                    <td>
                        <a href="{{ route('item.edit', ['empresaId' => $empresaId, 'cardapioId' => $cardapio->id_cardapio, 'itemId' => $item->id_item]) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('item.destroy', ['empresaId' => $empresaId, 'cardapioId' => $cardapio->id_cardapio, 'itemId' => $item->id_item]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este item?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
