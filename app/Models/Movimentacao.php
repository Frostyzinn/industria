<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'Movimentacao';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'tipo',
        'quantidade',
        'data_movimentacao',
        'Produto_id',
        'usuario_id'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'Produto_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}