<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nova Tarefa</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f5f7;
            margin: 0;
            padding: 0;
            color: #222;
        }

        /* CABEÇALHO */

        .topo {
            width: 100%;
            background: #555;
            color: white;
            padding: 20px 40px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topo h1 {
            margin: 0;
            font-size: 24px;
        }

        .menu {
            display: flex;
            gap: 30px;
        }

        .menu a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        /* CONTAINER */

        .container {
            width: 90%;
            max-width: 700px;

            margin: 45px auto;

            background: white;

            padding: 35px;

            border-radius: 10px;

            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.10);
        }

        .titulo {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .titulo h2 {
            margin: 0 0 8px 0;
            font-size: 27px;
        }

        .titulo p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        /* CAMPOS */

        .campo {
            margin-bottom: 20px;
        }

        label {
            display: block;

            font-weight: bold;

            margin-bottom: 8px;

            font-size: 14px;
        }

        input,
        textarea,
        select {
            width: 100%;

            padding: 12px;

            border: 1px solid #ccc;

            border-radius: 6px;

            background: white;

            font-size: 14px;

            transition: 0.2s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;

            border-color: #666;

            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
        }

        textarea {
            resize: vertical;
            min-height: 110px;
        }

        /* DUAS COLUNAS */

        .linha {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 18px;
        }

        /* ERROS */

        .erros {
            color: #991b1b;

            background: #fee2e2;

            border: 1px solid #fecaca;

            padding: 15px 20px;

            margin-bottom: 25px;

            border-radius: 6px;
        }

        .erros ul {
            margin: 0;
            padding-left: 20px;
        }

        .erros li {
            margin: 5px 0;
        }

        /* BOTÕES */

        .botoes {
            display: flex;

            justify-content: flex-end;

            gap: 10px;

            margin-top: 30px;

            padding-top: 20px;

            border-top: 1px solid #ddd;
        }

        .btn {
            border: none;

            padding: 11px 20px;

            border-radius: 6px;

            cursor: pointer;

            text-decoration: none;

            font-size: 14px;

            font-weight: bold;

            transition: 0.2s;
        }

        .salvar {
            background: #555;
            color: white;
        }

        .salvar:hover {
            background: #333;
        }

        .voltar {
            background: #ddd;
            color: #222;
        }

        .voltar:hover {
            background: #ccc;
        }

        /* RESPONSIVO */

        @media (max-width: 650px) {

            .topo {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 20px;
            }

            .menu {
                flex-wrap: wrap;
                gap: 15px;
            }

            .linha {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .container {
                padding: 25px 20px;
            }

            .botoes {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>


<!-- CABEÇALHO -->

<header class="topo">

    <h1>Gerenciamento de Tarefas</h1>

    <nav class="menu">

        <a href="{{ url('/usuarios') }}">
            Cadastro de Usuários
        </a>

        <a href="{{ route('tarefas.create') }}">
            Cadastro de Tarefas
        </a>

        <a href="{{ route('tarefas.index') }}">
            Gerenciar Tarefas
        </a>

    </nav>

</header>


<!-- CONTEÚDO -->

<div class="container">


    <div class="titulo">

        <h2>Nova Tarefa</h2>

        <p>
            Preencha os dados abaixo para cadastrar uma nova tarefa.
        </p>

    </div>


    <!-- ERROS -->

    @if($errors->any())

        <div class="erros">

            <ul>

                @foreach($errors->all() as $erro)

                    <li>
                        {{ $erro }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- FORMULÁRIO -->

    <form
        action="{{ route('tarefas.store') }}"
        method="POST"
    >

        @csrf


        <!-- DESCRIÇÃO -->

        <div class="campo">

            <label for="descricao">
                Descrição
            </label>

            <textarea
                name="descricao"
                id="descricao"
                placeholder="Digite a descrição da tarefa"
                maxlength="100"
                required
            >{{ old('descricao') }}</textarea>

        </div>


        <!-- SETOR -->

        <div class="campo">

            <label for="setor">
                Setor
            </label>

            <input
                type="text"
                name="setor"
                id="setor"
                value="{{ old('setor') }}"
                placeholder="Ex: TI, RH, Financeiro"
                maxlength="100"
                required
            >

        </div>


        <!-- PRIORIDADE E STATUS -->

        <div class="linha">


            <!-- PRIORIDADE -->

            <div class="campo">

                <label for="prioridade">
                    Prioridade
                </label>

                <select
                    name="prioridade"
                    id="prioridade"
                    required
                >

                    <option value="">
                        Selecione a prioridade
                    </option>


                    <option
                        value="baixa"
                        {{ old('prioridade') == 'baixa' ? 'selected' : '' }}
                    >
                        Baixa
                    </option>


                    <option
                        value="media"
                        {{ old('prioridade') == 'media' ? 'selected' : '' }}
                    >
                        Média
                    </option>


                    <option
                        value="alta"
                        {{ old('prioridade') == 'alta' ? 'selected' : '' }}
                    >
                        Alta
                    </option>

                </select>

            </div>


            <!-- STATUS -->

            <div class="campo">

                <label for="status">
                    Status
                </label>

                <select
                    name="status"
                    id="status"
                    required
                >

                    <option
                        value="a fazer"
                        {{ old('status', 'a fazer') == 'a fazer' ? 'selected' : '' }}
                    >
                        A Fazer
                    </option>


                    <option
                        value="fazendo"
                        {{ old('status') == 'fazendo' ? 'selected' : '' }}
                    >
                        Fazendo
                    </option>


                    <option
                        value="pronto"
                        {{ old('status') == 'pronto' ? 'selected' : '' }}
                    >
                        Pronto
                    </option>

                </select>

            </div>

        </div>


        <!-- USUÁRIO -->

        <div class="campo">

            <label for="usuario_id">
                Usuário Responsável
            </label>

            <select
                name="usuario_id"
                id="usuario_id"
                required
            >

                <option value="">
                    Selecione um usuário
                </option>


                @foreach($usuarios as $usuario)

                    <option
                        value="{{ $usuario->id }}"
                        {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}
                    >

                        {{ $usuario->nome }}

                    </option>

                @endforeach

            </select>

        </div>


        <!-- BOTÕES -->

        <div class="botoes">

            <a
                href="{{ route('tarefas.index') }}"
                class="btn voltar"
            >
                Voltar
            </a>


            <button
                type="submit"
                class="btn salvar"
            >
                Salvar Tarefa
            </button>

        </div>


    </form>

</div>


</body>

</html> 