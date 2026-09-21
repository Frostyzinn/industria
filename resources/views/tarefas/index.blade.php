<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciamento de Tarefas</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            color: #222;
        }

        /* CABEÇALHO */

        .topo {
            background: #555;
            color: white;
            padding: 22px 40px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topo h1 {
            font-size: 25px;
        }

        .menu {
            display: flex;
            gap: 35px;
        }

        .menu a {
            color: white;
            text-decoration: none;
            font-size: 15px;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        /* CONTEÚDO */

        .container {
            width: 94%;
            margin: 40px auto;
        }

        .container > h2 {
            font-size: 30px;
            margin-bottom: 30px;
        }

        /* SUCESSO */

        .sucesso {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
            padding: 15px 18px;
            border-radius: 6px;
            margin-bottom: 30px;
        }

        /* QUADRO */

        .kanban {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        /* COLUNAS */

        .coluna {
            background: #eeeeee;
            border-radius: 8px;
            padding: 20px;
            min-height: 400px;
        }

        .coluna h3 {
            font-size: 22px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #ccc;
        }

        /* CARDS */

        .card {
            background: white;
            border: 1px solid #d0d0d0;
            border-radius: 7px;

            padding: 18px;
            margin-bottom: 18px;

            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }

        .card p {
            margin-bottom: 8px;
            line-height: 1.4;
        }

        /* PRIORIDADE */

        .baixa {
            color: green;
            font-weight: bold;
        }

        .media {
            color: #c47f00;
            font-weight: bold;
        }

        .alta {
            color: #c62828;
            font-weight: bold;
        }

        /* BOTÕES */

        .acoes {
            display: flex;
            gap: 8px;
            margin-top: 15px;
        }

        .btn {
            border: none;
            border-radius: 4px;
            padding: 9px 14px;

            font-size: 13px;
            cursor: pointer;
            text-decoration: none;

            display: inline-block;
        }

        .editar {
            background: #666;
            color: white;
        }

        .excluir {
            background: #444;
            color: white;
        }

        .alterar {
            background: #555;
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }

        /* ALTERAÇÃO DE STATUS */

        .status-form {
            display: flex;
            gap: 8px;
            margin-top: 15px;
        }

        .status-form select {
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 4px;
            background: white;
        }

        .vazio {
            color: #777;
            font-size: 14px;
        }

        /* RESPONSIVO */

        @media(max-width: 900px) {

            .kanban {
                grid-template-columns: 1fr;
            }

            .topo {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .menu {
                flex-wrap: wrap;
                gap: 15px;
            }
        }
    </style>
</head>


<body>

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

    <h2>Tarefas</h2>


    @if(session('success'))

        <div class="sucesso">
            {{ session('success') }}
        </div>

    @endif


    @php

        /*
        |--------------------------------------------------------------------------
        | SEPARA AS TAREFAS PELO STATUS
        |--------------------------------------------------------------------------
        */

        $aFazer = $tarefas->filter(function ($tarefa) {

            return strtolower(trim($tarefa->status ?? '')) === 'a fazer';

        });


        $fazendo = $tarefas->filter(function ($tarefa) {

            return strtolower(trim($tarefa->status ?? '')) === 'fazendo';

        });


        $pronto = $tarefas->filter(function ($tarefa) {

            return strtolower(trim($tarefa->status ?? '')) === 'pronto';

        });

    @endphp


    <div class="kanban">


        <!-- =========================================
             A FAZER
        ========================================== -->

        <section class="coluna">

            <h3>A Fazer</h3>


            @forelse($aFazer as $tarefa)


                <div class="card">


                    <p>
                        <strong>Descrição:</strong>
                        {{ $tarefa->descricao }}
                    </p>


                    <p>
                        <strong>Setor:</strong>
                        {{ $tarefa->setor }}
                    </p>


                    <p>

                        <strong>Prioridade:</strong>

                        <span class="{{ strtolower($tarefa->prioridade) }}">

                            {{ ucfirst($tarefa->prioridade) }}

                        </span>

                    </p>


                    <p>

                        <strong>Vinculado a:</strong>

                        {{ $tarefa->usuario->nome ?? 'Não atribuído' }}

                    </p>


                    <div class="acoes">


                        <a
                            href="{{ route('tarefas.edit', $tarefa->id) }}"
                            class="btn editar"
                        >
                            Editar
                        </a>


                        <form
                            action="{{ route('tarefas.destroy', $tarefa->id) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')


                            <button
                                type="submit"
                                class="btn excluir"
                            >
                                Excluir
                            </button>

                        </form>

                    </div>


                    <!-- ALTERAR STATUS -->

                    <form
                        action="{{ route('tarefas.update', $tarefa->id) }}"
                        method="POST"
                        class="status-form"
                    >

                        @csrf
                        @method('PUT')


                        <input
                            type="hidden"
                            name="descricao"
                            value="{{ $tarefa->descricao }}"
                        >

                        <input
                            type="hidden"
                            name="setor"
                            value="{{ $tarefa->setor }}"
                        >

                        <input
                            type="hidden"
                            name="prioridade"
                            value="{{ $tarefa->prioridade }}"
                        >

                        <input
                            type="hidden"
                            name="usuario_id"
                            value="{{ $tarefa->usuario_id }}"
                        >


                        <select name="status">

                            <option value="a fazer" selected>
                                A Fazer
                            </option>

                            <option value="fazendo">
                                Fazendo
                            </option>

                            <option value="pronto">
                                Pronto
                            </option>

                        </select>


                        <button
                            type="submit"
                            class="btn alterar"
                        >
                            Alterar Status
                        </button>

                    </form>


                </div>


            @empty


                <p class="vazio">
                    Nenhuma tarefa a fazer.
                </p>


            @endforelse

        </section>



        <!-- =========================================
             FAZENDO
        ========================================== -->

        <section class="coluna">

            <h3>Fazendo</h3>


            @forelse($fazendo as $tarefa)


                <div class="card">


                    <p>
                        <strong>Descrição:</strong>
                        {{ $tarefa->descricao }}
                    </p>


                    <p>
                        <strong>Setor:</strong>
                        {{ $tarefa->setor }}
                    </p>


                    <p>

                        <strong>Prioridade:</strong>

                        <span class="{{ strtolower($tarefa->prioridade) }}">

                            {{ ucfirst($tarefa->prioridade) }}

                        </span>

                    </p>


                    <p>

                        <strong>Vinculado a:</strong>

                        {{ $tarefa->usuario->nome ?? 'Não atribuído' }}

                    </p>


                    <div class="acoes">


                        <a
                            href="{{ route('tarefas.edit', $tarefa->id) }}"
                            class="btn editar"
                        >
                            Editar
                        </a>


                        <form
                            action="{{ route('tarefas.destroy', $tarefa->id) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')


                            <button
                                type="submit"
                                class="btn excluir"
                            >
                                Excluir
                            </button>

                        </form>

                    </div>


                    <!-- ALTERAR STATUS -->

                    <form
                        action="{{ route('tarefas.update', $tarefa->id) }}"
                        method="POST"
                        class="status-form"
                    >

                        @csrf
                        @method('PUT')


                        <input
                            type="hidden"
                            name="descricao"
                            value="{{ $tarefa->descricao }}"
                        >

                        <input
                            type="hidden"
                            name="setor"
                            value="{{ $tarefa->setor }}"
                        >

                        <input
                            type="hidden"
                            name="prioridade"
                            value="{{ $tarefa->prioridade }}"
                        >

                        <input
                            type="hidden"
                            name="usuario_id"
                            value="{{ $tarefa->usuario_id }}"
                        >


                        <select name="status">

                            <option value="a fazer">
                                A Fazer
                            </option>

                            <option value="fazendo" selected>
                                Fazendo
                            </option>

                            <option value="pronto">
                                Pronto
                            </option>

                        </select>


                        <button
                            type="submit"
                            class="btn alterar"
                        >
                            Alterar Status
                        </button>

                    </form>


                </div>


            @empty


                <p class="vazio">
                    Nenhuma tarefa fazendo.
                </p>


            @endforelse

        </section>



        <!-- =========================================
             PRONTO
        ========================================== -->

        <section class="coluna">

            <h3>Pronto</h3>


            @forelse($pronto as $tarefa)


                <div class="card">


                    <p>
                        <strong>Descrição:</strong>
                        {{ $tarefa->descricao }}
                    </p>


                    <p>
                        <strong>Setor:</strong>
                        {{ $tarefa->setor }}
                    </p>


                    <p>

                        <strong>Prioridade:</strong>

                        <span class="{{ strtolower($tarefa->prioridade) }}">

                            {{ ucfirst($tarefa->prioridade) }}

                        </span>

                    </p>


                    <p>

                        <strong>Vinculado a:</strong>

                        {{ $tarefa->usuario->nome ?? 'Não atribuído' }}

                    </p>


                    <div class="acoes">


                        <a
                            href="{{ route('tarefas.edit', $tarefa->id) }}"
                            class="btn editar"
                        >
                            Editar
                        </a>


                        <form
                            action="{{ route('tarefas.destroy', $tarefa->id) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')


                            <button
                                type="submit"
                                class="btn excluir"
                            >
                                Excluir
                            </button>

                        </form>

                    </div>


                    <!-- ALTERAR STATUS -->

                    <form
                        action="{{ route('tarefas.update', $tarefa->id) }}"
                        method="POST"
                        class="status-form"
                    >

                        @csrf
                        @method('PUT')


                        <input
                            type="hidden"
                            name="descricao"
                            value="{{ $tarefa->descricao }}"
                        >

                        <input
                            type="hidden"
                            name="setor"
                            value="{{ $tarefa->setor }}"
                        >

                        <input
                            type="hidden"
                            name="prioridade"
                            value="{{ $tarefa->prioridade }}"
                        >

                        <input
                            type="hidden"
                            name="usuario_id"
                            value="{{ $tarefa->usuario_id }}"
                        >


                        <select name="status">

                            <option value="a fazer">
                                A Fazer
                            </option>

                            <option value="fazendo">
                                Fazendo
                            </option>

                            <option value="pronto" selected>
                                Pronto
                            </option>

                        </select>


                        <button
                            type="submit"
                            class="btn alterar"
                        >
                            Alterar Status
                        </button>

                    </form>


                </div>


            @empty


                <p class="vazio">
                    Nenhuma tarefa pronta.
                </p>


            @endforelse

        </section>


    </div>

</main>

</body>

</html>