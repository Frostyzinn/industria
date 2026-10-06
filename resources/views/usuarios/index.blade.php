<!DOCTYPE html>
<html>
<head>
    <title>Usuários</title>
</head>
<body>
 
<h1>Usuários</h1>
 
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif
 
<a href="{{ route('usuarios.create') }}">
    Novo usuário
</a>
 
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
        </tr>
    </thead>
 
    <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->nome }}</td>
                <td>{{ $usuario->email }}</td>
 
               
            </tr>
        @endforeach
    </tbody>
</table>
 
</body>
</html>
 