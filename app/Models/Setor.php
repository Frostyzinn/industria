<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Equipamento;

class Setor extends Model
{
    protected $table = 'setores';

    protected $fillable = ['nome','criador_por_usuario_id'];

    public $timestamps = false;

    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class);
    }
}
