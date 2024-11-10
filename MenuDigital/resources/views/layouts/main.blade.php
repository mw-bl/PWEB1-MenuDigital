<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GoMenu')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilo básico do layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #F5F5F5;
            color: #333;
        }

        /* Barra de navegação */
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

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 20px;
        }
    </style>
</head>
<body>

    <!-- Barra de navegação -->
    <div class="navbar">
        <div class="logo-navbar">
            <img src="{{ asset('logo2.png') }}" alt="Imagem ilustrativa da empresa" height="40">
        </div>
        <div class="menu">
            <!-- Botões de navegação -->
            <a href="{{ route('empresa.login') }}">Entrar</a>
            <a href="{{ route('empresa.cadastro') }}">Cadastrar Empresa</a>
        </div>
    </div>

    <!-- Conteúdo da página -->
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 GoMenu. Todos os direitos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @stack('scripts')
</body>
</html>
