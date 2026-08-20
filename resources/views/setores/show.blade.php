@extends('layouts.app')
@section('title','Editar setor')
@section('content') 
<h1>Visualizar setor</h1>

<p>Id: {{ $setor->id }}</p>
<p>Nome: {{ $setor->nome }}</p>

@endsection