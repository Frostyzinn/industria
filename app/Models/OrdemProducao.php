<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdemProducao extends Model
{
    protected $table = 'ordens_producao';

    public $timestamps = false; 

    protected $fillable = [
        'setor_id',
        'responsavel_id',
        'codigo_ordem',
        'produto',
        'quantidade_planejada',
        'quantidade_produzida',
        'data_inicio',
        'data_fim',
        'status',
        'observacoes',
    ];

    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
    ];

    public function setor(): BelongsTo
    {
        return $this->belongsTo(Setor::class);
    }

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(Funcionario::class, 'responsavel_id');
    }
}
