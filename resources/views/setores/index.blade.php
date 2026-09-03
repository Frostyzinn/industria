@extends('layouts.app')

@section('title', 'Lista de setores')

@section('content')

<div class="text-center">
    <h1>Lista de setores para {{ Auth::user()->name }}</h1>

    <form action="{{ route('setores.index') }}" method="get">
        @csrf

        <div class="d-flex">

            {{-- Filtro por ID --}}
            <label for="id">ID</label>
            <input
                type="text"
                name="id"
                id="id"
                value="{{ request('id') }}"
            >

            {{-- Filtro por Nome --}}
            <label for="nome">Nome</label>
            <input
                type="text"
                name="nome"
                id="nome"
                value="{{ request('nome') }}"
            >

            {{-- Filtro por Status --}}
            <label for="status">Status</label>
            <select name="status" id="status">

                <option
                    value="1"
                    {{ request('status') == '1' ? 'selected' : '' }}
                >
                    Ativado
                </option>

                <option
                    value="0"
                    {{ request('status') == '0' ? 'selected' : '' }}
                >
                    Desativado
                </option>

            </select>

            <button class="btn btn-success" type="submit">
                Buscar
            </button>

        </div>
    </form>
</div>

<a
    class="btn btn-primary"
    href="{{ route('setores.create') }}"
    role="button"
>
    Novo
</a>

<table class="table">

    <thead class="table-info">
        <th>ID</th>
        <th>Nome</th>
        <th>Status</th>
        <th>Opções</th>
    </thead>

    <tbody>

        @foreach($setores as $setor)

        <tr>

            <td>{{ $setor->id }}</td>

            <td>{{ $setor->nome }}</td>

            <td>
                {{ $setor->ativo ? 'Ativado' : 'Desativado' }}
            </td>

            <td>

                <a
                    class="btn btn-primary"
                    href="{{ route('setores.show', $setor->id) }}"
                    role="button"
                >
                    Visualizar
                </a>

                <a
                    class="btn btn-primary"
                    href="{{ route('setores.edit', $setor->id) }}"
                    role="button"
                >
                    Editar
                </a>

                <form
                    action="{{ route('setores.destroy', $setor->id) }}"
                    method="post"
                >
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm">
                        Excluir
                    </button>
                </form>

                <form
                    action="{{ route('setores.ativar-desativar', $setor->id) }}"
                    method="post"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        class="btn btn-sm {{ $setor->ativo ? 'btn-warning' : 'btn-success' }}"
                    >
                        {{ $setor->ativo ? 'Desativar' : 'Ativar' }}
                    </button>
                </form>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection
