<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <<link rel="stylesheet" href="app.css"><!-- Seu CSS -->
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
            height: 600px;
            margin-right: 10rem;
        }

        /* Input styling */
        .input-group  {
            height: 50px; /* Slightly larger input */
            border: 2px solid #000; /* Black border */
            border-radius: 50px; 
            padding-left: 40px; /* Space for icon */
        }
        .form-control{
            height: 45px; /* Slightly larger input */
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
            left: 10px; /* Positioning the icon inside the input */
            height: 50px; /* Match input height */
            pointer-events: none; /* Prevent clicks on the icon */
            transition: opacity 0.3s; /* Transition for fading out */
            border-radius: 0 4px 4px 0;
            
        }

        /* Hide the icon when input is focused or has value */
        .form-control:focus + .input-group-text,
        .form-control:not(:placeholder-shown) + .input-group-text {
            opacity: 0; /* Fade out the icon */
        }

        /* Button styling */
        .btn-primary {
            background-color: #3f51b5;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #303f9f;
        }

        /* Label styling */
        .form-label {
            color: black;
            font-weight: 500;
        }

        .form-header {
            font-size: 5rem;
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
        <img src="/imagem_telas_de_login.png" alt="Imagem ilustrativa">
    </div>

    <!-- Right section with form -->
    <div class="right-section">
        <div class="card">
            <div class="form-header text-center">LogIn</div>
            <form action="{{ route('empresa.login') }}" method="POST">
                @csrf
                <!-- Nome -->
                <div class="mb-3 input-group">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="" required>
                    <span class="input-group-text material-icons">person</span>
                </div>

                <!-- Email -->
                <div class="mb-3 input-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                    <span class="input-group-text material-icons">email</span>
                </div>

                <!-- Senha -->
                <div class="mb-3 input-group">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="" required>
                    <span class="input-group-text material-icons">lockp</span>
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