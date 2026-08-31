<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Abrir Chamado</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e293b;
        }

        .container {
            width: 100%;
            max-width: 550px;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .titulo {
            text-align: center;
            margin-bottom: 10px;
            color: #1e40af;
            font-size: 28px;
        }

        .subtitulo {
            text-align: center;
            color: #64748b;
            margin-bottom: 25px;
        }

        .usuario {
            background: #eff6ff;
            border-left: 4px solid #2563eb;
            padding: 12px 15px;
            margin-bottom: 25px;
            border-radius: 5px;
        }

        .usuario strong {
            color: #1d4ed8;
        }

        .campo {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
            color: #334155;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: 0.2s;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .erro {
            color: #dc2626;
            font-size: 14px;
            margin-top: 6px;
        }

        .botoes {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border: none;
            transition: 0.2s;
        }

        .btn-criar {
            background: #2563eb;
            color: white;
        }

        .btn-criar:hover {
            background: #1d4ed8;
        }

        .btn-voltar {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-voltar:hover {
            background: #cbd5e1;
        }

        .info {
            margin-top: 20px;
            padding: 12px;
            background: #f8fafc;
            border-radius: 8px;
            font-size: 13px;
            color: #64748b;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card">

            <h1 class="titulo">
                Abrir Chamado
            </h1>

            <p class="subtitulo">
                Chamado de Manutenção
            </p>

            <div class="usuario">
                Técnico logado:
                <strong>{{ Auth::user()->name }}</strong>
            </div>

            <form action="{{ route('chamados.store') }}" method="POST">

                @csrf

                <div class="campo">

                    <label for="titulo">
                        Título do chamado
                    </label>

                    <input
                        type="text"
                        name="titulo"
                        id="titulo"
                        value="{{ old('titulo') }}"
                        maxlength="150"
                        placeholder="Ex: Motor apresentou defeito"
                    >

                    @error('titulo')
                        <p class="erro">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div class="campo">

                    <label for="equipamento_id">
                        ID do equipamento
                    </label>

                    <input
                        type="number"
                        name="equipamento_id"
                        id="equipamento_id"
                        value="{{ old('equipamento_id') }}"
                        placeholder="Ex: 1"
                    >

                    @error('equipamento_id')
                        <p class="erro">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div class="botoes">

                    <button
                        type="submit"
                        class="btn btn-criar"
                    >
                        Abrir Chamado
                    </button>

                    <a
                        href="{{ route('chamados.index') }}"
                        class="btn btn-voltar"
                    >
                        Voltar
                    </a>

                </div>

            </form>

            <div class="info">
                O técnico responsável será registrado
                automaticamente pelo sistema.
            </div>

        </div>

    </div>

</body>

</html>