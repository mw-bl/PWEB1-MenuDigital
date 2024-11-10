<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoMenu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            flex-wrap: wrap;
        }

        .menu {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .menu .search-input {
            position: relative;
            max-width: 100%;
            flex: 1;
        }

        .menu .search-input input[type="text"] {
            width: 100%;
            padding: 5px 30px 5px 10px;
            border-radius: 50px;
            border: 1px solid #ddd;
        }

        .menu .search-input .fa-search {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: black;
            pointer-events: none;
        }

        .menu a {
            background-color: #ff0000;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .menu a:hover {
            background-color: #cc0000;
        }

        .logo-navbar img {
            height: 40px;
            max-width: 100%;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            gap: 20px;
            flex-wrap: wrap;
            text-align: center;
        }

        .logo-img, .main-img {
            width: 100%;
            max-width: 25rem;
            height: auto;
        }

        @media (max-width: 576px) {
            .menu .search-input {
                max-width: 100%;
            }

            .menu a {
                font-size: 0.85rem;
                padding: 6px 10px;
            }

            .logo-container {
                margin-top: 20px;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo-navbar">
            <img src="{{ asset('logo2.png') }}" alt="Imagem ilustrativa da empresa">
        </div>
        <div class="menu">
            <div class="search-input">
                <form action="{{ route('cardapio.pesquisa') }}" method="GET">
                    <input type="text" name="query" placeholder="Buscar empresas ou cardápios">
                    <i class="fas fa-search"></i>
                </form>
            </div>
            <a href="{{ route('empresa.login') }}">Entrar</a>
            <a href="{{ route('empresa.cadastro') }}">Cadastrar Empresa</a>
        </div>
    </div>

    <div class="logo-container">
        <img class="logo-img" src="{{ asset('logo1.png') }}" alt="Imagem ilustrativa da empresa">
        <img class="main-img" src="{{ asset('pessoa1.png') }}" alt="Imagem ilustrativa da empresa">
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
