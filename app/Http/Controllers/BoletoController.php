<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        $boletos = $this->boleto->all();
        return view('boleto', ['boletos' => $boletos]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contrato_id' => 'nullable|integer',
            'blt_data_vencimento' => 'required|date',
            'blt_valor' => 'required|numeric',
            'blt_valor_pago' => 'nullable|numeric',
            'blt_taxa' => 'nullable|numeric',
            'blt_descricao' => 'nullable|string|max:255',
            'blt_observacao' => 'nullable|string|max:255',
            'blt_chave' => 'nullable|string|max:50|unique:boletos,blt_chave',
            'blt_desconto' => 'nullable|numeric',
            'blt_juros' => 'nullable|numeric',
            'blt_multa' => 'nullable|numeric',
            'blt_data_pago' => 'nullable|date',
            'blt_valor_tarifa' => 'nullable|numeric',
            'blt_qtd_parcelas' => 'nullable|integer',
            'lote_id' => 'nullable|integer',
            'blt_registrado' => 'nullable|in:S,N',
            'remessa_id' => 'nullable|integer',
            'blt_erro_registro' => 'nullable|in:S,N',
            'blt_zoop_id' => 'nullable|string|max:100',
            'blt_link' => 'nullable|string|max:255',
            'blt_transacao_id' => 'nullable|string|max:100',
            'blt_transacao_id_pix' => 'nullable|string|max:255',
            'blt_webhook_log' => 'nullable|string',
            'blt_numero_nfse' => 'nullable|string|max:50',
            'blt_erro_nota' => 'nullable|in:S,N',
            'forma_pagamento_id' => 'nullable|integer',
            'blt_vencimento_original' => 'nullable|date',
            'excluido' => 'nullable|date',
            'cadastrado' => 'nullable|date',
            'atualizado' => 'nullable|date',
        ]);

        $boleto = $this->boleto->create($validated);
    }

    public function show(string $id)
    {
        $boleto = Boleto::find($id);
        if (!$boleto) {
            return response()->json(['message' => 'Cliente not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
