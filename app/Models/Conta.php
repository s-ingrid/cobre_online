<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;
    protected $table = 'conta';
    protected $primaryKey = 'conta_id';
    public $timestamps = false;

    protected $fillable = [
        'cta_local_pagamento',
        'cta_nome_cedente',
        'cta_descricao',
        'cta_especie_documento',
        'cta_aceite',
        'cta_especie_valor',
        'cta_agencia',
        'cta_agencia_digito',
        'cta_conta',
        'cta_conta_digito',
        'cta_codigo_cedente',
        'cta_padrao',
        'cta_instrucao',
        'cta_nosso_numero',
        'cta_contrato',
        'licenciada_id',
        'banco_id',
        'carteira_id',
        'cta_variacao_carteira',
        'cta_taxa',
        'cta_juros',
        'cta_multa',
        'cta_observacao',
        'cta_gerar_remessa',
        'cta_cpf_cnpj',
        'cta_seller_id',
        'cta_taxa_zoop',
        'cta_conta_transferencia',
        'cta_enviar_recibo',
        'cta_company_id',
        'cta_gateway_id',
        'cta_gateway_key',
        'cta_gateway',
        'cta_dias_vencimento',
    ];

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }
}
