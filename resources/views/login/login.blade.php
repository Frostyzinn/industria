<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Controle de Estoque</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .login-container h1 {
            text-align: center;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .login-container .subtitulo {
            text-align: center;
            color: #64748b;
            margin-bottom: 30px;
        }

        .campo {
            margin-bottom: 18px;
        }

        .campo label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-weight: bold;
        }

        .campo input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            outline: none;
            font-size: 15px;
        }

        .campo input:focus {
            border-color: #2563eb;
        }

        .botao {
            width: 100%;
            border: none;
            background: #2563eb;
            color: white;
            padding: 13px;
            border-radius: 7px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .botao:hover {
            background: #1d4ed8;
        }

        .alerta {
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 18px;
        }

        .erro {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .sucesso {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .lista-erros {
            margin-left: 20px;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <h1>Controle de Estoque</h1>

        <p class="subtitulo">
            Entre com seus dados para acessar o sistema
        </p>


        {{-- Mensagem de erro enviada pelo Controller --}}
        @if (session('erro'))

            <div class="alerta erro">
                {{ session('erro') }}
            </div>

        @endif


        {{-- Mensagem de sucesso --}}
        @if (session('sucesso'))

            <div class="alerta sucesso">
                {{ session('sucesso') }}
            </div>

        @endif


        {{-- Erros da validação --}}
        @if ($errors->any())

            <div class="alerta erro">

                <ul class="lista-erros">

                    @foreach ($errors->all() as $erro)

                        <li>{{ $erro }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('estoque.login.autenticar') }}"
            method="POST"
        >

            @csrf


            <div class="campo">

                <label for="email">
                    E-mail
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Digite seu e-mail"
                >

            </div>


            <div class="campo">

                <label for="senha">
                    Senha
                </label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                >

            </div>


            <button
                type="submit"
                class="botao"
            >
                Entrar
            </button>

        </form>

    </div>

</body>

</html>