<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoMenu</title>
    <!-- Link do Bootstrap para estilos e responsividade -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Reset de estilo básico */
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

        /* Estilo da barra de navegação */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #fff; /* Fundo branco para a navbar */
        }

        .menu a {
            background-color: #ff0000; /* Cor do fundo do botão em vermelho */
            color: #fff; /* Cor do texto branco */
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
            background-color: #cc0000; /* Vermelho mais escuro ao passar o mouse */
        }

        /* Estilo do logo e slogan */
        .logo {
            text-align: center;
            margin-top: 50px;
        }

        .logo img {
            width: 80px; /* Substitua pelo logo da sua aplicação */
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

        /* Estilo da seção de imagem principal */
        .hero-image {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 50px 0;
        }

        .hero-image img {
            width: 300px;
            border-radius: 20px;
            /* Adicione a imagem de destaque aqui */
        }

        /* Estilo da seção de restaurantes */
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

        /* Estilo dos cards dos restaurantes */
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
            /* Adicione as imagens dos restaurantes aqui */
        }

        .restaurant-card h3 {
            font-size: 18px;
            font-weight: bold;
            color: #ff0000;
            margin: 10px 0;
        }

        .restaurant-card p {
            font-size: 14px;
            font-weight: bold;
            color: #666;
        }

        /* Efeito de hover nos cards */
        .restaurant-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Responsividade para dispositivos móveis */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .menu {
                margin-top: 10px;
                display: flex;
                flex-direction: column;
                width: 100%;
            }

            .menu a {
                margin: 5px 0;
                text-align: center;
            }

            .hero-image img {
                width: 100%;
            }

            .restaurant-list {
                flex-direction: column;
                align-items: center;
            }

            .restaurant-card {
                width: 80%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Barra de navegação -->
    <div class="navbar">
        <div class="logo-navbar">
            <img src="public/logo2.png" alt="Logo">
        </div>
        <div class="menu">
            <a href="{{ route('empresa.login') }}">Entrar</a>
            <a href="{{ route('empresa.cadastro') }}">Cadastrar Empresa</a>
        </div>
    </div>

    <!-- Seção de logo e slogan -->
    <div class="logo">
        <img src="public/logo1.png" alt="Logo do GoMenu"> <!-- Coloque a imagem do logo -->
    </div>

    <!-- Seção de imagem principal -->
    <div class="hero-image">
        <img src="public/pessoa1.png" alt="Imagem de destaque"> <!-- Coloque a imagem principal -->
    </div>

    <!-- Seção de restaurantes -->
    <div class="restaurants">
        <h2>Restaurantes</h2>
        <div class="restaurant-list">
            <!-- Cartão do restaurante 1 -->
            <div class="restaurant-card">
                <img src="public/telaInicial/lesPresidents.png" alt="Imagem do restaurante 1"> <!-- Coloque a imagem do restaurante 1 -->
                <h3>Restaurante 1</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum obcaecati ipsa unde eveniet harum voluptatum assumenda labore repudiandae consequatur sunt perferendis, tempore magni odit accusantium nam, delectus aliquid excepturi officia.</p>
            </div>

            <!-- Cartão do restaurante 2 -->
            <div class="restaurant-card">
                <img src="public/telaInicial/contrastes.png" alt="Imagem do restaurante 2"> <!-- Coloque a imagem do restaurante 2 -->
                <h3>Restaurante 2</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi explicabo eveniet, laborum, nisi numquam amet incidunt voluptatem placeat omnis nemo alias dicta obcaecati inventore quis non expedita atque! Quis, recusandae.</p>
            </div>

            <!-- Cartão do restaurante 3 -->
            <div class="restaurant-card">
                <img src="public/telaInicial/avenidaGastrobar.png" alt="Imagem do restaurante 3"> <!-- Coloque a imagem do restaurante 3 -->
                <h3>Restaurante 3</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero voluptatem odit quisquam illo, numquam officia aliquam sequi tempore, vel ducimus similique ipsa maxime. Ipsum quidem esse quam recusandae magnam enim.</p>
            </div>

            <!-- Cartão do restaurante 4 -->
            <div class="restaurant-card">
                <img src="public/telaInicial/arenaSunset.png" alt="Imagem do restaurante 4"> <!-- Coloque a imagem do restaurante 4 -->
                <h3>Restaurante 4</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem eum aperiam ratione blanditiis laudantium ipsam sit saepe hic, non vero, rem necessitatibus recusandae quis iste sapiente corporis minima maxime facere!</p>
            </div>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
