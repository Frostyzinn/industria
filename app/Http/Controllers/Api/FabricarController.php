<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fabrica;
use Illuminate\Http\Request;

class FabricarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Fabrica::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fabrica = Fabrica::create($request->all());
        return response()->json($fabrica,201);
   }

    /**
     * Display the specified resource.
     */
    public function show(Fabrica $fabrica)
    {
        return $fabrica;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fabrica $fabrica)
    {
        $fabrica->update($request->all());
        return $fabrica;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fabrica $fabrica)
    {
        $fabrica->delete();
        return response()->json("Registro excluído com sucesso.");
    }
}
