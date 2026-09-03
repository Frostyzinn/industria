<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">

    <title>Equipamentos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #007bff;
        }

        .btn-warning {
            background: #ffc107;
            color: #000;
        }

        .btn-danger {
            background: #dc3545;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f1f1f1;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            background: #d4edda;
            color: #155724;
        }

        .acoes {
            display: flex;
            gap: 5px;
        }

        .status {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 13px;
        }

        .ativo {
            background: #d4edda;
            color: #155724;
        }

        .inativo {
            background: #f8d7da;
            color: #721c24;
        }

        /* Estilo do formulário */
        .filtros {
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 15px;
            background: #f1f1f1;
            border-radius: 5px;
        }

        .filtros label {
            margin-right: 5px;
            font-weight: bold;
        }

        .filtros input,
        .filtros select {
            padding: 8px;
            margin-right: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Equipamentos</h1>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('equipamentos.create') }}"
       class="btn btn-primary">
        + Novo equipamento
    </a>

    {{-- FORMULÁRIO DE FILTROS --}}
    <form action="{{ route('equipamentos.index') }}"
          method="GET"
          class="filtros">

        {{-- NOME --}}
        <label for="nome">Nome:</label>

        <input
            type="text"
            name="nome"
            id="nome"
            value="{{ request('nome') }}"
        >


        {{-- STATUS --}}
        <label for="status">Status:</label>

        <select name="status" id="status">

            <option value="">Todos</option>

            <option value="ativo"
                {{ request('status') == 'ativo' ? 'selected' : '' }}>
                Ativo
            </option>

            <option value="manutencao"
                {{ request('status') == 'manutencao' ? 'selected' : '' }}>
                Manutenção
            </option>

            <option value="inativo"
                {{ request('status') == 'inativo' ? 'selected' : '' }}>
                Inativo
            </option>

        </select>


        {{-- SETOR --}}
        <label for="setor_id">Setor:</label>

        <select name="setor_id" id="setor_id">

            <option value="">Todos</option>

            @foreach($setores as $setor)

                <option
                    value="{{ $setor->id }}"
                    {{ request('setor_id') == $setor->id ? 'selected' : '' }}
                >
                    {{ $setor->nome }}
                </option>

            @endforeach

        </select>


        {{-- PATRIMÔNIO --}}
        <label for="patrimonio">Patrimônio:</label>

        <input
            type="text"
            name="patrimonio"
            id="patrimonio"
            value="{{ request('patrimonio') }}"
        >


        {{-- BOTÃO --}}
        <button type="submit" class="btn btn-primary">
            Filtrar
        </button>

    </form>


    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Patrimônio</th>
                <th>Setor</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        @forelse($equipamentos as $equipamento)

            <tr>

                <td>
                    {{ $equipamento->id }}
                </td>

                <td>
                    {{ $equipamento->nome }}
                </td>

                <td>
                    {{ $equipamento->patrimonio }}
                </td>

                <td>
                    {{ $equipamento->setor?->nome ?? 'Sem setor' }}
                </td>

                <td>
                    <span class="status {{ $equipamento->status }}">
                        {{ ucfirst($equipamento->status) }}
                    </span>
                </td>

                <td>

                    <div class="acoes">

                        <a href="{{ route('equipamentos.show', $equipamento) }}"
                           class="btn btn-primary">
                            Visualizar
                        </a>

                        <a href="{{ route('equipamentos.edit', $equipamento) }}"
                           class="btn btn-warning">
                            Editar
                        </a>

                        <form action="{{ route('equipamentos.destroy', $equipamento) }}"
                              method="POST"
                              onsubmit="return confirm('Deseja realmente excluir este equipamento?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger">
                                Excluir
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6">
                    Nenhum equipamento cadastrado.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

    <br>

</div>

</body>
</html>
