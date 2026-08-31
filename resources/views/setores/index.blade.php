@extends('layouts.app')
@section('title','Lista de setores')
@section('content') 
<div class="text-center">
    <h1>Lista de setores para {{ Auth::user()->name}}</h1>
</div>
<a class="btn btn-primary" href="{{ route('setores.create') }}" role="button">Novo</a>
<table class="table">
    <thead class="table-info">
        <th>ID</th>
        <th>Nome</th>
        <th>Status</th>
        <th>Opções</th>
    </thead>
    <tbody>
        @foreach($setores as $setor)
        <tr >
            <td>{{ $setor->id}}</td>
            <td>{{ $setor->nome}}</td>
            <td>{{ $setor->ativo ? 'Desativar' : 'Ativar' }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('setores.show',$setor->id) }}" role="button">Visualizar</a>
                <a class="btn btn-primary" href="{{ route('setores.edit',$setor->id) }}" role="button">Editar</a>
                <form action="{{ route('setores.destroy',$setor->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
                <form action="{{ route('setores.ativar-desativar',$setor->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-sm {{ $setor->ativo ? 'btn-warning' : 'btn-sucess' }}">
                        {{ $setor->ativo ? 'Desativar' : 'Ativar' }}
                    </button>
                </form>
            </td>
        </tr>     
        @endforeach   
    </tbody>
</table>
@endsection