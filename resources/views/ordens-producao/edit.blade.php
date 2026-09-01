<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Ordem</title>

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
            box-sizing: border-box;
            margin-top: 5px;
        }

        textarea {
            height: 100px;
        }

        button, a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            border: none;
            text-decoration: none;
        }

        button {
            background: #198754;
            color: white;
            cursor: pointer;
        }

        .back {
            background: #6c757d;
            color: white;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Editar Ordem de Produção</h1>

    <form
        action="{{ route('ordens-producao.update', $ordens_producao) }}"
        method="POST">

        @csrf
        @method('PUT')


        <label>Setor</label>

        <select name="setor_id" required>

            @foreach($setores as $setor)

                <option value="{{ $setor->id }}"
                    {{ $ordens_producao->setor_id == $setor->id ? 'selected' : '' }}>

                    {{ $setor->nome ?? 'Setor #' . $setor->id }}

                </option>

            @endforeach

        </select>


        <label>Responsável</label>

        <select name="responsavel_id" required>

            @foreach($funcionarios as $funcionario)

                <option value="{{ $funcionario->id }}"
                    {{ $ordens_producao->responsavel_id == $funcionario->id ? 'selected' : '' }}>

                    {{ $funcionario->nome ?? 'Funcionário #' . $funcionario->id }}

                </option>

            @endforeach

        </select>


        <label>Código da ordem</label>

        <input type="text"
               name="codigo_ordem"
               value="{{ $ordens_producao->codigo_ordem }}"
               maxlength="30"
               required>


        <label>Produto</label>

        <input type="text"
               name="produto"
               value="{{ $ordens_producao->produto }}"
               maxlength="100"
               required>


        <label>Quantidade planejada</label>

        <input type="number"
               name="quantidade_planejada"
               value="{{ $ordens_producao->quantidade_planejada }}"
               min="1"
               required>


        <label>Quantidade produzida</label>

        <input type="number"
               name="quantidade_produzida"
               value="{{ $ordens_producao->quantidade_produzida }}"
               min="0"
               required>


        <label>Data de início</label>

        <input type="datetime-local"
               name="data_inicio"
               value="{{ $ordens_producao->data_inicio?->format('Y-m-d\TH:i') }}">


        <label>Data de fim</label>

        <input type="datetime-local"
               name="data_fim"
               value="{{ $ordens_producao->data_fim?->format('Y-m-d\TH:i') }}">


        <label>Status</label>

        <select name="status" required>

            <option value="Aberta"
                {{ $ordens_producao->status == 'Aberta' ? 'selected' : '' }}>
                Aberta
            </option>

            <option value="Em produção"
                {{ $ordens_producao->status == 'Em produção' ? 'selected' : '' }}>
                Em produção
            </option>

            <option value="Finalizada"
                {{ $ordens_producao->status == 'Finalizada' ? 'selected' : '' }}>
                Finalizada
            </option>

        </select>


        <label>Observações</label>

        <textarea name="observacoes">{{ $ordens_producao->observacoes }}</textarea>


        <button type="submit">
            Atualizar
        </button>

        <a href="{{ route('ordens-producao.index') }}"
           class="back">
            Voltar
        </a>

    </form>

</div>

</body>
</html>
