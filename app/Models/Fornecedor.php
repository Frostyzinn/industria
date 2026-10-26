<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';

    protected $fillable = [
        'razao_social',
        'cnpj',
        'observacoes',
        'prazo_entrega',
        'limite_credito',
        'data_contrato',
        'ativo',
    ];

    protected $casts = [
        'limite_credito' => 'decimal:2',
        'data_contrato' => 'date:Y-m-d',
        'ativo' => 'boolean',
    ];
}
