<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar e Criar Cardápios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 20px;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
        }
        .item {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Gerenciar e Criar Cardápios</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulário para criar um novo cardápio -->
    <h2>Criar Novo Cardápio</h2>
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

    <!-- Lista de cardápios existentes -->
    <h2>Cardápios Existentes</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cardapios as $cardapio)
                <tr>
                    <td>{{ $cardapio->descricao }}</td>
                    <td><img src="{{ asset('storage/' . $cardapio->link_imagem) }}" alt="Imagem do Cardápio" width="100"></td>
                    <td>
                        <a href="{{ route('cardapio.show', $cardapio->id_cardapio) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('cardapio.edit', $cardapio->id_cardapio) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('cardapio.destroy', $cardapio->id_cardapio) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.getElementById('add-item').addEventListener('click', function() {
    var container = document.getElementById('itens-container');
    var item = document.querySelector('.item').cloneNode(true);
    container.appendChild(item);
});
</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>