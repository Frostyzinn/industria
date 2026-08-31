<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;

class SetorApiController extends Controller
{
    public function index(){
        return Setor::all();
    }
}
