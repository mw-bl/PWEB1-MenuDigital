@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Cardápios Criados</h2>

        @foreach($cardapios as $cardapio)
            <div class="card mt-3">
                <div class="card-body">
                    <h3>{{ $cardapio->nome }}</h3>
                    <p>{{ $cardapio->descricao }}</p>

                    @if ($cardapio->imagem)
                        <img src="{{ asset('storage/' . $cardapio->imagem) }}" alt="Imagem do Cardápio" class="img-fluid">
                    @endif

                    <h4>Itens:</h4>
                    <ul>
                        @foreach($cardapio->itens as $item)
                            <li>
                                <strong>{{ $item->nome }}</strong> - R$ {{ number_format($item->preco, 2, ',', '.') }}
                                <p>{{ $item->descricao }}</p>
                                @if ($item->imagem)
                                    <img src="{{ asset('storage/' . $item->imagem) }}" alt="Imagem do Item" class="img-fluid" width="100">
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection
