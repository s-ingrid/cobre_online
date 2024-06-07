<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nfse extends Model
{
    use HasFactory;

    protected $table = 'nfse_codigo_servico';
    protected $primaryKey = 'nfse_codigo_servico_id';
    public $timestamps = false;

    protected $fillable = [
        'nfc_codigo',
        'nfc_nome',
        'nfc_company_id',
        'nfc_padrao',
        'excluido'
    ];
    public function contrato()
    {
        return $this->hasMany(Contrato::class, 'contrato_id', 'contrato_id');
    }
}
