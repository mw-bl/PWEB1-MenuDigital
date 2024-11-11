@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Criar e Gerenciar Cardápio</h2>

        <!-- Formulário de criação do cardápio -->
        <form action="{{ isset($empresa) ? route('cardapio.store', ['empresaId' => $empresa->id_empresa]) : '#' }}" method="POST" enctype="multipart/form-data"></form>
            @csrf

            <!-- Nome do Cardápio -->
            <div class="form-group">
                <label for="nome">Nome do Cardápio:</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <!-- Descrição do Cardápio -->
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" class="form-control" required></textarea>
            </div>

            <!-- Foto do Cardápio -->
            <div class="form-group">
                <label for="imagem">Foto do Cardápio:</label>
                <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
            </div>

            <!-- Botão para adicionar os itens -->
            <div class="form-group">
                <button type="button" class="btn btn-primary" id="adicionar-item-btn">Adicionar Itens</button>
            </div>

            <!-- Contêiner para os itens -->
            <div id="itens-container"></div>

            <!-- Botão para salvar o cardápio e os itens, fora do contêiner de itens -->
            <div class="form-group">
                <button type="submit" id="salvar-cardapio-btn" class="btn btn-success">Salvar Cardápio</button>
            </div>

        </form>

        <!-- Área para exibir a imagem de sucesso -->
        <div id="sucesso" class="mt-4" style="display: none;">
            <p>Cardápio salvo com sucesso!</p>
        </div>
    </div>

    <!-- Template para adicionar itens -->
    <template id="item-template">
        <div class="item">
            <h3>Item</h3>

            <!-- Nome do Item -->
            <div class="form-group">
                <label for="nome_produto[]">Nome do Item:</label>
                <input type="text" name="nome_produto[]" class="form-control" required>
            </div>

            <!-- Descrição do Item -->
            <div class="form-group">
                <label for="descricao_produto[]">Descrição:</label>
                <textarea name="descricao_produto[]" class="form-control" required></textarea>
            </div>

            <!-- Preço do Item -->
            <div class="form-group">
                <label for="preco[]">Preço:</label>
                <input type="number" name="preco[]" class="form-control" required>
            </div>

            <!-- Foto do Item -->
            <div class="form-group">
                <label for="imagem_itens[]">Foto do Item:</label>
                <input type="file" name="imagem_itens[]" class="form-control" accept="image/*">
            </div>

            <hr>
        </div>
    </template>
@endsection

@push('scripts')
    <script>
       document.addEventListener('DOMContentLoaded', function() {
           // Evento para adicionar itens
           document.getElementById('adicionar-item-btn').addEventListener('click', function() {
               // Cria um clone do template
               var template = document.getElementById('item-template');
               var clone = template.content.cloneNode(true);
               
               // Adiciona o clone ao contêiner de itens
               document.getElementById('itens-container').appendChild(clone);
           });
       });
    </script>
@endpush