@extends('layouts.app')
@section('title','Editar setor')
@section('content') 
<h1>Editar setor</h1>
<form action="{{ route('setores.update',$setor->id) }}" method="post" class="container mt-4">
    @csrf
    @method("PUT")
    <div class = "mb-3">
        <label for="" class="form-label"></label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{$setor->nome}}">
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection