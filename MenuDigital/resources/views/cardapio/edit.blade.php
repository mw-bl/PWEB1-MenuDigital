@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Cardápio</h1>

    <form action="{{ route('cardapio.update', ['cardapioId' => $cardapio->id_cardapio]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ old('descricao', $cardapio->descricao) }}" required>
        </div>

        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" class="form-control" id="imagem" name="imagem">
            @if ($cardapio->imagem)
                <img src="{{ asset('storage/' . $cardapio->imagem) }}" alt="Imagem do cardápio" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
