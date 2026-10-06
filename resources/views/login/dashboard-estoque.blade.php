<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Painel - Controle de Estoque</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #1e293b;
        }

        .cabecalho {
            height: 70px;
            background: #1e293b;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
        }

        .cabecalho h2 {
            font-size: 21px;
        }

        .usuario-area {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .usuario-area span {
            font-size: 15px;
        }

        .btn-sair {
            border: none;
            background: #dc2626;
            color: white;
            padding: 9px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-sair:hover {
            background: #b91c1c;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .boas-vindas {
            margin-bottom: 30px;
        }

        .boas-vindas h1 {
            margin-bottom: 8px;
        }

        .boas-vindas p {
            color: #64748b;
        }

        .alerta {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(
                auto-fit,
                minmax(250px, 1fr)
            );
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            margin-bottom: 10px;
            color: #1e293b;
        }

        .card p {
            color: #64748b;
            margin-bottom: 18px;
            min-height: 45px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            background: #2563eb;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            font-weight: bold;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .btn-desabilitado {
            display: inline-block;
            background: #94a3b8;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            font-weight: bold;
        }

        @media (max-width: 700px) {

            .cabecalho {
                height: auto;
                padding: 20px;
                flex-direction: column;
                gap: 15px;
            }

            .usuario-area {
                flex-direction: column;
                gap: 10px;
            }

        }

    </style>

</head>

<body>


    <header class="cabecalho">

        <h2>
            Sistema de Controle de Estoque
        </h2>


        <div class="usuario-area">

            <span>
                Usuário:
                <strong>
                    {{ $usuario->nome }}
                </strong>
            </span>


            <form
                action="{{ route('estoque.logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="btn-sair"
                >
                    Sair
                </button>

            </form>

        </div>

    </header>


    <main class="container">


        @if (session('sucesso'))

            <div class="alerta">

                {{ session('sucesso') }}

            </div>

        @endif


        <section class="boas-vindas">

            <h1>
                Bem-vindo, {{ $usuario->nome }}!
            </h1>

            <p>
                Utilize as opções abaixo para acessar as funções do sistema.
            </p>

        </section>


        <section class="cards">


            <div class="card">

                <h3>
                    Cadastro de Produtos
                </h3>

                <p>
                    Cadastre, consulte, altere e exclua produtos do sistema.
                </p>

                <span class="btn-desabilitado">
                    Em desenvolvimento
                </span>

            </div>


            <div class="card">

                <h3>
                    Gestão de Estoque
                </h3>

                <p>
                    Registre entradas e saídas dos produtos do estoque.
                </p>

                <span class="btn-desabilitado">
                    Em desenvolvimento
                </span>

            </div>


            <div class="card">

                <h3>
                    Usuário Logado
                </h3>

                <p>
                    Nome: {{ $usuario->nome }}
                    <br>
                    E-mail: {{ $usuario->email }}
                </p>

            </div>


        </section>

    </main>

</body>

</html>