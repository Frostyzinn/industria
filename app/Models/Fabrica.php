<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fabrica extends Model
{
     protected $table = 'fabrica';

    protected $fillable = ['razao_social','cnpj','email','telefone','ativo'];

    public $timestamps = false;
}
