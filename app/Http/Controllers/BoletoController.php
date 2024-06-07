<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Boleto;

class BoletoController extends Controller
{
    protected $boleto;

    public function __construct() {
        $this->boleto = new Boleto();
    }

    public function index()
    {
        $boletos = Boleto::with('contrato.cliente')->get();
        $clientes = Cliente::all();
        return view('boleto.boleto', [
            'boletos' => $boletos,
            'clientes'=> $clientes
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       //
    }

    public function edit(string $id)
    {
        $boleto = $this->boleto->with('contrato.cliente')->find($id);
        return view('boleto.boleto_update', ['boleto' => $boleto]);
    }

    public function update(Request $request, string $id)
    {
        $boleto = $this->boleto->find($id);
        if (!$boleto) {
            return response()->json(['message' => 'Boleto não encontrado'], 404);
        }

        $request->validate([
            'contrato_id' => 'required|integer',
            'blt_data_vencimento' => 'required|date',
            'blt_valor' => 'required',
            'blt_valor_pago' => 'nullable',
            'blt_taxa' => 'nullable',
            'blt_descricao' => 'nullable|string|max:255',
            'blt_observacao' => 'nullable|string|max:255',
            'blt_chave' => 'nullable|string|max:50',
            'blt_desconto' => 'nullable',
            'blt_juros' => 'nullable',
            'blt_multa' => 'nullable',
            'blt_data_pago' => 'nullable|date',
            'blt_valor_tarifa' => 'nullable',
            'blt_qtd_parcelas' => 'required|integer',
            'lote_id' => 'nullable|integer',
            'blt_registrado' => 'nullable',
            'remessa_id' => 'nullable|integer',
            'blt_erro_registro' => 'nullable',
            'blt_zoop_id' => 'nullable|string|max:100',
            'blt_link' => 'nullable|string|max:255',
            'blt_transacao_id' => 'nullable|string|max:100',
            'blt_transacao_id_pix' => 'nullable|string|max:255',
            'blt_webhook_log' => 'nullable|string',
            'blt_numero_nfse' => 'nullable|string|max:50',
            'blt_erro_nota' => 'nullable',
            'forma_pagamento_id' => 'nullable|integer',
            'blt_vencimento_original' => 'nullable|date',
            'excluido' => 'nullable|date',
            'cadastrado' => 'nullable|date',
            'atualizado' => 'nullable|date'
        ]);

        $this->boleto->create([
            'contrato_id' => $request->contrato_id,
            'blt_data_vencimento' => $request->blt_data_vencimento,
            'blt_valor' => $request->blt_valor,
            'blt_valor_pago' => $request->blt_valor_pago,
            'blt_taxa' => $request->blt_taxa,
            'blt_descricao' => $request->blt_descricao,
            'blt_observacao' => $request->blt_observacao,
            'blt_chave' => $request->blt_chave,
            'blt_desconto' => $request->blt_desconto,
            'blt_juros' => $request->blt_juros,
            'blt_multa' => $request->blt_multa,
            'blt_data_pago' => $request->blt_data_pago,
            'blt_valor_tarifa' => $request->blt_valor_tarifa,
            'blt_qtd_parcelas' => $request->blt_qtd_parcelas,
            'lote_id' => $request->lote_id,
            'blt_registrado' => $request->blt_registrado,
            'remessa_id' => $request->remessa_id,
            'blt_erro_registro' => $request->blt_erro_registro,
            'blt_zoop_id' => $request->blt_zoop_id,
            'blt_link' => $request->blt_link,
            'blt_transacao_id' => $request->blt_transacao_id,
            'blt_transacao_id_pix' => $request->blt_transacao_id_pix,
            'blt_webhook_log' => $request->blt_webhook_log,
            'blt_numero_nfse' => $request->blt_numero_nfse,
            'blt_erro_nota' => $request->blt_erro_nota,
            'forma_pagamento_id' => $request->forma_pagamento_id,
            'blt_vencimento_original' => $request->blt_vencimento_original
        ]);
        return response()->json($boleto);
    }

    public function destroy(string $id)
    {
        $boleto = $this->boleto->find($id);
        if (!$boleto) {
            return response()->json(['message' => 'Contrato não encontrado'], 404);
        }

        $boleto->delete();
        return redirect()->route('boleto.index')->with('message', 'Deletado com sucesso!');
    }
}
