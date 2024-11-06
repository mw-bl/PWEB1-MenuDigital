<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Empresa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Same styles from the registration page */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            background-color: #D92621;
            font-family: Arial, sans-serif;
        }

        .main-container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .left-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-color: #D92621;
        }

        .right-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 2rem;
            background-color: #D92621;
        }

        .left-section img {
            max-width: 80%;
            border-radius: 15px;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            margin-right: 10rem;
            background-color: #FFFFFF;
        }

        .form-header {
            font-size: 2.5rem;
            color: #333333;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control {
            height: 50px;
            border: 2px solid #E0E0E0;
            border-radius: 10px;
            padding-left: 3rem;
            font-size: 1rem;
            color: #333333;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #D92621;
            box-shadow: none;
            outline: none;
        }

        .input-group .input-group-text {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            font-size: 1.5rem;
            color: black;
        }

        .btn-primary {
            background-color: #D92621;
            border: none;
            border-radius: 40px;
            transition: background-color 0.3s ease;
            width: 200px !important;
            height: 60px;
            font-size: 1rem;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .btn-primary:hover {
            background-color: #D92621;
        }

        .link-register {
            text-align: center;
            margin-top: 1rem;
        }

        .link-register a {
            color: #D92621;
            text-decoration: none;
            font-weight: bold;
        }

        .link-register a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="main-container">
    <!-- Left section with image -->
    <div class="left-section">
        <img src="{{ asset('imagem_telas_de_login.png') }}" alt="Imagem ilustrativa da empresa">
    </div>

    <!-- Right section with login form -->
    <div class="right-section">
        <div class="card">
            <div class="form-header text-center">Login</div>
            <form action="{{ route('empresa.login') }}" method="POST">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- Email -->
                <div class="mb-3 input-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <span class="input-group-text material-icons">email</span>
                </div>

                <!-- Senha -->
                <div class="mb-3 input-group">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                    <span class="input-group-text material-icons">lock</span>
                </div>

                <!-- Botão de Login -->
                <button type="submit" class="btn btn-primary w-100 mt-4">
                    <span class="material-icons align-middle">login</span> Entrar
                </button>

                <!-- Link para a página de cadastro -->
                <div class="link-register">
                    <p>Não tem uma conta? <a href="{{ route('empresa.cadastro') }}">Cadastre-se aqui</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
