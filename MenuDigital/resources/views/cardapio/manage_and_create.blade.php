@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Criar e Gerenciar Cardápios</h2>

        <!-- Formulário de criação do cardápio -->
        <form id="cardapio-form" action="{{ route('cardapios.store') }}" method="POST" enctype="multipart/form-data">
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
    <button type="button" id="salvar-cardapio-btn" class="btn btn-success">Salvar Cardápio</button>
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
                <label for="nome_item[]">Nome do Item:</label>
                <input type="text" name="itens[nome][]" class="form-control" required>
            </div>

            <!-- Descrição do Item -->
            <div class="form-group">
                <label for="descricao_item[]">Descrição:</label>
                <textarea name="itens[descricao][]" class="form-control" required></textarea>
            </div>

            <!-- Preço do Item -->
            <div class="form-group">
                <label for="preco_item[]">Preço:</label>
                <input type="number" name="itens[preco][]" class="form-control" required>
            </div>

            <!-- Foto do Item -->
            <div class="form-group">
                <label for="foto_item[]">Foto do Item:</label>
                <input type="file" name="itens[imagem][]" class="form-control" accept="image/*">
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

    // Evento para salvar o cardápio e os itens
    document.getElementById('cardapio-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio tradicional do formulário

        var formData = new FormData(this); // Cria o objeto FormData com os dados do formulário

        // Enviar os dados via AJAX
        fetch("{{ route('cardapios.store') }}", {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json()) // Espera resposta JSON
        .then(data => {
            if (data.success) {
                // Exibir mensagem de sucesso
                alert('Cardápio salvo com sucesso!');
                window.location.href = "{{ route('cardapios.index') }}"; // Redirecionar para a página de listagem
            } else {
                // Exibir mensagem de erro detalhada
                alert(`Erro ao salvar o cardápio: ${data.error}\nMensagem: ${data.message}\nArquivo: ${data.file}\nLinha: ${data.line}`);
            }
        })
        .catch(error => {
            console.log(error);
            alert('Erro inesperado ao salvar.');
        });
    });
});


    </script>
@endpush
