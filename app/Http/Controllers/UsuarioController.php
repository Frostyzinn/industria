<?php
 
namespace App\Http\Controllers;
 
use App\Models\Usuarios;
use Illuminate\Http\Request;
 
class UsuarioController extends Controller
{
    // LISTAR
    public function index()
    {
        $usuarios = usuarios::all();
 
        return view('usuarios.index', compact('usuarios'));
    }
 
    // FORMULÁRIO DE CRIAÇÃO
    public function create()
    {
        return view('usuarios.create');
    }
 
    // SALVAR
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:100',
            'email' => 'required|email|max:150|unique:usuario,email',
        ]);
 
        usuarios::create([
            'nome' => $request->nome,
            'email' => $request->email,
        ]);
 
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuário criado com sucesso!');
    }
 
    // EXIBIR UM USUÁRIO
    public function show(usuario $usuarios)
    {
       
    }
 
    // FORMULÁRIO DE EDIÇÃO
    public function edit(usuarios $usuarios)
    {
       
    }
 
    // ATUALIZAR
    public function update(Request $request, usuarios $usuarios)
    {
       
    }
 
    // EXCLUIR
    public function destroy(usuarios $usuarios)
    {
       
    }
}
 
 