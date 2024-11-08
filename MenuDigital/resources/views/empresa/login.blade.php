<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Empresa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Estilos principais */
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
            justify-content: center;
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
            background-color: #FFFFFF;
        }

        .card h1 {
            font-size: 2rem;
            color: #333333;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .form-control {
            height: 50px;
            border: 2px solid #E0E0E0;
            border-radius: 10px;
            padding-left: 1rem;
            font-size: 1rem;
            color: #333333;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #D92621;
            box-shadow: none;
            outline: none;
        }

        .btn-primary {
            background-color: #D92621;
            border: none;
            border-radius: 40px;
            transition: background-color 0.3s ease;
            width: 100%;
            height: 50px;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            background-color: #B71C1C;
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
            <h1 class="text-center">Login</h1>

            <!-- Exibe mensagens de sucesso -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Exibe mensagens de erro -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('empresa.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <!-- Link para a página de cadastro -->
            <div class="link-register">
    <p>Não tem uma conta? <a href="{{ route('empresa.cadastro') }}">Cadastre-se aqui</a></p>
</div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
