@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gerenciar Cardápios</h1>

        <a href="{{ route('cardapio.create') }}" class="btn btn-primary mb-3">Adicionar Novo Cardápio</a>

        @foreach ($cardapios as $cardapio)
            <div class="card my-3">
                <img src="{{ Storage::url($cardapio->link_imagem) }}" class="card-img-top" alt="Imagem do Cardápio">
                <div class="card-body">
                    <h5 class="card-title">{{ $cardapio->descricao }}</h5>
                    <!-- Aqui você pode adicionar uma lista de itens do cardápio -->
                    <a href="{{ route('cardapio.show', $cardapio->id_cardapio) }}" class="btn btn-info">Ver Detalhes</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
