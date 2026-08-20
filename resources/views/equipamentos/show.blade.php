<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <title>Detalhes do Equipamento</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 40px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-bottom: 25px;
        }

        .campo {
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
        }

        .campo strong {
            display: block;
            color: #555;
            margin-bottom: 5px;
        }

        .campo span {
            font-size: 17px;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 14px;
        }

        .ativo {
            background: #d4edda;
            color: #155724;
        }

        .inativo {
            background: #f8d7da;
            color: #721c24;
        }

        .botoes {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #007bff;
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

        .btn-secondary {
            background: #6c757d;
            color: white;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Detalhes do Equipamento</h1>

    <div class="campo">
        <strong>ID</strong>

        <span>
            {{ $equipamento->id }}
        </span>
    </div>

    <div class="campo">
        <strong>Nome</strong>

        <span>
            {{ $equipamento->nome }}
        </span>
    </div>

    <div class="campo">
        <strong>Patrimônio</strong>

        <span>
            {{ $equipamento->patrimonio }}
        </span>
    </div>

    <div class="campo">
        <strong>Setor</strong>

        <span>
            {{ $equipamento->setor?->nome ?? 'Sem setor' }}
        </span>
    </div>

    <div class="campo">
        <strong>Status</strong>

        <span class="status {{ $equipamento->status }}">
            {{ ucfirst($equipamento->status) }}
        </span>
    </div>

    <div class="botoes">

        <a href="{{ route('equipamentos.index') }}"
           class="btn btn-secondary">
            Voltar
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

</div>

</body>

</html>
