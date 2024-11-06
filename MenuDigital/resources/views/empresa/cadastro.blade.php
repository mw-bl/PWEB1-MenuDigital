<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empresa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Full-page flex container */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            background-color: #D92621;
        }

        /* Flex container for left and right sections */
        .main-container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        /* Left section for image */
        .left-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        /* Right section for form */
        .right-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 2rem;
        }

        /* Image styling */
        .left-section img {
            max-width: 80%;
            border-radius: 20px;
        }

        /* Card styling */
        .card {
            border-radius: 40px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 500px;
            width: 550px;
            height: auto;
            margin-right: 10rem;
        }

        /* Input styling */
        .input-group {
            height: 50px;
            border: 2px solid #000;
            border-radius: 50px;
            padding-left: 40px;
        }
        .form-control{
            height: 45px;
            background: transparent;
            padding-left: 10px;
            border: none;
            border-radius: 50px 50px;
        }

        .input-group .input-group-text {
            background: transparent;
            border: none;
            color: black;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            left: 10px;
            height: 50px;
            pointer-events: none;
            transition: opacity 0.3s;
            border-radius: 0 4px 4px 0;
        }

        .form-control:focus + .input-group-text,
        .form-control:not(:placeholder-shown) + .input-group-text {
            opacity: 0;
        }

        /* Button styling */
        .btn-primary {
            background-color: #D92621;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            height: 60px;
            
        }

        .btn-primary:hover {
            background-color: #D92621;
        }

        /* Label styling */
        .form-label {
            color: black;
            font-weight: 500;
        }

        .form-header {
            font-size: 3rem;
            color: black;
            font-weight: bold;
            margin-bottom: 1rem;
            font-family: 'Neulis', sans-serif;
        }
    </style>
</head>
<body>

<div class="main-container">
    <!-- Left section with image -->
    <div class="left-section">
    <img src="{{ asset('imagem_telas_de_login.png') }}" alt="Imagem ilustrativa da empresa">

    </div>

    <!-- Right section with form -->
    <div class="right-section">
        <div class="card">
            <div class="form-header text-center">Registro</div>
            <form action="{{ route('empresa.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- Nome -->
                <div class="mb-3 input-group">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Empresa" required>
                    <span class="input-group-text material-icons">business</span>
                </div>

                <!-- CNPJ -->
                <div class="mb-3 input-group">
                    <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" required>
                    <span class="input-group-text material-icons">account_balance</span>
                </div>

                <!-- Email -->
                <div class="mb-3 input-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <span class="input-group-text material-icons">email</span>
                </div>

                <!-- Telefone -->
                <div class="mb-3 input-group">
                    <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
                    <span class="input-group-text material-icons">phone</span>
                </div>

                <!-- Endereço -->
                <div class="mb-3 input-group">
                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" required>
                    <span class="input-group-text material-icons">location_on</span>
                </div>

                <!-- Senha -->
                <div class="mb-3 input-group">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                    <span class="input-group-text material-icons">lock</span>
                </div>

                <!-- Confirmar Senha -->
                <div class="mb-3 input-group">
                    <input type="password" class="form-control" id="senha_confirmation" name="senha_confirmation" placeholder="Confirmar Senha" required>
                    <span class="input-group-text material-icons">lock</span>
                </div>

                <!-- Botão de Cadastro -->
                <button type="submit" class="btn btn-primary w-100 mt-4">
                    <span class="material-icons align-middle">person_add</span> Cadastrar
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
