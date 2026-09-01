<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Manutenções</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            color: #222;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #0d6efd;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #000;
        }

        .btn-danger {
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
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #222;
            color: white;
        }

        .alert {
            padding: 15px;
            background: #d1e7dd;
            color: #0f5132;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Manutenções</h1>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('manutencoes.create') }}"
       class="btn btn-primary">
        + Nova Manutenção
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Equipamento</th>
                <th>Funcionário</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Próxima</th>
                <th>Custo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        @forelse($manutencoes as $manutencao)

            <tr>
                <td>{{ $manutencao->id }}</td>

                <td>
                    {{ $manutencao->equipamento->nome ?? $manutencao->equipamento_id }}
                </td>

                <td>
                    {{ $manutencao->funcionario->nome ?? $manutencao->funcionario_id }}
                </td>

                <td>{{ $manutencao->tipo }}</td>

                <td>{{ $manutencao->descricao }}</td>

                <td>
                    {{ $manutencao->data_manutencao?->format('d/m/Y') }}
                </td>

                <td>
                    {{ $manutencao->proxima_manutencao?->format('d/m/Y') ?? '-' }}
                </td>

                <td>
                    R$ {{ number_format($manutencao->custo ?? 0, 2, ',', '.') }}
                </td>

                <td>{{ $manutencao->status }}</td>

                <td>
                    <a href="{{ route('manutencoes.edit', $manutencao) }}"
                       class="btn btn-warning">
                        Editar
                    </a>

                    <form action="{{ route('manutencoes.destroy', $manutencao) }}"
                          method="POST"
                          onsubmit="return confirm('Deseja realmente excluir esta manutenção?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger">
                            Excluir
                        </button>

                    </form>
                </td>
            </tr>

        @empty

            <tr>
                <td colspan="10">
                    Nenhuma manutenção cadastrada.
                </td>
            </tr>

        @endforelse

        </tbody>
    </table>

</div>

</body>
</html>
