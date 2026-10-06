<!DOCTYPE html> <html> <head> <title>Visualizar Tarefa</title> </head> <body> <h1>Detalhes da Tarefa</h1> <p> <strong>ID:</strong> {{ $tarefa->id }} </p> <p> <strong>Título:</strong> {{ $tarefa->titulo }} </p> <p> <strong>Descrição:</strong> {{ $tarefa->descricao ?? 'Sem descrição' }} </p> <p> <strong>Usuário Responsável:</strong>
{{ $tarefa->usuario->nome ?? 'Não atribuído' }}

</p> <br> <a href="{{ route('tarefas.edit', $tarefa->id) }}"> Editar </a>

|

<a href="{{ route('tarefas.index') }}"> Voltar </a> </body> </html>