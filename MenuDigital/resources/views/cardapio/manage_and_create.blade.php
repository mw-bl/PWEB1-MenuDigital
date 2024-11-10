<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar e Criar Cardápios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            background-color: #6c757d;
            color: #fff;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .form-label {
            font-weight: bold;
            color: #555;
        }
        .table thead {
            background-color: #0066cc;
            color: #ffffff;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        /* Estilo para cada item */
        .item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .item:hover {
            background-color: #e9f5ff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }
        /* Efeito de hover nos cards de cardápios existentes */
        .table tbody tr:hover {
            background-color: #e9f5ff;
            transition: background-color 0.3s;
        }

        @media (max-width: 768px) {
            .container {
                max-width: 100%;
                padding: 10px;
            }
            .table thead {
                display: none;
            }
            .table, .table tbody, .table tr, .table td {
                display: block;
                width: 100%;
            }
            .table td {
                padding: 10px;
                border: none;
                position: relative;
                padding-left: 50%;
            }
            .table td:before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
            }
            .btn {
                margin-bottom: 10px;
                width: 100%;
            }
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
                    <td data-label="Descrição">{{ $cardapio->descricao }}</td>
                    <td data-label="Imagem"><img src="{{ asset('storage/' . $cardapio->link_imagem) }}" alt="Imagem do Cardápio" width="100"></td>
                    <td data-label="Ações">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
