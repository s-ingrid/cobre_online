<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contrato';
    protected $primaryKey = 'contrato_id';
    public $timestamps = false;

    protected $fillable = [
        'licenciada_id',
        'cliente_id',
        'conta_id',
        'ctr_enviar_email',
        'ctr_enviar_aviso',
        'ctr_enviar_atraso',
        'ctr_periodicidade',
        'ctr_taxa',
        'ctr_juros',
        'ctr_multa',
        'ctr_desconto',
        'ctr_valor',
        'ctr_data_vencimento',
        'ctr_descricao',
        'ctr_instrucao',
        'ctr_observacao',
        'ctr_parcelamento',
        'ctr_ativo',
        'ctr_data_renovacao',
        'ctr_valor_desconto',
        'ctr_cartao',
        'ctr_pix',
        'ctr_boleto',
        'ctr_qtd_parcelas',
        'ctr_assinatura',
        'ctr_qtd_tentativas',
        'ctr_emitir_nfse',
        'nfse_codigo_servico_id',
        'ctr_retencao',
        'ctr_nfe_mensagem',
        'ctr_observacao_interna',
        'ctr_aceitar_bitcoin',
        'centro_custo_id',
        'ctr_data_cadastro',
        'ctr_emitir_nfse_antes_quitacao',
        'lancamento_categoria_id',
        'ctr_tolerancia',
        'ctr_sku',
        'ctr_enviar_cobranca_wpp',
        'ctr_enviar_aviso_wpp',
    ];

    public function boletos()
    {
        return $this->hasMany(Boleto::class, 'contrato_id', 'contrato_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'cliente_id');
    }
    public function nfse()
    {
        return $this->belongsTo(Nfse::class, 'nfse_codigo_servico_id', 'nfse_codigo_servico_id');
    }
    public function centro_custo()
    {
        return $this->belongsTo(Centro_custo::class, 'cliente_id', 'cliente_id');
    }
}
