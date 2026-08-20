<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\EquipamentoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setores',[SetorController::class, 'index'])->name('setores.index');

Route::get('/setores/criar',[SetorController::class, 'criar'])->name('setores.criar');

Route::resource('setores',SetorController::class);

Route::resource('funcionarios',FuncionarioController::class);

Route::patch('/setores/{id}/status',[SetorController::class,'ativarDesativar'])->name('setores.ativar-desativar');

Route::resource('equipamentos', EquipamentoController::class);