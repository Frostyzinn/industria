<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Setor;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';

    public $timestamps = false;

    protected $fillable = ['nome', 'cargo', 'setor_id', 'matricula'];

    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }
}