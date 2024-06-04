<?php

namespace App\Services;

use App\Models\Contrato;
use App\Services\BoletoService;
use App\Models\Boleto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContratoService
{
    protected $contrato;
    protected $boletoService;

    public function __construct(BoletoService $boletoService) {
        $this->contrato = new Contrato();
        $this->boletoService = $boletoService;
    }
    public function criarContrato(array $request)
    {
        $validated = $request->validate([
            'licenciada_id' => 'nullable|integer',
            'cliente_id' => 'nullable|integer',
            'conta_id' => 'nullable|integer',
            'ctr_enviar_email' => 'nullable',
            'ctr_enviar_aviso' => 'nullable',
            'ctr_enviar_atraso' => 'nullable',
            'ctr_periodicidade' => 'nullable|integer',
            'ctr_taxa' => 'nullable|numeric',
            'ctr_juros' => 'nullable|numeric',
            'ctr_multa' => 'nullable|numeric',
            'ctr_desconto' => 'nullable|numeric',
            'ctr_valor' => 'nullable|numeric',
            'ctr_data_vencimento' => 'nullable|date',
            'ctr_descricao' => 'nullable|string|max:255',
            'ctr_instrucao' => 'nullable|string|max:255',
            'ctr_observacao' => 'nullable|string|max:255',
            'ctr_parcelamento' => 'nullable|integer',
            'ctr_ativo' => 'nullable',
            'ctr_data_renovacao' => 'nullable|date',
            'ctr_valor_desconto' => 'nullable|numeric',
            'ctr_cartao' => 'nullable',
            'ctr_pix' => 'nullable',
            'ctr_boleto' => 'required',
            'ctr_qtd_parcelas' => 'nullable|integer',
            'ctr_assinatura' => 'nullable',
            'ctr_qtd_tentativas' => 'nullable|integer',
            'ctr_emitir_nfse' => 'required',
            'nfse_codigo_servico_id' => 'nullable|integer',
            'ctr_retencao' => 'required|numeric|min:0',
            'ctr_nfe_mensagem' => 'nullable|string',
            'ctr_observacao_interna' => 'nullable|string|max:255',
            'ctr_aceitar_bitcoin' => 'nullable',
            'centro_custo_id' => 'required|integer',
            'ctr_emitir_nfse_antes_quitacao' => 'nullable',
            'lancamento_categoria_id' => 'nullable|integer',
            'cadastrado' => 'nullable|date',
            'atualizado' => 'nullable|date',
            'excluido' => 'nullable|date',
            'ctr_tolerancia' => 'required|integer|min:0',
            'ctr_sku' => 'nullable|string|max:20',
            'ctr_enviar_cobranca_wpp' => 'nullable',
            'ctr_enviar_aviso_wpp' => 'nullable'
        ]);

        $contrato = $this->contrato->create([
            'licenciada_id' => $request->licenciada_id,
            'cliente_id' => $request->cliente_id,
            'conta_id' => $request->conta_id,
            'ctr_enviar_email' => $request->ctr_enviar_email,
            'ctr_enviar_aviso' => $request->ctr_enviar_aviso,
            'ctr_enviar_atraso' => $request->ctr_enviar_atraso,
            'ctr_periodicidade' => $request->ctr_periodicidade,
            'ctr_taxa' => $request->ctr_taxa,
            'ctr_juros' => $request->ctr_juros,
            'ctr_multa' => $request->ctr_multa,
            'ctr_desconto' => $request->ctr_desconto,
            'ctr_valor' => $request->ctr_valor,
            'ctr_data_vencimento' => $request->ctr_data_vencimento,
            'ctr_descricao' => $request->ctr_descricao,
            'ctr_instrucao' => $request->ctr_instrucao,
            'ctr_observacao' => $request->ctr_observacao,
            'ctr_parcelamento' => $request->ctr_parcelamento,
            'ctr_ativo' => $request->ctr_ativo,
            'ctr_data_renovacao' => $request->ctr_data_renovacao,
            'ctr_valor_desconto' => $request->ctr_valor_desconto,
            'ctr_cartao' => $request->ctr_cartao,
            'ctr_pix' => $request->ctr_pix,
            'ctr_boleto' => $request->ctr_boleto,
            'ctr_qtd_parcelas' => $request->ctr_qtd_parcelas,
            'ctr_assinatura' => $request->ctr_assinatura,
            'ctr_qtd_tentativas' => $request->ctr_qtd_tentativas,
            'ctr_emitir_nfse' => $request->ctr_emitir_nfse,
            'nfse_codigo_servico_id' => $request->nfse_codigo_servico_id,
            'ctr_retencao' => $request->ctr_retencao,
            'ctr_nfe_mensagem' => $request->ctr_nfe_mensagem,
            'ctr_observacao_interna' => $request->ctr_observacao_interna,
            'ctr_aceitar_bitcoin' => $request->ctr_aceitar_bitcoin,
            'centro_custo_id' => $request->centro_custo_id,
            'ctr_emitir_nfse_antes_quitacao' => $request->ctr_emitir_nfse_antes_quitacao,
            'lancamento_categoria_id' => $request->lancamento_categoria_id,
            'ctr_tolerancia' => $request->ctr_tolerancia,
            'cli_sku' => $request->cli_sku,
            'ctr_enviar_cobranca_wpp' => $request->ctr_enviar_cobranca_wpp,
            'ctr_enviar_aviso_wpp' => $request->ctr_enviar_aviso_wpp
        ]);


        $valorParcela = $validated['ctr_valor'] / $validated['ctr_qtd_parcelas'];
        $numParcelas = $validated['ctr_qtd_parcelas'];
        $dataVencimentoInicial = $validated['ctr_data_vencimento'];

        $this->boletoService->criarBoletos($contrato, $valorParcela, $numParcelas, $dataVencimentoInicial);


        return $contrato
    }
}
