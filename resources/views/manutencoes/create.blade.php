<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Nova Manutenção</title>

    <style>
        body {
            font-family: Arial;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        textarea {
            height: 120px;
        }

        button, a {
            margin-top: 20px;
            padding: 10px 15px;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }

        .btn {
            background: #0d6efd;
            color: white;
        }

        .back {
            background: #6c757d;
            color: white;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Nova Manutenção</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('manutencoes.store') }}" method="POST">

        @csrf

        <label>Equipamento</label>

        <select name="equipamento_id" required>
            <option value="">Selecione</option>

            @foreach($equipamentos as $equipamento)
                <option value="{{ $equipamento->id }}">
                    {{ $equipamento->nome ?? 'Equipamento #' . $equipamento->id }}
                </option>
            @endforeach
        </select>


        <label>Funcionário responsável</label>

        <select name="funcionario_id" required>
            <option value="">Selecione</option>

            @foreach($funcionarios as $funcionario)
                <option value="{{ $funcionario->id }}">
                    {{ $funcionario->nome ?? 'Funcionário #' . $funcionario->id }}
                </option>
            @endforeach
        </select>


        <label>Tipo</label>

        <select name="tipo" required>
            <option value="">Selecione</option>
            <option value="Preventiva">Preventiva</option>
            <option value="Corretiva">Corretiva</option>
            <option value="Preditiva">Preditiva</option>
        </select>


        <label>Descrição</label>

        <textarea name="descricao" required>{{ old('descricao') }}</textarea>


        <label>Data da manutenção</label>

        <input type="date"
               name="data_manutencao"
               value="{{ old('data_manutencao') }}"
               required>


        <label>Próxima manutenção</label>

        <input type="date"
               name="proxima_manutencao"
               value="{{ old('proxima_manutencao') }}">


        <label>Custo</label>

        <input type="number"
               name="custo"
               step="0.01"
               min="0"
               value="{{ old('custo') }}">


        <label>Status</label>

        <select name="status" required>
            <option value="Pendente">Pendente</option>
            <option value="Em andamento">Em andamento</option>
            <option value="Concluída">Concluída</option>
        </select>


        <button type="submit" class="btn">
            Salvar
        </button>

        <a href="{{ route('manutencoes.index') }}" class="back">
            Voltar
        </a>

    </form>

</div>

</body>
</html>
