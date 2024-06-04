<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Http\Controllers\BoletoController;
use Illuminate\Support\Facades\DB;

class ContratoController extends Controller
{
    protected $contrato;

    public function __construct() {
        $this->contrato = new Contrato();

    }

    public function index()
    {
        $contratos = $this->contrato->all();
        return view('contrato.contrato', ['contratos' => $contratos]);
    }

    public function create()
    {
        return view('contrato.contrato_create');
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
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
            'ctr_boleto' => 'nullable',
            'ctr_qtd_parcelas' => 'nullable|integer',
            'ctr_assinatura' => 'nullable',
            'ctr_qtd_tentativas' => 'nullable|integer',
            'ctr_emitir_nfse' => 'nullable',
            'nfse_codigo_servico_id' => 'nullable|integer',
            'ctr_retencao' => 'nullable|numeric|min:0',
            'ctr_nfe_mensagem' => 'nullable|string',
            'ctr_observacao_interna' => 'nullable|string|max:255',
            'ctr_aceitar_bitcoin' => 'nullable',
            'centro_custo_id' => 'nullable|integer',
            'ctr_emitir_nfse_antes_quitacao' => 'nullable',
            'lancamento_categoria_id' => 'nullable|integer',
            'cadastrado' => 'nullable|date',
            'atualizado' => 'nullable|date',
            'excluido' => 'nullable|date',
            'ctr_tolerancia' => 'nullable|integer|min:0',
            'ctr_sku' => 'nullable|string|max:20',
            'ctr_enviar_cobranca_wpp' => 'nullable',
            'ctr_enviar_aviso_wpp' => 'nullable'
        ]);

        var_dump($valid);
        // DB::beginTransaction();
        // try {
        //     $contrato = $this->contrato->create([
        //         'licenciada_id' => $request->licenciada_id,
        //         'cliente_id' => $request->cliente_id,
        //         'conta_id' => $request->conta_id,
        //         'ctr_enviar_email' => $request->ctr_enviar_email,
        //         'ctr_enviar_aviso' => $request->ctr_enviar_aviso,
        //         'ctr_enviar_atraso' => $request->ctr_enviar_atraso,
        //         'ctr_periodicidade' => $request->ctr_periodicidade,
        //         'ctr_taxa' => $request->ctr_taxa,
        //         'ctr_juros' => $request->ctr_juros,
        //         'ctr_multa' => $request->ctr_multa,
        //         'ctr_desconto' => $request->ctr_desconto,
        //         'ctr_valor' => $request->ctr_valor,
        //         'ctr_data_vencimento' => $request->ctr_data_vencimento,
        //         'ctr_descricao' => $request->ctr_descricao,
        //         'ctr_instrucao' => $request->ctr_instrucao,
        //         'ctr_observacao' => $request->ctr_observacao,
        //         'ctr_parcelamento' => $request->ctr_parcelamento,
        //         'ctr_ativo' => $request->ctr_ativo,
        //         'ctr_data_renovacao' => $request->ctr_data_renovacao,
        //         'ctr_valor_desconto' => $request->ctr_valor_desconto,
        //         'ctr_cartao' => $request->ctr_cartao,
        //         'ctr_pix' => $request->ctr_pix,
        //         'ctr_boleto' => $request->ctr_boleto,
        //         'ctr_qtd_parcelas' => $request->ctr_qtd_parcelas,
        //         'ctr_assinatura' => $request->ctr_assinatura,
        //         'ctr_qtd_tentativas' => $request->ctr_qtd_tentativas,
        //         'ctr_emitir_nfse' => $request->ctr_emitir_nfse,
        //         'nfse_codigo_servico_id' => $request->nfse_codigo_servico_id,
        //         'ctr_retencao' => $request->ctr_retencao,
        //         'ctr_nfe_mensagem' => $request->ctr_nfe_mensagem,
        //         'ctr_observacao_interna' => $request->ctr_observacao_interna,
        //         'ctr_aceitar_bitcoin' => $request->ctr_aceitar_bitcoin,
        //         'centro_custo_id' => $request->centro_custo_id,
        //         'ctr_emitir_nfse_antes_quitacao' => $request->ctr_emitir_nfse_antes_quitacao,
        //         'lancamento_categoria_id' => $request->lancamento_categoria_id,
        //         'ctr_tolerancia' => $request->ctr_tolerancia,
        //         'cli_sku' => $request->cli_sku,
        //         'ctr_enviar_cobranca_wpp' => $request->ctr_enviar_cobranca_wpp,
        //         'ctr_enviar_aviso_wpp' => $request->ctr_enviar_aviso_wpp
        //     ]);

        //     if (!$contrato) {
        //         DB::rollBack();
        //         return redirect()->back()->with('error', 'Erro ao criar contrato.');
        //     }
        //     $valorParcela = $contrato->ctr_valor / $contrato->ctr_qtd_parcelas;
        //     $numParcelas = $contrato->ctr_qtd_parcelas;
        //     $dataVencimentoInicial = $contrato->ctr_data_vencimento;

        //         for ($i = 0; $i < $numParcelas; $i++) {
        //             $dataVencimento = Carbon::parse($dataVencimentoInicial)->addMonths($i);
        //             $parcelaNumero = $i + 1;
        //             $observacao = "Parcela $parcelaNumero de $numParcelas";

        //             $boletoRequest = new Request([
        //                 'contrato_id' => $contrato->id,
        //                 'blt_data_vencimento' => $dataVencimento->toDateString(),
        //                 'blt_valor' => $valorParcela,
        //                 'blt_taxa' => $contrato->ctr_taxa,
        //                 'blt_descricao' => $observacao,
        //                 'blt_observacao' => $contrato->ctr_descricao,
        //                 'blt_desconto' => $contrato->ctr_desconto,
        //                 'blt_juros' => $contrato->ctr_juros,
        //                 'blt_multa' => $contrato->ctr_multa,
        //                 'blt_qtd_parcelas' => $numParcelas
        //             ]);
        //             $boletoController = new BoletoController();
        //             $boletoController->store($boletoRequest);
        //         }


        //     return response()->json($contrato);
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->back()->with('error', 'Erro ao criar: ' . $e->getMessage());
        // }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
