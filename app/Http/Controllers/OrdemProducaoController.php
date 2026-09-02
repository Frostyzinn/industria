<?php

namespace App\Http\Controllers;

use App\Models\OrdemProducao;
use App\Models\Setor;
use App\Models\Funcionario;
use Illuminate\Http\Request;

class OrdemProducaoController extends Controller
{
    public function index()
    {
        $ordens = OrdemProducao::with(['setor', 'responsavel'])
            ->orderBy('id', 'desc')
            ->get();

        return view('ordens-producao.index', compact('ordens'));
    }

    public function create()
    {
        $setores = Setor::orderBy('nome')->get();
        $funcionarios = Funcionario::orderBy('nome')->get();

        return view('ordens-producao.create', compact(
            'setores',
            'funcionarios'
        ));
    }
    public function store(Request $request)
    {
        $dados = $request->validate([
            'setor_id' => 'required|exists:setores,id',
            'responsavel_id' => 'required|exists:funcionarios,id',
            'codigo_ordem' => 'required|string|max:255|unique:ordens_producao,codigo_ordem',
            'produto' => 'required|string|max:255',
            'quantidade_planejada' => 'required|numeric|min:0',
            'quantidade_produzida' => 'nullable|numeric|min:0',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'status' => 'required|string|max:50',
            'observacoes' => 'nullable|string',
        ]);

        $dados['quantidade_produzida'] = $dados['quantidade_produzida'] ?? 0;

        OrdemProducao::create($dados);

        return redirect()
            ->route('ordens-producao.index')
            ->with('success', 'Ordem de produção criada com sucesso!');
    }

    public function show(string $id)
    {
        $ordem = OrdemProducao::with(['setor', 'responsavel'])
            ->findOrFail($id);

        return view('ordens-producao.show', compact('ordem'));
    }

   public function edit(string $id)
    {
        $ordens_producao = OrdemProducao::findOrFail($id);

        $setores = Setor::orderBy('nome')->get();
        $funcionarios = Funcionario::orderBy('nome')->get();

        return view('ordens-producao.edit', compact(
            'ordens_producao',
            'setores',
            'funcionarios'
        ));
    }


    public function update(Request $request, string $id)
    {
        $ordem = OrdemProducao::findOrFail($id);

        $dados = $request->validate([
            'setor_id' => 'required|exists:setores,id',
            'responsavel_id' => 'required|exists:funcionarios,id',
            'codigo_ordem' => 'required|string|max:255|unique:ordens_producao,codigo_ordem,' . $id,
            'produto' => 'required|string|max:255',
            'quantidade_planejada' => 'required|numeric|min:0',
            'quantidade_produzida' => 'nullable|numeric|min:0',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'status' => 'required|string|max:50',
            'observacoes' => 'nullable|string',
        ]);

        $dados['quantidade_produzida'] = $dados['quantidade_produzida'] ?? 0;

        $ordem->update($dados);

        return redirect()
            ->route('ordens-producao.index')
            ->with('success', 'Ordem de produção atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        $ordem = OrdemProducao::findOrFail($id);

        $ordem->delete();

        return redirect()
            ->route('ordens-producao.index')
            ->with('success', 'Ordem de produção excluída com sucesso!');
    }
}
