<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoMenu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset de estilo básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #F5F5F5;
            color: #333;
        }

        /* Estilo da barra de navegação */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #fff;
        }

        .menu {
            display: flex;
            align-items: center;
        }

        .menu a {
            background-color: #ff0000;
            color: #fff;
            padding: 10px 15px;
            margin-left: 10px;
            border: none;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .menu a:hover {
            background-color: #cc0000;
        }

        .logo-navbar img {
           height: 40px;
        }

        /* Estilo adicional para o layout */
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
            gap: 20px;
        }

        .logo-img {
            width: 25rem;
            height: auto;
        }

        .main-img {
            width: 44rem;
            height: auto;
        }

        .cardapio-img {
            width: 100%;
            height: auto;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Barra de navegação -->
    <div class="navbar">
        <div class="logo-navbar">
            <img src="{{ asset('logo2.png') }}" alt="Imagem ilustrativa da empresa">
        </div>
        <div class="menu">
            <!-- Botões de navegação -->
            <a href="{{ route('empresa.login') }}">Entrar</a>
            <a href="{{ route('empresa.cadastro') }}">Cadastrar Empresa</a>
        </div>
    </div>

    <!-- Seção de logo e imagem principal lado a lado -->
    <div class="logo-container">
        <img class="logo-img" src="{{ asset('logo1.png') }}" alt="Imagem ilustrativa da empresa">
        <img class="main-img" src="{{ asset('pessoa1.png') }}" alt="Imagem ilustrativa da empresa">
    </div>

    <div class="container mt-5">
        <!-- Mensagens de Sucesso e Erro -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h2>Todos os Cardápios</h2>

        @if(isset($cardapios) && $cardapios->isEmpty())
            <p>Nenhum cardápio encontrado.</p>
        @elseif(isset($cardapios))
            <div class="row">
                @foreach($cardapios as $cardapio)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $cardapio->imagem) }}" class="card-img-top cardapio-img" alt="{{ $cardapio->descricao }}" data-toggle="modal" data-target="#modalCardapio{{ $cardapio->id_cardapio }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $cardapio->descricao }}</h5>
                                <p class="card-text">{{ $cardapio->empresa ? $cardapio->empresa->nome : 'Empresa não encontrada' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalCardapio{{ $cardapio->id_cardapio }}" tabindex="-1" role="dialog" aria-labelledby="modalCardapioLabel{{ $cardapio->id_cardapio }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCardapioLabel{{ $cardapio->id_cardapio }}">{{ $cardapio->descricao }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        @foreach($cardapio->itens as $item)
                                            <li>{{ $item->nome_produto }} - R$ {{ number_format($item->preco, 2, ',', '.') }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Scripts do Bootstrap e FontAwesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>