<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Ordens de Produção</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 1300px;
            margin: auto;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .primary {
            background: #0d6efd;
            color: white;
        }

        .warning {
            background: #ffc107;
            color: black;
        }

        .danger {
            background: #dc3545;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background: #222;
            color: white;
        }

        .alert {
            padding: 15px;
            background: #d1e7dd;
            color: #0f5132;
            margin: 20px 0;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Ordens de Produção</h1>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('ordens-producao.create') }}"
       class="btn primary">

        + Nova Ordem de Produção

    </a>

    <table>

        <thead>

            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Setor</th>
                <th>Responsável</th>
                <th>Produto</th>
                <th>Planejada</th>
                <th>Produzida</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>

        </thead>

        <tbody>

        @forelse($ordens as $ordem)

            <tr>

                <td>{{ $ordem->id }}</td>

                <td>{{ $ordem->codigo_ordem }}</td>

                <td>
                    {{ $ordem->setor->nome ?? $ordem->setor_id }}
                </td>

                <td>
                    {{ $ordem->responsavel->nome ?? $ordem->responsavel_id }}
                </td>

                <td>{{ $ordem->produto }}</td>

                <td>{{ $ordem->quantidade_planejada }}</td>

                <td>{{ $ordem->quantidade_produzida }}</td>

                <td>
                    {{ $ordem->data_inicio?->format('d/m/Y H:i') ?? '-' }}
                </td>

                <td>
                    {{ $ordem->data_fim?->format('d/m/Y H:i') ?? '-' }}
                </td>

                <td>{{ $ordem->status }}</td>

                <td>

                    <a href="{{ route('ordens-producao.edit', $ordem) }}"
                       class="btn warning">
                        Editar
                    </a>

                    <form
                        action="{{ route('ordens-producao.destroy', $ordem) }}"
                        method="POST"
                        onsubmit="return confirm('Deseja excluir esta ordem?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn danger">
                            Excluir
                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="11">
                    Nenhuma ordem de produção cadastrada.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>
</html>
    