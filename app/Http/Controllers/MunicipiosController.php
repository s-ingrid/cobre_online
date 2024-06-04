<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipio;

class MunicipiosController extends Controller
{
    protected $municipio;

    public function __construct() {
        $this->municipio = new Municipio();
    }
    public function buscarPorEstado($estadoId)
    {
        $municipios = $this->municipio->where('estado_id', $estadoId)->get();
        return response()->json($municipios);
    }
}
