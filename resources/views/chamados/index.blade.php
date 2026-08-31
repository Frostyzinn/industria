<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chamados de Manutenção</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <div class="container py-5">

        <!-- Cabeçalho -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="fw-bold text-primary">
                    Chamados de Manutenção
                </h1>

                <p class="text-muted mb-0">
                    Gerenciamento dos chamados dos equipamentos
                </p>
            </div>

            <a
                href="{{ route('chamados.create') }}"
                class="btn btn-primary"
            >
                + Abrir Novo Chamado
            </a>

        </div>


        <!-- Mensagem de sucesso -->
        @if (session('success'))

            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        <!-- Lista de chamados -->
        @if ($chamados->isEmpty())

            <div class="card shadow-sm border-0">

                <div class="card-body text-center py-5">

                    <h4 class="text-muted">
                        Nenhum chamado encontrado
                    </h4>

                    <p class="text-secondary">
                        Você ainda não possui chamados cadastrados.
                    </p>

                    <a
                        href="{{ route('chamados.create') }}"
                        class="btn btn-primary"
                    >
                        Abrir primeiro chamado
                    </a>

                </div>

            </div>

        @else

            <div class="row g-4">

                @foreach ($chamados as $chamado)

                    <div class="col-md-6 col-lg-4">

                        <div class="card shadow-sm border-0 h-100">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-start">

                                    <h5 class="card-title fw-bold">
                                        {{ $chamado->titulo }}
                                    </h5>

                                    @if ($chamado->status == 'aberto')

                                        <span class="badge bg-success">
                                            Aberto
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ $chamado->status }}
                                        </span>

                                    @endif

                                </div>

                                <hr>

                                <p class="mb-2">
                                    <strong>ID:</strong>
                                    {{ $chamado->id }}
                                </p>

                                <p class="mb-3">
                                    <strong>Equipamento:</strong>
                                    {{ $chamado->equipamento_id }}
                                </p>


                                <!-- Botões -->
                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('chamados.show', $chamado->id) }}"
                                        class="btn btn-outline-primary btn-sm"
                                    >
                                        Ver
                                    </a>

                                    <a
                                        href="{{ route('chamados.edit', $chamado->id) }}"
                                        class="btn btn-outline-warning btn-sm"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('chamados.destroy', $chamado->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este chamado?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-outline-danger btn-sm"
                                        >
                                            Excluir
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>


    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>

</html>