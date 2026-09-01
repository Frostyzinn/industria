<?php

namespace App\Http\Controllers;

use App\Models\Manutencao;
use App\Models\Equipamento;
use App\Models\Funcionario;
use Illuminate\Http\Request;

class ManutencaoController extends Controller
{
    public function index()
    {
        $manutencoes = Manutencao::with([
            'equipamento',
            'funcionario'
        ])->latest('data_manutencao')->get();

        return view('manutencoes.index', compact('manutencoes'));
    }

    public function create()
    {
        $equipamentos = Equipamento::all();
        $funcionarios = Funcionario::all();

        return view('manutencoes.create', compact(
            'equipamentos',
            'funcionarios'
        ));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'funcionario_id' => 'required|exists:funcionarios,id',
            'tipo' => 'required|in:Preventiva,Corretiva,Preditiva',
            'descricao' => 'required|string',
            'data_manutencao' => 'required|date',
            'proxima_manutencao' => 'nullable|date',
            'custo' => 'nullable|numeric|min:0',
            'status' => 'required|in:Pendente,Em andamento,Concluída',
        ]);

        Manutencao::create($dados);

        return redirect()
            ->route('manutencoes.index')
            ->with('success', 'Manutenção cadastrada com sucesso!');
    }

    public function show(Manutencao $manutencao)
    {
        return view('manutencoes.show', compact('manutencao'));
    }

    public function edit(Manutencao $manutencao)
    {
        $equipamentos = Equipamento::all();
        $funcionarios = Funcionario::all();

        return view('manutencoes.edit', compact(
            'manutencao',
            'equipamentos',
            'funcionarios'
        ));
    }

    public function update(Request $request, Manutencao $manutencao)
    {
        $dados = $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'funcionario_id' => 'required|exists:funcionarios,id',
            'tipo' => 'required|in:Preventiva,Corretiva,Preditiva',
            'descricao' => 'required|string',
            'data_manutencao' => 'required|date',
            'proxima_manutencao' => 'nullable|date',
            'custo' => 'nullable|numeric|min:0',
            'status' => 'required|in:Pendente,Em andamento,Concluída',
        ]);

        $manutencao->update($dados);

        return redirect()
            ->route('manutencoes.index')
            ->with('success', 'Manutenção atualizada com sucesso!');
    }

    public function destroy(Manutencao $manutencao)
    {
        $manutencao->delete();

        return redirect()
            ->route('manutencoes.index')
            ->with('success', 'Manutenção excluída com sucesso!');
    }
}
