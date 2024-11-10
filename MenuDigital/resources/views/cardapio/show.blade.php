<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Cardápio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Visualizar Cardápio</h1>
    <div class="card mb-3">
        <div class="card-header">
            <h2>{{ $cardapio->descricao }}</h2>
        </div>
        <div class="card-body">
            <img src="{{ asset('storage/' . $cardapio->imagem) }}" alt="Imagem do Cardápio" class="img-fluid mb-3">
            <h3>Itens do Cardápio</h3>
            <ul class="list-group">
                @foreach ($cardapio->itens as $item)
                    <li class="list-group-item">
                        <h4>{{ $item->nome_produto }}</h4>
                        <p>{{ $item->descricao }}</p>
                        <p>Preço: R$ {{ number_format($item->preco, 2, ',', '.') }}</p>
                        <img src="{{ asset('storage/' . $item->imagem) }}" alt="Imagem do Produto" class="img-fluid" width="100">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <a href="{{ route('cardapio.manageAndCreate') }}" class="btn btn-primary">Voltar</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>