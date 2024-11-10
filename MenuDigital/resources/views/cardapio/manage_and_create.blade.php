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
        /* Configuração geral de cores e fontes */
        body {
            padding-top: 20px;
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        h1, h2, h3 {
            color: #333;
        }
        .container {
            max-width: 800px;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #0066cc;
            border-color: #0066cc;
        }
        .btn-primary:hover {
            background-color: #004c99;
            border-color: #004c99;
        }
        .btn-secondary {
            background-color: #6c757d; /* Cor cinza para o botão "Adicionar Item" */
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
            <label for="imagem" class="form-label">Imagem do Cardápio</label>
            <input type="file" class="form-control" id="imagem" name="imagem" required>
        </div>
        <div id="itens-container">
            <div class="item">
                <h3>Item do Cardápio</h3>
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
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco[]" required>
                </div>
                <div class="mb-3">
                    <label for="imagem_itens" class="form-label">Imagem do Produto</label>
                    <input type="file" class="form-control" id="imagem_itens" name="imagem_itens[]" required>
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
                    <td><img src="{{ asset('storage/' . $cardapio->imagem) }}" alt="Imagem do Cardápio" width="100"></td>
                    <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewModal" data-descricao="{{ $cardapio->descricao }}" data-imagem="{{ asset('storage/' . $cardapio->imagem) }}">Ver</button>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $cardapio->id_cardapio }}" data-descricao="{{ $cardapio->descricao }}" data-imagem="{{ asset('storage/' . $cardapio->imagem) }}">Editar</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $cardapio->id_cardapio }}">Excluir</button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemsModal{{ $cardapio->id_cardapio }}">Adicionar Itens</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modais -->
<!-- Modal de Visualização -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Visualizar Cardápio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="viewDescricao"></p>
                <img id="viewImagem" src="" alt="Imagem do Cardápio" width="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Cardápio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editDescricao" class="form-label">Descrição do Cardápio</label>
                        <input type="text" class="form-control" id="editDescricao" name="descricao" required>
                    </div>
                    <div class="mb-3">
                        <label for="editImagem" class="form-label">Imagem do Cardápio</label>
                        <input type="file" class="form-control" id="editImagem" name="imagem">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Exclusão -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Excluir Cardápio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja excluir este cardápio?</p>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Adicionar Itens -->
@foreach ($cardapios as $cardapio)
<div class="modal fade" id="addItemsModal{{ $cardapio->id_cardapio }}" tabindex="-1" aria-labelledby="addItemsModalLabel{{ $cardapio->id_cardapio }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemsModalLabel{{ $cardapio->id_cardapio }}">Adicionar Itens ao Cardápio: {{ $cardapio->descricao }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cardapio.addItems', $cardapio->id_cardapio) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="itens-container-{{ $cardapio->id_cardapio }}">
                        <h3>Adicionar Itens ao Cardápio</h3>
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
                                <label for="imagem_itens" class="form-label">Imagem do Produto</label>
                                <input type="file" class="form-control" id="imagem_itens" name="imagem_itens[]" required>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary add-item" data-cardapio-id="{{ $cardapio->id_cardapio }}">Adicionar Item</button>
                    <button type="submit" class="btn btn-primary">Adicionar Itens</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script para carregar dados no modal de visualização
    var viewModal = document.getElementById('viewModal');
    viewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var descricao = button.getAttribute('data-descricao');
        var imagem = button.getAttribute('data-imagem');

        var modalDescricao = viewModal.querySelector('#viewDescricao');
        var modalImagem = viewModal.querySelector('#viewImagem');

        modalDescricao.textContent = descricao;
        modalImagem.src = imagem;
    });

    // Script para carregar dados no modal de edição
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var descricao = button.getAttribute('data-descricao');
        var imagem = button.getAttribute('data-imagem');

        var modalDescricao = editModal.querySelector('#editDescricao');
        var modalImagem = editModal.querySelector('#editImagem');
        var form = editModal.querySelector('#editForm');

        modalDescricao.value = descricao;
        modalImagem.src = imagem;
        form.action = '/empresa/cardapios/' + id;
    });

    // Script para carregar dados no modal de exclusão
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = deleteModal.querySelector('#deleteForm');
        form.action = '/empresa/cardapios/' + id;
    });

    // Script para adicionar itens dinamicamente no modal de adição de itens
    document.querySelectorAll('.add-item').forEach(button => {
        button.addEventListener('click', function() {
            var cardapioId = this.getAttribute('data-cardapio-id');
            var container = document.getElementById('itens-container-' + cardapioId);
            var item = container.querySelector('.item').cloneNode(true);
            container.appendChild(item);
        });
    });
</script>
</body>
</html>