<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'email',
        'senha'
    ];

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class, 'usuario_id');
    }
}