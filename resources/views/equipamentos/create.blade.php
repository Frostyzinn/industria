<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <title>Novo Equipamento</title>

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
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Novo Equipamento</h1>

    @if($errors->any())

        <div class="error">

            <ul>

                @foreach($errors->all() as $erro)

                    <li>{{ $erro }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('equipamentos.store') }}"
          method="POST">

        @csrf

        <div class="form-group">

            <label for="nome">
                Nome
            </label>

            <input
                type="text"
                name="nome"
                id="nome"
                value="{{ old('nome') }}"
                maxlength="150"
                required
            >

        </div>

        <div class="form-group">

            <label for="patrimonio">
                Patrimônio
            </label>

            <input
                type="text"
                name="patrimonio"
                id="patrimonio"
                value="{{ old('patrimonio') }}"
                maxlength="30"
                required
            >

        </div>

        <div class="form-group">

            <label for="setor_id">
                Setor
            </label>

            <select name="setor_id" id="setor_id">

                <option value="">
                    -- Selecione um setor --
                </option>

                @foreach($setores as $setor)

                    <option
                        value="{{ $setor->id }}"
                        {{ old('setor_id') == $setor->id ? 'selected' : '' }}
                    >
                        {{ $setor->nome }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="form-group">

            <label for="status">
                Status
            </label>

            <select name="status" id="status">

                <option value="ativo"
                    {{ old('status', 'ativo') == 'ativo' ? 'selected' : '' }}>
                    Ativo
                </option>

                <option value="inativo"
                    {{ old('status') == 'inativo' ? 'selected' : '' }}>
                    Inativo
                </option>

            </select>

        </div>

        <button type="submit"
                class="btn btn-primary">
            Salvar
        </button>

        <a href="{{ route('equipamentos.index') }}"
           class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

</body>
</html>
