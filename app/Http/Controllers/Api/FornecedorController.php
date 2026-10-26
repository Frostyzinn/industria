<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return response()->json(Fornecedor::all(), 200);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'razao_social' => 'required|string|max:150',
            'cnpj' => 'required|digits:14|unique:fornecedores,cnpj',
            'observacoes' => 'nullable|string',
            'prazo_entrega' => 'required|integer|min:1',
            'limite_credito' => 'numeric|min:0',
            'data_contrato' => 'nullable|date',
            'ativo' => 'boolean',
        ]);

        $fornecedor = Fornecedor::create($dados);

        return response()->json($fornecedor, 201);
    }

    // Q7 - Buscar um fornecedor
    public function show(Fornecedor $fornecedor)
    {
        return response()->json($fornecedor, 200);
    }

    // Q8 - Atualizar fornecedor
    public function update(
        Request $request,
        Fornecedor $fornecedor
    ) {
        $dados = $request->validate([
            'razao_social' => 'required|string|max:150',
            'cnpj' => 'required|digits:14|unique:fornecedores,cnpj,'
                . $fornecedor->id,
            'observacoes' => 'nullable|string',
            'prazo_entrega' => 'required|integer|min:1',
            'limite_credito' => 'numeric|min:0',
            'data_contrato' => 'nullable|date',
            'ativo' => 'boolean',
        ]);

        $fornecedor->update($dados);

        return response()->json($fornecedor, 200);
    }

    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();

        return response()->noContent();
    }
}

