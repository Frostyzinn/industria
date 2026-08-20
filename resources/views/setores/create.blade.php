@extends('layouts.app')
@section('title','Cadastro de setor')
@section('content') 
<h1>Cadastro setor</h1>
<form action="{{ route('setores.store') }}" method="post" class="container mt-4">
    @csrf
    <div class = "mb-3">
        <label for="" class="form-label"></label>
        <input type="text" name="nome" id="nome" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection