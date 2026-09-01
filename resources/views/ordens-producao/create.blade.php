<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Nova Ordem de Produção</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
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

        .secondary {
            background: #6c757d;
            color: white;
        }

        .error {
            color: #dc3545;
            margin-top: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Nova Ordem de Produção</h1>

    <form action="{{ route('ordens-producao.store') }}" method="POST">

        @csrf

        <div class="form-group">
            <label for="codigo_ordem">Código da Ordem</label>

            <input
                type="text"
                id="codigo_ordem"
                name="codigo_ordem"
                value="{{ old('codigo_ordem') }}"
                required
            >

            @error('codigo_ordem')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="setor_id">Setor</label>

            <select id="setor_id" name="setor_id" required>

                <option value="">Selecione um setor</option>

                @foreach($setores as $setor)
                    <option
                        value="{{ $setor->id }}"
                        {{ old('setor_id') == $setor->id ? 'selected' : '' }}
                    >
                        {{ $setor->nome }}
                    </option>
                @endforeach

            </select>

            @error('setor_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="responsavel_id">Responsável</label>

            <select id="responsavel_id" name="responsavel_id" required>

                <option value="">Selecione um responsável</option>

                @foreach($funcionarios as $funcionario)
                    <option
                        value="{{ $funcionario->id }}"
                        {{ old('responsavel_id') == $funcionario->id ? 'selected' : '' }}
                    >
                        {{ $funcionario->nome }}
                    </option>
                @endforeach

            </select>

            @error('responsavel_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="produto">Produto</label>

            <input
                type="text"
                id="produto"
                name="produto"
                value="{{ old('produto') }}"
                required
            >

            @error('produto')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="quantidade_planejada">Quantidade Planejada</label>

            <input
                type="number"
                step="0.01"
                id="quantidade_planejada"
                name="quantidade_planejada"
                value="{{ old('quantidade_planejada') }}"
                required
            >

            @error('quantidade_planejada')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="quantidade_produzida">Quantidade Produzida</label>

            <input
                type="number"
                step="0.01"
                id="quantidade_produzida"
                name="quantidade_produzida"
                value="{{ old('quantidade_produzida', 0) }}"
            >

            @error('quantidade_produzida')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="data_inicio">Data de Início</label>

            <input
                type="datetime-local"
                id="data_inicio"
                name="data_inicio"
                value="{{ old('data_inicio') }}"
                required
            >

            @error('data_inicio')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="data_fim">Data de Fim</label>

            <input
                type="datetime-local"
                id="data_fim"
                name="data_fim"
                value="{{ old('data_fim') }}"
            >

            @error('data_fim')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="status">Status</label>

            <select id="status" name="status" required>

                <option value="">Selecione o status</option>

                <option value="Pendente"
                    {{ old('status') == 'Pendente' ? 'selected' : '' }}>
                    Pendente
                </option>

                <option value="Em produção"
                    {{ old('status') == 'Em produção' ? 'selected' : '' }}>
                    Em produção
                </option>

                <option value="Concluída"
                    {{ old('status') == 'Concluída' ? 'selected' : '' }}>
                    Concluída
                </option>

                <option value="Cancelada"
                    {{ old('status') == 'Cancelada' ? 'selected' : '' }}>
                    Cancelada
                </option>

            </select>

            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="observacoes">Observações</label>

            <textarea
                id="observacoes"
                name="observacoes"
            >{{ old('observacoes') }}</textarea>

            @error('observacoes')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn primary">
            Salvar Ordem
        </button>

        <a
            href="{{ route('ordens-producao.index') }}"
            class="btn secondary"
        >
            Voltar
        </a>

    </form>

</div>

</body>
</html>
