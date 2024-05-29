<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';
    protected $primaryKey = 'estado_id';
    public $incrementing = false;

    protected $fillable = [
        'est_nome',
        'excluido',
    ];

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'estado_id', 'estado_id');
    }
}
