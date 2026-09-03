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


    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('funcionarios.index') }}">

                <div class="row g-3">

                    {{-- Nome --}}
                    <div class="col-md-3">

                        <label for="nome" class="form-label">
                            Nome
                        </label>

                        <input
                            type="text"
                            name="nome"
                            id="nome"
                            class="form-control"
                            value="{{ request('nome') }}"
                            placeholder="Digite o nome"
                        >

                    </div>


                    {{-- Cargo --}}
                    <div class="col-md-3">

                        <label for="cargo" class="form-label">
                            Cargo
                        </label>

                        <select
                            name="cargo"
                            id="cargo"
                            class="form-select"
                        >

                            <option value="">
                                Todos os cargos
                            </option>

                            @foreach ($cargos as $cargo)

                                <option
                                    value="{{ $cargo }}"
                                    {{ request('cargo') == $cargo ? 'selected' : '' }}
                                >
                                    {{ $cargo }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Setor --}}
                    <div class="col-md-3">

                        <label for="setor_id" class="form-label">
                            Setor
                        </label>

                        <select
                            name="setor_id"
                            id="setor_id"
                            class="form-select"
                        >

                            <option value="">
                                Todos os setores
                            </option>

                            @foreach ($setores as $setor)

                                <option
                                    value="{{ $setor->id }}"
                                    {{ request('setor_id') == $setor->id ? 'selected' : '' }}
                                >
                                    {{ $setor->nome }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Matrícula --}}
                    <div class="col-md-3">

                        <label for="matricula" class="form-label">
                            Matrícula
                        </label>

                        <input
                            type="text"
                            name="matricula"
                            id="matricula"
                            class="form-control"
                            value="{{ request('matricula') }}"
                            placeholder="Digite a matrícula"
                        >

                    </div>


                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Filtrar</button>

                        <a
                            href="{{ route('funcionarios.index') }}"
                            class="btn btn-secondary"
                        >
                            Limpar
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    @if (session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    {{-- TABELA --}}
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
                        <ahref="{{ route('funcionarios.edit', $funcionario) }}"class="btn btn-primary btn-sm">Editar</a>


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
