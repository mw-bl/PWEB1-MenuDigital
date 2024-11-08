<!-- resources/views/cardapio/create.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Cardápio</title>
</head>
<body>
    <h1>Criar Novo Cardápio</h1>

    <form action="{{ route('cardapio.store') }}" method="POST">
        @csrf
        <label for="nome">Nome do Cardápio:</label>
        <input type="text" id="nome" name="nome" required>

        <button type="submit">Salvar Cardápio</button>
    </form>
</body>
</html>
