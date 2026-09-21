<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarefa extends Model
{
    use HasFactory;

    protected $table = 'tarefa';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'setor',
        'status',
        'prioridade',
        'usuario_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'usuario_id', 'id');
    }
}