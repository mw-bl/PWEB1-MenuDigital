@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Cardápios da Empresa</h1>

    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('cardapio.create', ['empresaId' => $empresaId]) }}" class="btn btn-primary mb-3">Criar Novo Cardápio</a>

    <table class="table">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cardapios as $cardapio)
                <tr>
                    <td>{{ $cardapio->descricao }}</td>
                    <td>
                        
                        <a href="{{ route('cardapio.itens', ['empresaId' => $empresaId, 'cardapioId' => $cardapio->id_cardapio]) }}" class="btn btn-info btn-sm">Visualizar Itens</a>

                        
                        <a href="{{ route('cardapio.edit', ['empresaId' => $empresaId, 'cardapioId' => $cardapio->id_cardapio]) }}" class="btn btn-warning btn-sm">Editar</a>

                        
                        <form action="{{ route('cardapio.destroy', ['empresaId' => $empresaId, 'cardapioId' => $cardapio->id_cardapio]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este cardápio?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
