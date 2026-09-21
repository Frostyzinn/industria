<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR TAREFAS
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $tarefas = Tarefa::with('usuario')->get();

        return view('tarefas.index', compact('tarefas'));
    }


    /*
    |--------------------------------------------------------------------------
    | FORMULÁRIO DE CRIAÇÃO
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $usuarios = Usuarios::all();

        return view('tarefas.create', compact('usuarios'));
    }


    /*
    |--------------------------------------------------------------------------
    | SALVAR NOVA TAREFA
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:100',
            'setor' => 'required|string|max:100',
            'prioridade' => 'required|in:baixa,media,alta',
            'usuario_id' => 'required|exists:usuario,id',
        ]);

        Tarefa::create([
            'descricao' => $request->descricao,
            'setor' => $request->setor,
            'prioridade' => $request->prioridade,
            'usuario_id' => $request->usuario_id,

            // Toda nova tarefa começa em A Fazer
            'status' => 'a fazer',
        ]);

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa cadastrada com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | EXIBIR TAREFA
    |--------------------------------------------------------------------------
    */
    public function show(Tarefa $tarefa)
    {
        $tarefa->load('usuario');

        return view('tarefas.show', compact('tarefa'));
    }


    /*
    |--------------------------------------------------------------------------
    | FORMULÁRIO DE EDIÇÃO
    |--------------------------------------------------------------------------
    */
    public function edit(Tarefa $tarefa)
    {
        $usuarios = Usuarios::all();

        return view(
            'tarefas.edit',
            compact('tarefa', 'usuarios')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR TAREFA
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Tarefa $tarefa)
    {
        $request->validate([
            'descricao' => 'required|string|max:100',
            'setor' => 'required|string|max:100',
            'prioridade' => 'required|in:baixa,media,alta',
            'usuario_id' => 'required|exists:usuario,id',
            'status' => 'required|in:a fazer,fazendo,pronto',
        ]);

        $tarefa->descricao = $request->descricao;
        $tarefa->setor = $request->setor;
        $tarefa->prioridade = $request->prioridade;
        $tarefa->usuario_id = $request->usuario_id;
        $tarefa->status = $request->status;

        $tarefa->save();

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa atualizada com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | EXCLUIR TAREFA
    |--------------------------------------------------------------------------
    */
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa excluída com sucesso!');
    }
}