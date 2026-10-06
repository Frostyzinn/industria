<?php

namespace App\Http\Controllers;

use App\Models\Usuario;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('usuario_id')) {
            return redirect()
                ->route('estoque.login')
                ->with(
                    'erro',
                    'Faça login para acessar o sistema.'
                );
        }

        $usuario = Usuario::find(
            session('usuario_id')
        );

        if (!$usuario) {
            session()->flush();

            return redirect()
                ->route('estoque.login')
                ->with(
                    'erro',
                    'Usuário não encontrado.'
                );
        }

        return view(
            'login.dashboard-estoque',
            compact('usuario')
        );
    }
}