<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Setor;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();

        return view('funcionarios.index', compact('funcionarios'));
    }

    
    public function create()
    {
        $setores = Setor::all();

        return view('funcionarios.create', compact('setores'));
    }

    /**
     * Salvar funcionário
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:150',
            'matricula' => 'required|string|max:20|unique:funcionarios,matricula',
            'cargo' => 'required|string|max:100',
            'setor_id' => 'required|exists:setores,id',
        ]);

        Funcionario::create([
            'nome' => $request->nome,
            'matricula' => $request->matricula,
            'cargo' => $request->cargo,
            'setor_id' => $request->setor_id,
        ]);

        return redirect()
            ->route('funcionarios.index')
            ->with('success', 'Funcionário cadastrado com sucesso!');
    }

    /**
     * Mostrar funcionário
     */
    public function show(Funcionario $funcionario)
    {
        return view('funcionarios.show', compact('funcionario'));
    }

    /**
     * Formulário de edição
     */
    public function edit(Funcionario $funcionario)
    {
        $setores = Setor::all();

        return view('funcionarios.edit', compact('funcionario', 'setores'));
    }

    /**
     * Atualizar funcionário
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        $validated = $request->validate([
            'nome'      => 'required|string|max:150',
            'matricula' => 'required|string|max:20|unique:funcionarios,matricula,' . $funcionario->id,
            'cargo'     => 'required|string|max:100',
            'setor_id'  => 'required|exists:setores,id',
        ]);

        $funcionario->update($validated);

        return redirect()
            ->route('funcionarios.index')
            ->with('success', 'Funcionário atualizado com sucesso!');
    }

    /**
     * Excluir funcionário
     */
    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();

        return redirect()
            ->route('funcionarios.index')
            ->with('success', 'Funcionário excluído com sucesso!');
    }
}