<?php

namespace App\Http\Controllers;

use App\Models\ChamadoManutencao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChamadoController extends Controller
{
    public function index()
    {
        $chamados = ChamadoManutencao::where(
            'user_id',
            Auth::id()
        )->get();

        return view('chamados.index', compact('chamados'));
    }

    public function create()
    {
        return view('chamados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:150',
            'equipamento_id' => 'required|exists:equipamentos,id',
        ]);

        ChamadoManutencao::create([
            'titulo' => $request->titulo,
            'status' => 'aberto',
            'equipamento_id' => $request->equipamento_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('chamados.index');
    }

    public function show(ChamadoManutencao $chamado)
    {
        return view('chamados.show', compact('chamado'));
    }

    public function edit(ChamadoManutencao $chamado)
    {
        return view('chamados.edit', compact('chamado'));
    }

    public function update(Request $request, ChamadoManutencao $chamado)
    {
        $request->validate([
            'titulo' => 'required|max:150',
            'equipamento_id' => 'required|exists:equipamentos,id',
        ]);

        $chamado->update([
            'titulo' => $request->titulo,
            'equipamento_id' => $request->equipamento_id,
        ]);

        return redirect()->route('chamados.index');
    }

    public function destroy(ChamadoManutencao $chamado)
    {
        $chamado->delete();

        return redirect()->route('chamados.index');
    }
}