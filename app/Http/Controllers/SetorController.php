<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;
use Illuminate\Support\Facades\Auth;


class SetorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $setores = Setor::query();
        if($request->filled('id')){
            $setores = Setor::where('id',$request->id);
        }

        if($request->filled('nome')){
            $setores = Setor::where('nome','like','%'.$request->nome.'%');
        }

        if($request->filled('status')){
            $setores = Setor::where('ativo',$request->status);
        }
        $setores = $setores->get();
        return view('setores.index',compact('setores'));
    }

    public function criar(){
        return view('setores.criar');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("setores.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Setor::create([
            'nome'=>$request->nome,
            'criado_por_usuario_id'=>Auth::id()
        ]);
        return redirect()->route('setores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $setor = Setor::find($id);
        return view('setores.show',compact('setor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $setor = Setor::find($id);
        return view('setores.edit',compact('setor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $setor = Setor::find($id);
        $setor->update($request->only('nome'));
        return redirect()->route('setores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setor = Setor::find($id);
        $setor->delete();
        return redirect()->route('setores.index');
    }

    public function ativarDesativar(string $id){
        $setor = Setor::find($id);
        $setor->ativo = !$setor->ativo;
        $setor->save();
        return redirect()->route('setores.index');
    }
}
