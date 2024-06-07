<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lancamento_categoria extends Model
{
    use HasFactory;

    protected $table = 'lancamento_categoria';
    protected $primaryKey = 'lancamento_categoria_id';
    public $timestamps = false;

    protected $fillable = [
        'lac_descricao',
        'tipo_custo_id',
        'lac_tipo',
        'lac_produto_servico',
        'cadastrado',
        'atualizado',
        'excluido'
    ];
    public function contrato()
    {
        return $this->hasMany(Contrato::class, 'contrato_id', 'contrato_id');
    }
}
