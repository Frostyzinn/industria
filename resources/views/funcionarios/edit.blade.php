<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Editar Funcionário</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erros encontrados:</strong>
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('funcionarios.update', $funcionario) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input 
                type="text" 
                name="nome" 
                class="form-control" 
                value="{{ old('nome', $funcionario->nome) }}" 
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Matrícula</label>
            <input 
                type="text" 
                name="matricula" 
                class="form-control" 
                value="{{ old('matricula', $funcionario->matricula) }}" 
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Cargo</label>
            <input 
                type="text" 
                name="cargo" 
                class="form-control" 
                value="{{ old('cargo', $funcionario->cargo) }}" 
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Setor</label>
            <select name="setor_id" class="form-select" required>
                @foreach ($setores as $setor)
                    <option 
                        value="{{ $setor->id }}"
                        {{ old('setor_id', $funcionario->setor_id) == $setor->id ? 'selected' : '' }}
                    >
                        {{ $setor->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Atualizar
        </button>

        <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>

</div>

</body>

</html>