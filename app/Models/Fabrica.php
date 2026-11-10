<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fabrica extends Model
{
    use HasFactory;
    protected $table = 'fabrica';

    protected $fillable = ['razao_social','cnpj','email','telefone','ativo'];

    public $timestamps = false;
}
