<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipio';
    protected $primaryKey = 'municipio_id';
    public $timestamps = false;

    protected $fillable = [
        'mun_nome',
        'estado_id',
        'mun_codigo_ibge',
        'excluido',
        'cadastrado',
        'atualizado',
    ];
    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'municipio_id', 'municipio_id');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
