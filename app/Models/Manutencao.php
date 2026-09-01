<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Manutencao extends Model
{
    protected $table = 'manutencoes';

    public $timestamps = false;

    protected $fillable = [
        'equipamento_id',
        'funcionario_id',
        'tipo',
        'descricao',
        'data_manutencao',
        'proxima_manutencao',
        'custo',
        'status',
    ];

    protected $casts = [
        'data_manutencao' => 'date',
        'proxima_manutencao' => 'date',
        'custo' => 'decimal:2',
    ];

    public function equipamento(): BelongsTo
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function funcionario(): BelongsTo
    {
        return $this->belongsTo(Funcionario::class);
    }
}
