@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Criar e Gerenciar Cardápio</h2>

        <form action="{{ route('cardapio.store', ['empresaId' => $empresa->empresa_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="descricao">Descrição do Cardápio:</label>
                <textarea name="descricao" id="descricao" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="imagem">Foto do Cardápio:</label>
                <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>

            <div class="form-group">
                <button type="button" id="adicionar-item-btn" class="btn btn-secondary">Adicionar Item</button>
            </div>

            <div id="itens-container"></div>
        </form>

        <div id="sucesso" class="mt-4" style="display: none;">
            <p>Cardápio salvo com sucesso!</p>
        </div>
    </div>

    <template id="item-template">
        <div class="item">
            <h3>Item</h3>

            <div class="form-group">
                <label for="nome_produto[]">Nome do Item:</label>
                <input type="text" name="nome_produto[]" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="descricao_produto[]">Descrição:</label>
                <textarea name="descricao_produto[]" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="preco[]">Preço:</label>
                <input type="number" name="preco[]" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="imagem_itens[]">Foto do Item:</label>
                <input type="file" name="imagem_itens[]" class="form-control" accept="image/*" required>
            </div>

            <hr>
        </div>
    </template>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('adicionar-item-btn').addEventListener('click', function() {
                var template = document.getElementById('item-template');
                var clone = template.content.cloneNode(true);
                document.getElementById('itens-container').appendChild(clone);
            });
        });
    </script>
@endpush
