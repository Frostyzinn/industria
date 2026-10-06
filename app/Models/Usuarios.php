<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuario';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'email'
    ];

    public function tarefas()
    {
        return $this->hasMany(Tarefa::class, 'usuario_id', 'id');
    }
}