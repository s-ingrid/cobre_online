<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro_custo extends Model
{
    use HasFactory;

    protected $table = 'centro_custo';
    protected $primaryKey = 'centro_custo_id';
    public $timestamps = false;

    protected $fillable = [
        'cec_nome',
        'licenciada_id',
        'cadastrado',
        'excluido'
    ];
    public function contrato()
    {
        return $this->hasMany(Contrato::class, 'contrato_id', 'contrato_id');
    }
}
