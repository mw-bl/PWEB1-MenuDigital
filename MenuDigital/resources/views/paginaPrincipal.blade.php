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

        .cardapio-bloco {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
            text-align: center;
            cursor: pointer;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
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
        <h2>Cardápios Disponíveis</h2>
        <div class="cardapios-container" style="display: flex; flex-wrap: wrap;">
    <!-- Loop pelos cardápios -->
    @foreach ($cardapios as $cardapio)
        <div class="cardapio-bloco" onclick="abrirModal('{{ $cardapio->id_cardapio }}')">
            <img src="{{ asset('storage/' . $cardapio->imagem) }}" alt="Imagem do Cardápio" class="cardapio-img">
            <div class="card-body">
                <h5 class="card-title">{{ $cardapio->descricao }}</h5>
                <p class="card-text">Empresa: {{ $cardapio->empresa ? $cardapio->empresa->nome : 'Empresa não cadastrada' }}</p>
            </div>
        </div>
    @endforeach
</div>
        <!-- Modal para exibir itens do cardápio -->
        <div id="modalItens" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="fecharModal()">&times;</span>
                <h3>Itens do Cardápio Selecionado</h3>
                <div id="itensConteudo">
                    <!-- Conteúdo será preenchido pelo JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Script para exibir modal e buscar itens -->
    <script>
        async function abrirModal(idCardapio) {
            try {
                // Solicita os itens do cardápio via AJAX
                const response = await fetch(`/cardapio-itens/${idCardapio}`);
                const data = await response.json();

                // Atualiza o conteúdo do modal com os itens do cardápio
                const itensConteudo = document.getElementById('itensConteudo');
                itensConteudo.innerHTML = '';

                if (data.itens && data.itens.length > 0) {
                    data.itens.forEach(item => {
                        const itemDiv = document.createElement('div');
                        itemDiv.style.borderBottom = '1px solid #ddd';
                        itemDiv.style.padding = '10px 0';
                        itemDiv.innerHTML = `
                            <img src="/storage/${item.imagem}" alt="Imagem do Produto" style="width: 50px; height: auto; margin-right: 10px;">
                            <strong>${item.nome_produto}</strong> - R$ ${parseFloat(item.preco).toFixed(2).replace('.', ',')}
                            <p>${item.descricao}</p>
                        `;
                        itensConteudo.appendChild(itemDiv);
                    });
                } else {
                    // Caso o cardápio não tenha itens
                    itensConteudo.innerHTML = '<p>Não há itens neste cardápio.</p>';
                }

                // Exibe o modal
                document.getElementById('modalItens').style.display = 'block';
            } catch (error) {
                console.error('Erro ao buscar itens do cardápio:', error);
            }
        }

        function fecharModal() {
            document.getElementById('modalItens').style.display = 'none';
        }
    </script>
</body>
</html>