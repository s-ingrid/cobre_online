<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estado;

class EstadosController extends Controller
{
    public readonly Estado $estado;

    public function __construct() {
        $this->estado = new Estado();
    }
    public function buscarEstados()
    {
        $estados = $this->estado->all()->pluck('est_nome');
        return response()->json($estados);
    }
}
