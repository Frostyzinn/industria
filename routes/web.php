<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ChamadoController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // Setores
    Route::patch(
        '/setores/{id}/status',
        [SetorController::class, 'ativarDesativar']
    )->name('setores.ativar-desativar');

    Route::resource('setores', SetorController::class);


    // Equipamentos
    Route::resource('equipamentos', EquipamentoController::class);


    // Funcionários
    Route::resource('funcionarios', FuncionarioController::class);


    // Chamados de Manutenção
    Route::resource('chamados', ChamadoController::class);
});


require __DIR__.'/auth.php';