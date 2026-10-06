<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'Produto';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'marca',
        'modelo',
        'material',
        'tamanho',
        'peso'
    ];

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class, 'Produto_id');
    }
}