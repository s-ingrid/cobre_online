<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Centro_custo;
use App\Models\Lancamento_categoria;
use App\Models\Nfse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Cliente;
use App\Models\Conta;
use App\Http\Controllers\BoletoController;
use Illuminate\Support\Facades\DB;

class ContratoController extends Controller
{
    protected $contrato;
    protected $boleto;

    public function __construct()
    {
        $this->contrato = new Contrato();
        $this->boleto = new Boleto();
    }

    public function index()
    {
        $contratos = $this->contrato->all();
        return view('contrato.contrato', ['contratos' => $contratos]);
    }

    public function create()
    {
        $clientes = Cliente::all();
        $lancamentos_categoria = Lancamento_categoria::all();
        $contas = Conta::all();
        $centros_custo = Centro_custo::all();
        $nfses = Nfse::all();
        return view('contrato.contrato_create', [
            'clientes' => $clientes,
            'lancamentos_categoria' => $lancamentos_categoria,
            'contas' => $contas,
            'centros_custo' => $centros_custo,
            'nfses' => $nfses,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'licenciada_id' => 'nullable|integer',
            'cliente_id' => 'required|integer',
            'conta_id' => 'nullable|integer',
            'ctr_enviar_email' => 'required',
            'ctr_enviar_aviso' => 'required',
            'ctr_enviar_atraso' => 'required',
            'ctr_periodicidade' => 'nullable|integer',
            'ctr_taxa' => 'nullable',
            'ctr_juros' => 'nullable',
            'ctr_multa' => 'nullable',
            'ctr_desconto' => 'nullable',
            'ctr_valor' => 'nullable',
            'ctr_data_vencimento' => 'nullable|date',
            'ctr_descricao' => 'nullable|string|max:255',
            'ctr_instrucao' => 'nullable|string|max:255',
            'ctr_observacao' => 'nullable|string|max:255',
            'ctr_parcelamento' => 'required|integer',
            'ctr_ativo' => 'required',
            'ctr_data_renovacao' => 'nullable|date',
            'ctr_valor_desconto' => 'nullable',
            'ctr_cartao' => 'nullable',
            'ctr_pix' => 'required',
            'ctr_boleto' => 'required',
            'ctr_qtd_parcelas' => 'required|integer',
            'ctr_assinatura' => 'nullable',
            'ctr_qtd_tentativas' => 'nullable|integer',
            'ctr_emitir_nfse' => 'nullable',
            'nfse_codigo_servico_id' => 'nullable|integer',
            'ctr_retencao' => 'nullable|min:0',
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
            'ctr_enviar_cobranca_wpp' => 'required',
            'ctr_enviar_aviso_wpp' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $contrato = $this->contrato->create([
                'licenciada_id' => $request->licenciada_id,
                'cliente_id' => $request->cliente_id,
                'conta_id' => $request->conta_id,
                'ctr_enviar_email' => $request->ctr_enviar_email,
                'ctr_enviar_aviso' => $request->ctr_enviar_aviso,
                'ctr_enviar_atraso' => $request->ctr_enviar_atraso,
                'ctr_periodicidade' => $request->ctr_periodicidade,
                'ctr_taxa' => $request->ctr_taxa,
                'ctr_juros' => $request->ctr_juros ? str_replace(['.', ','], ['', '.'], $request->ctr_juros) : null,
                'ctr_multa' => $request->ctr_multa ? str_replace(['.', ','], ['', '.'], $request->ctr_multa) : null,
                'ctr_desconto' => $request->ctr_desconto ? str_replace(['.', ','], ['', '.'], $request->ctr_desconto) : null,
                'ctr_valor' => $request->ctr_valor ? str_replace(['.', ','], ['', '.'], $request->ctr_valor) : null,
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

            if (!$contrato) {
                return redirect()->back()->with('error', 'Erro ao criar contrato.');
            }
            $valorParcela = $contrato->ctr_valor / $contrato->ctr_parcelamento;
            $numParcelas = $contrato->ctr_parcelamento;
            $dataVencimentoInicial = $contrato->ctr_data_vencimento;

            for ($i = 0; $i < $numParcelas; $i++) {
                $dataVencimento = Carbon::parse($dataVencimentoInicial)->addMonths($i);
                $parcelaNumero = $i + 1;
                $observacao = "Parcela $parcelaNumero de $numParcelas";

                $this->boleto->create([
                    'contrato_id' => $contrato->contrato_id,
                    'blt_data_vencimento' => $dataVencimento->toDateString(),
                    'blt_valor' => $valorParcela,
                    'blt_taxa' => $contrato->ctr_taxa,
                    'blt_descricao' => $contrato->ctr_descricao,
                    'blt_observacao' => $observacao,
                    'blt_desconto' => $contrato->ctr_desconto,
                    'blt_qtd_parcelas' => $numParcelas
                ]);
            }

            DB::commit();
            return redirect()->route('contrato.index')->with('message', 'Criado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Ocorreu um erro ao criar o contrato e os boletos.'])->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $contrato = $this->contrato->find($id);
        $clientes = Cliente::all();
        $lancamentos_categoria = Lancamento_categoria::all();
        $contas = Conta::all();
        $centros_custo = Centro_custo::all();
        $nfses = Nfse::all();
        return view('contrato.contrato_update', [
            'contrato' => $contrato,
            'clientes' => $clientes,
            'lancamentos_categoria' => $lancamentos_categoria,
            'contas' => $contas,
            'centros_custo' => $centros_custo,
            'nfses' => $nfses,
        ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $contrato = $this->contrato->find($id);
        if (!$contrato) {
            return response()->json(['message' => 'Contrato não encontrado'], 404);
        }

        $contrato->delete();
        return redirect()->route('contrato.index')->with('message', 'Deletado com sucesso!');
    }
}
