
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetorApiController;
use App\Http\Controllers\Api\FabricarController;
use App\Http\Controllers\Api\FornecedorController;

Route::apiResource('setores', SetorApiController::class)
    ->names('api.setores');

Route::apiResource('fabrica', FabricarController::class);

Route::apiResource('fornecedores', FornecedorController::class)
    ->parameters(['fornecedores' => 'fornecedor']);
