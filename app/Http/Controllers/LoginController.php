<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index()
    {
        if (session()->has('usuario_id')) {

            return redirect()
                ->route('estoque.dashboard');
        }

        return view('login.login');
    }


    public function autenticar(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|email',
                'senha' => 'required'
            ],
            [
                'email.required' => 'Informe o e-mail.',
                'email.email' => 'Informe um e-mail válido.',

                'senha.required' => 'Informe a senha.'
            ]
        );



        $usuario = Usuario::where(
            'email',
            $request->email
        )->first();



        if (!$usuario) {

            return redirect()
                ->route('estoque.login')
                ->withInput()
                ->with(
                    'erro',
                    'Usuário não encontrado.'
                );
        }



        if ($usuario->senha !== $request->senha) {

            return redirect()
                ->route('estoque.login')
                ->withInput()
                ->with(
                    'erro',
                    'Senha incorreta.'
                );
        }



        $request->session()->regenerate();

        session([
            'usuario_id' => $usuario->id,
            'usuario_nome' => $usuario->nome,
            'usuario_email' => $usuario->email
        ]);



        return redirect()
            ->route('estoque.dashboard')
            ->with(
                'sucesso',
                'Login realizado com sucesso!'
            );
    }



    public function logout(Request $request)
    {

        $request->session()->flush();

        $request->session()->invalidate();

        $request->session()->regenerateToken();



        return redirect()
            ->route('estoque.login')
            ->with(
                'sucesso',
                'Logout realizado com sucesso.'
            );
    }
}