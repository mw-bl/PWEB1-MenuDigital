<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoMenu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            flex-wrap: wrap;
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

        .logo {
            text-align: center;
            margin-top: 50px;
        }

        .logo img {
            width: 80px;
            margin-bottom: 10px;
        }

        .logo h1 {
            font-size: 36px;
            color: #000;
            font-weight: bold;
        }

        .logo p {
            font-size: 18px;
            color: #ff0000;
        }

        .hero-image {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 50px 0;
        }

        .hero-image img {
            width: 300px;
            border-radius: 20px;
        }

        .restaurants {
            text-align: center;
            margin: 20px 0;
        }

        .restaurants h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .restaurant-list {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .restaurant-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 200px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .restaurant-card img {
            width: 100%;
            border-radius: 10px;
        }

        .restaurant-card h3 {
            font-size: 18px;
            font-weight: bold;
            color: #ff0000;
            margin: 10px 0;
        }

        .restaurant-card p {
            font-size: 14px;
            color: #666;
        }

        .restaurant-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }

            .menu {
                display: flex;
                flex-direction: column;
                margin-top: 10px;
            }

            .menu a {
                margin: 5px 0;
            }

            .hero-image img {
                width: 80%;
                margin-top: 20px;
            }

            .logo h1 {
                font-size: 28px;
            }

            .restaurants h2 {
                font-size: 24px;
            }

            .restaurant-card {
                width: 90%;
                margin: 10px auto;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 10px;
            }

            .logo img {
                width: 60px;
            }

            .logo h1 {
                font-size: 24px;
            }

            .hero-image img {
                width: 100%;
            }

            .restaurant-card h3 {
                font-size: 16px;
            }

            .restaurant-card p {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo-navbar">
            <img src="public/logo2.png" alt="Logo">
        </div>
        <div class="menu">
            <a href="{{ route('empresa.login') }}">Entrar</a>
            <a href="{{ route('empresa.cadastro') }}">Cadastrar Empresa</a>
        </div>
    </div>

    <div class="logo">
        <img src="public/logo1.png" alt="Logo do GoMenu">
    </div>

    <div class="hero-image">
        <img src="public/pessoa1.png" alt="Imagem de destaque">
    </div>

    <div class="restaurants">
        <h2>Restaurantes</h2>
        <div class="restaurant-list">
            <div class="restaurant-card">
                <img src="public/telaInicial/lesPresidents.png" alt="Imagem do restaurante 1">
                <h3>Restaurante 1</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
            </div>
            <div class="restaurant-card">
                <img src="public/telaInicial/contrastes.png" alt="Imagem do restaurante 2">
                <h3>Restaurante 2</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="restaurant-card">
                <img src="public/telaInicial/avenidaGastrobar.png" alt="Imagem do restaurante 3">
                <h3>Restaurante 3</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="restaurant-card">
                <img src="public/telaInicial/arenaSunset.png" alt="Imagem do restaurante 4">
                <h3>Restaurante 4</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
