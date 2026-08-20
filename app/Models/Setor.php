<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Equipamento;

class Setor extends Model
{
    protected $table = 'setores';

    protected $fillable = ['nome'];
    public $timestamps = false;

    public function equipamentos(){
        return $this->hasMany(Equipamento::class);
    }
}
