<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Funcionário</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-5">

    <h1>Dados do Funcionário</h1>

    <div class="card mt-4">

        <div class="card-body">

            <p>
                <strong>Nome:</strong>
                {{ $funcionario->nome }}
            </p>

            <p>
                <strong>Matrícula:</strong>
                {{ $funcionario->matricula }}
            </p>

            <p>
                <strong>Cargo:</strong>
                {{ $funcionario->cargo }}
            </p>

            <p>
                <strong>Setor:</strong>
                {{ $funcionario->setor->nome ?? 'Sem setor' }}
            </p>

            <a
                href="{{ route('funcionarios.index') }}"
                class="btn btn-secondary"
            >
                Voltar
            </a>

        </div>

    </div>

</div>

</body>

</html>