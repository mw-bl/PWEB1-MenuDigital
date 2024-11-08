@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Resultados da Pesquisa</h2>

    @if($empresas->isEmpty() && $cardapios->isEmpty())
        <p class="text-center">Nenhuma empresa ou cardápio encontrado.</p>
    @else
        <div class="row">
            <!-- Lista de Empresas -->
            @foreach($empresas as $empresa)
                <div class="col-md-4">
                    <div class="restaurant-card">
                        <h3>{{ $empresa->nome }}</h3>
                        <p>{{ $empresa->endereco }}</p>
                        <a href="{{ route('empresa.show', $empresa->id_empresa) }}" class="btn btn-danger">Ver Cardápio</a>
                    </div>
                </div>
            @endforeach

            <!-- Lista de Cardápios -->
            @foreach($cardapios as $cardapio)
                <div class="col-md-4">
                    <div class="restaurant-card">
                        <img src="{{ Storage::url($cardapio->link_imagem) }}" alt="Imagem do Cardápio">
                        <h3>{{ $cardapio->descricao }}</h3>
                        <a href="{{ route('cardapio.show', $cardapio->id_cardapio) }}" class="btn btn-danger">Ver Cardápio</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
