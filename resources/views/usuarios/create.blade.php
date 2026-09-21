<!DOCTYPE html>
<html>
<head>
    <title>Novo Usuário</title>
</head>
<body>
 
<h1>Novo Usuário</h1>
 
@if($errors->any())
    <ul>
        @foreach($errors->all() as $erro)
            <li>{{ $erro }}</li>
        @endforeach
    </ul>
@endif
 
<form action="{{ route('usuarios.store') }}" method="POST">
 
    @csrf
 
    <label>Nome:</label>
    <input
        type="text"
        name="nome"
        value="{{ old('nome') }}"
    >
 
    <br><br>
 
    <label>Email:</label>
    <input
        type="email"
        name="email"
        value="{{ old('email') }}"
    >
 
    <br><br>
 
    <button type="submit">
        Salvar
    </button>
 
</form>
 
<br>
 
<a href="{{ route('usuarios.index') }}">
    Voltar
</a>
 
</body>
</html>
 
 