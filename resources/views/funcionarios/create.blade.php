<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Funcionário</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Cadastrar Funcionário</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erros encontrados:</strong>

            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('funcionarios.store') }}"
        method="POST"
    >

        @csrf

        <div class="mb-3">
            <label class="form-label">Nome</label>

            <input
                type="text"
                name="nome"
                class="form-control"
                value="{{ old('nome') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Matrícula</label>

            <input
                type="text"
                name="matricula"
                class="form-control"
                value="{{ old('matricula') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Cargo</label>

            <input
                type="text"
                name="cargo"
                class="form-control"
                value="{{ old('cargo') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Setor</label>

            <select
                name="setor_id"
                class="form-select"
                required
            >
                <option value="">Selecione um setor</option>

                @foreach ($setores as $setor)

                    <option
                        value="{{ $setor->id }}"
                        {{ old('setor_id') == $setor->id ? 'selected' : '' }}
                    >
                        {{ $setor->nome }}
                    </option>

                @endforeach
            </select>
        </div>

        <button
            type="submit"
            class="btn btn-success"
        >
            Cadastrar
        </button>

        <a
            href="{{ route('funcionarios.index') }}"
            class="btn btn-secondary"
        >
            Voltar
        </a>

    </form>

</div>

</body>
</html>