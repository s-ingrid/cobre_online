<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    use HasFactory;

    protected $table = 'boleto';
    protected $primaryKey = 'boleto_id';
    public $timestamps = false;

    protected $fillable = [
        'contrato_id',
        'blt_data_vencimento',
        'blt_data_cadastro',
        'blt_valor',
        'blt_valor_pago',
        'blt_taxa',
        'blt_descricao',
        'blt_observacao',
        'blt_chave',
        'blt_desconto',
        'blt_juros',
        'blt_multa',
        'blt_data_pago',
        'blt_valor_tarifa',
        'blt_qtd_parcelas',
        'lote_id',
        'atualizado',
        'blt_registrado',
        'remessa_id',
        'blt_erro_registro',
        'blt_zoop_id',
        'blt_link',
        'blt_transacao_id',
        'blt_transacao_id_pix',
        'blt_webhook_log',
        'blt_numero_nfse',
        'blt_erro_nota',
        'forma_pagamento_id',
        'blt_vencimento_original',
        'excluido',
        'cadastrado',
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id', 'contrato_id');
    }
}
