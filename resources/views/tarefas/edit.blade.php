<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Tarefa</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f5f7;
            color: #333;
            min-height: 100vh;
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
            font-size: 22px;
        }

        .menu {
            display: flex;
            gap: 25px;
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
            width: 92%;
            max-width: 700px;
            margin: 45px auto;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 35px;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.10);
        }

        .card-header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e5e5;
        }

        .card-header h2 {
            font-size: 26px;
            margin-bottom: 7px;
        }

        .card-header p {
            color: #777;
            font-size: 14px;
        }

        /* CAMPOS */

        .campo {
            margin-bottom: 22px;
        }

        .campo label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .campo input,
        .campo textarea,
        .campo select {
            width: 100%;
            padding: 12px 13px;

            border: 1px solid #ccc;
            border-radius: 6px;

            background: white;
            color: #333;

            font-size: 14px;

            transition: 0.2s;
        }

        .campo input:focus,
        .campo textarea:focus,
        .campo select:focus {
            outline: none;
            border-color: #666;

            box-shadow:
                0 0 0 3px rgba(0, 0, 0, 0.05);
        }

        .campo textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* DUAS COLUNAS */

        .linha {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        /* PRIORIDADE */

        .prioridade-info {
            font-size: 12px;
            color: #777;
            margin-top: 6px;
        }

        /* ERROS */

        .erros {
            background: #fee2e2;
            color: #991b1b;

            border: 1px solid #fecaca;
            border-radius: 6px;

            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .erros ul {
            padding-left: 20px;
        }

        .erros li {
            margin: 4px 0;
        }

        /* BOTÕES */

        .botoes {
            display: flex;
            justify-content: flex-end;
            gap: 10px;

            margin-top: 30px;
            padding-top: 22px;

            border-top: 1px solid #e5e5e5;
        }

        .btn {
            display: inline-block;

            padding: 11px 20px;

            border: none;
            border-radius: 6px;

            font-size: 14px;
            font-weight: bold;

            cursor: pointer;
            text-decoration: none;

            transition: 0.2s;
        }

        .btn-salvar {
            background: #555;
            color: white;
        }

        .btn-salvar:hover {
            background: #333;
        }

        .btn-cancelar {
            background: #e5e5e5;
            color: #333;
        }

        .btn-cancelar:hover {
            background: #d5d5d5;
        }

        /* RESPONSIVO */

        @media (max-width: 650px) {

            .topo {
                padding: 18px 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .menu {
                flex-wrap: wrap;
                gap: 12px;
            }

            .linha {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .card {
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


    <main class="container">

        <div class="card">


            <div class="card-header">

                <h2>Editar Tarefa</h2>

                <p>
                    Altere as informações da tarefa abaixo.
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
                action="{{ route('tarefas.update', $tarefa->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <!-- TÍTULO -->

                <div class="campo">

                    <label for="titulo">
                        Título da tarefa
                    </label>

                    <input
                        type="text"
                        name="titulo"
                        id="titulo"
                        value="{{ old('titulo', $tarefa->titulo) }}"
                        placeholder="Digite o título da tarefa"
                        required
                    >

                </div>


                <!-- DESCRIÇÃO -->

                <div class="campo">

                    <label for="descricao">
                        Descrição
                    </label>

                    <textarea
                        name="descricao"
                        id="descricao"
                        placeholder="Descreva a tarefa"
                        required
                    >{{ old('descricao', $tarefa->descricao) }}</textarea>

                </div>


                <!-- SETOR + PRIORIDADE -->

                <div class="linha">


                    <!-- SETOR -->

                    <div class="campo">

                        <label for="setor">
                            Setor
                        </label>

                        <input
                            type="text"
                            name="setor"
                            id="setor"
                            value="{{ old('setor', $tarefa->setor) }}"
                            placeholder="Ex: TI, RH, Financeiro"
                            required
                        >

                    </div>


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

                            <option
                                value="baixa"
                                {{ old('prioridade', $tarefa->prioridade) == 'baixa' ? 'selected' : '' }}
                            >
                                Baixa
                            </option>


                            <option
                                value="media"
                                {{ old('prioridade', $tarefa->prioridade) == 'media' ? 'selected' : '' }}
                            >
                                Média
                            </option>


                            <option
                                value="alta"
                                {{ old('prioridade', $tarefa->prioridade) == 'alta' ? 'selected' : '' }}
                            >
                                Alta
                            </option>

                        </select>

                        <div class="prioridade-info">
                            Escolha entre Baixa, Média ou Alta.
                        </div>

                    </div>

                </div>


                <!-- USUÁRIO -->

                <div class="campo">

                    <label for="usuario_id">
                        Usuário responsável
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
                                {{ old('usuario_id', $tarefa->usuario_id) == $usuario->id ? 'selected' : '' }}
                            >

                                {{ $usuario->nome }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- STATUS -->

                <div class="campo">

                    <label for="status">
                        Status da tarefa
                    </label>

                    <select
                        name="status"
                        id="status"
                        required
                    >


                        <!-- A FAZER -->

                        <option
                            value="a fazer"
                            {{ old('status', $tarefa->status) == 'a fazer' ? 'selected' : '' }}
                        >
                            A Fazer
                        </option>


                        <!-- FAZENDO -->

                        <option
                            value="fazendo"
                            {{ old('status', $tarefa->status) == 'fazendo' ? 'selected' : '' }}
                        >
                            Fazendo
                        </option>


                        <!-- PRONTO -->

                        <option
                            value="pronto"
                            {{ old('status', $tarefa->status) == 'pronto' ? 'selected' : '' }}
                        >
                            Pronto
                        </option>


                    </select>

                </div>


                <!-- BOTÕES -->

                <div class="botoes">

                    <a
                        href="{{ route('tarefas.index') }}"
                        class="btn btn-cancelar"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="btn btn-salvar"
                    >
                        Salvar Alterações
                    </button>

                </div>


            </form>

        </div>

    </main>

</body>

</html>