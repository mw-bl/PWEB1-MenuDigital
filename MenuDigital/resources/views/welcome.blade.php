@extends('layouts.main')

@section('title', 'Página Inicial')

@section('content')
    <div class="logo-container">
        <img class="logo-img" src="{{ asset('logo1.png') }}" alt="Imagem ilustrativa da empresa" width="300">
        <img class="main-img" src="{{ asset('pessoa1.png') }}" alt="Imagem ilustrativa da empresa" width="400">
    </div>

    <div class="container mt-5">
        <h2 class="text-center">Nossos Cardápios</h2>

        <div class="row">
            @foreach ($cardapios as $cardapio)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cardapio->nome }}</h5>
                            <p class="card-text">Empresa: {{ $cardapio->empresa->nome }}</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCardapio{{ $cardapio->id }}">
                                Ver Itens
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalCardapio{{ $cardapio->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $cardapio->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel{{ $cardapio->id }}">Cardápio: {{ $cardapio->nome }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>Empresa: {{ $cardapio->empresa->nome }}</h6>
                                <ul>
                                    @foreach ($cardapio->itens as $item)
                                        <li>{{ $item->nome }} - R$ {{ number_format($item->preco, 2, ',', '.') }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

