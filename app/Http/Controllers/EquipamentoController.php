<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Setor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipamentoController extends Controller
{
    /**
     * Lista os equipamentos.
     */
    public function index(Request $request)
    {
        // Consulta base
        $equipamentos = Equipamento::where('id', '>', 0);

        // Filtro por nome
        if ($request->filled('nome')) {
            $equipamentos = $equipamentos->where('nome','like','%' . $request->nome . '%');
        }

        // Filtro por status
        if ($request->filled('status')) {
            $equipamentos = $equipamentos->where('status',$request->status);
        }

        // Filtro por setor
        if ($request->filled('setor_id')) {
            $equipamentos = $equipamentos->where('setor_id',$request->setor_id);
        }

        $setorSelecionado = $request->filled('setor_id')
            ? Setor::find($request->setor_id): null;

        // Filtro por patrimônio
        if ($request->filled('patrimonio')) {
            $equipamentos = $equipamentos->where('patrimonio','like','%' . $request->patrimonio . '%');
        }

        $equipamentos = $equipamentos->get();

        // Busca todos os setores para o formulário
        $setores = Setor::orderBy('nome')->get();

        return view('equipamentos.index', compact(
            'equipamentos',
            'setores',
            'setorSelecionado'
        ));
    }

    /**
     * Formulário de cadastro.
     */
    public function create()
    {
        $setores = Setor::orderBy('nome')->get();

        return view('equipamentos.create', compact('setores'));
    }

    /**
     * Salva um novo equipamento.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:150',
            ],

            'patrimonio' => [
                'required',
                'string',
                'max:30',
                'unique:equipamentos,patrimonio',
            ],

            'setor_id' => [
                'nullable',
                'integer',
                'exists:setores,id',
            ],

            'status' => [
                'nullable',
                'string',
                'max:20',
            ],
        ]);

        Equipamento::create($dados);

        return redirect()
            ->route('equipamentos.index')
            ->with('success', 'Equipamento cadastrado com sucesso!');
    }

    /**
     * Exibe um equipamento.
     */
    public function show(Equipamento $equipamento)
    {
        $equipamento->load('setor');

        return view('equipamentos.show', compact('equipamento'));
    }

    /**
     * Formulário de edição.
     */
    public function edit(Equipamento $equipamento)
    {
        $setores = Setor::orderBy('nome')->get();

        return view('equipamentos.edit', compact(
            'equipamento',
            'setores'
        ));
    }

    /**
     * Atualiza um equipamento.
     */
    public function update(Request $request, Equipamento $equipamento)
    {
        $dados = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:150',
            ],

            'patrimonio' => [
                'required',
                'string',
                'max:30',
                Rule::unique('equipamentos', 'patrimonio')
                    ->ignore($equipamento->id),
            ],

            'setor_id' => [
                'nullable',
                'integer',
                'exists:setores,id',
            ],

            'status' => [
                'required',
                'string',
                'max:20',
            ],
        ]);

        $equipamento->update($dados);

        return redirect()
            ->route('equipamentos.index')
            ->with('success', 'Equipamento atualizado com sucesso!');
    }

    /**
     * Exclui um equipamento.
     */
    public function destroy(Equipamento $equipamento)
    {
        $equipamento->delete();

        return redirect()
            ->route('equipamentos.index')
            ->with('success', 'Equipamento excluído com sucesso!');
    }
}
