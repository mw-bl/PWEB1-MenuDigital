
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Novo Cardápio</h1>
    <form action="{{ route('cardapio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição do Cardápio</label>
            <input type="text" class="form-control" id="descricao" name="descricao" required>
        </div>
        <div class="mb-3">
            <label for="link_imagem" class="form-label">Imagem do Cardápio</label>
            <input type="file" class="form-control" id="link_imagem" name="link_imagem" required>
        </div>
        <div id="itens-container">
            <h3>Itens do Cardápio</h3>
            <div class="item">
                <div class="mb-3">
                    <label for="nome_produto" class="form-label">Nome do Produto</label>
                    <input type="text" class="form-control" id="nome_produto" name="nome_produto[]" required>
                </div>
                <div class="mb-3">
                    <label for="descricao_produto" class="form-label">Descrição do Produto</label>
                    <input type="text" class="form-control" id="descricao_produto" name="descricao_produto[]" required>
                </div>
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" class="form-control" id="preco" name="preco[]" required>
                </div>
                <div class="mb-3">
                    <label for="link_imagem_itens" class="form-label">Imagem do Produto</label>
                    <input type="file" class="form-control" id="link_imagem_itens" name="link_imagem_itens[]" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="add-item">Adicionar Item</button>
        <button type="submit" class="btn btn-primary">Criar Cardápio</button>
    </form>
</div>

<script>
document.getElementById('add-item').addEventListener('click', function() {
    var container = document.getElementById('itens-container');
    var item = document.querySelector('.item').cloneNode(true);
    container.appendChild(item);
});
</script>
@endsection