<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Funcionários</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Funcionários</h1>

        <a
            href="{{ route('funcionarios.create') }}"
            class="btn btn-success"
        >
            + Novo Funcionário
        </a>

    </div>


    @if (session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>

                <th>Nome</th>

                <th>Matrícula</th>

                <th>Cargo</th>

                <th>Setor</th>

                <th>Ações</th>

            </tr>

        </thead>

        <tbody>

            @forelse ($funcionarios as $funcionario)

                <tr>

                    <td>
                        {{ $funcionario->nome }}
                    </td>

                    <td>
                        {{ $funcionario->matricula }}
                    </td>

                    <td>
                        {{ $funcionario->cargo }}
                    </td>

                    <td>
                        {{ $funcionario->setor->nome ?? 'Sem setor' }}
                    </td>

                    <td>

                        <a
                            href="{{ route('funcionarios.edit', $funcionario) }}"
                            class="btn btn-primary btn-sm"
                        >
                            Editar
                        </a>


                        <form
                            action="{{ route('funcionarios.destroy', $funcionario) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Deseja realmente excluir este funcionário?')"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                            >
                                Excluir
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="5"
                        class="text-center"
                    >
                        Nenhum funcionário cadastrado.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

</body>

</html>