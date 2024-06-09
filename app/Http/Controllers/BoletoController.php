<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Carbon\Carbon;
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
        $boleto->blt_data_vencimento =
            $boleto->blt_data_vencimento ? Carbon::createFromFormat('Y-m-d', $boleto->blt_data_vencimento)->format('d/m/Y') : null;
        $boleto->blt_valor = $boleto->blt_valor ? number_format($boleto->blt_valor, 2, ',', '.') : null;
        return view('boleto.boleto_update', ['boleto' => $boleto]);
    }

    public function update(Request $request, string $id)
    {
        $boleto = $this->boleto->find($id);
        if (!$boleto) {
            return response()->json(['message' => 'Boleto não encontrado'], 404);
        }

        $request->validate([
            'blt_data_vencimento' => 'nullable|date_format:d/m/Y',
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
            'lote_id' => 'nullable|integer',
            'remessa_id' => 'nullable|integer',
            'blt_erro_registro' => 'nullable',
            'blt_zoop_id' => 'nullable|string|max:100',
            'blt_link' => 'nullable|string|max:255',
            'blt_transacao_id' => 'nullable|string|max:100',
            'blt_transacao_id_pix' => 'nullable|string|max:255',
            'blt_webhook_log' => 'nullable|string',
            'blt_numero_nfse' => 'nullable|string|max:50',
            'blt_erro_nota' => 'nullable',
            'blt_vencimento_original' => 'nullable|date',
            'excluido' => 'nullable|date',
            'cadastrado' => 'nullable|date',
            'atualizado' => 'nullable|date'
        ]);

       $boleto->update([
            'blt_data_vencimento' => $request->blt_data_vencimento ? Carbon::createFromFormat('d/m/Y', $request->blt_data_vencimento)->format('Y-m-d') : null,
            'blt_valor' => $request->blt_valor ? str_replace(['.', ','], ['', '.'], $request->blt_valor) : null,
            'blt_valor_pago' => $request->blt_valor_pago,
            'blt_taxa' => $request->blt_taxa ? str_replace(['.', ','], ['', '.'], $request->blt_taxa) : null,
            'blt_descricao' => $request->blt_descricao,
            'blt_observacao' => $request->blt_observacao,
            'blt_chave' => $request->blt_chave,
            'blt_desconto' => $request->blt_desconto ? str_replace(['.', ','], ['', '.'], $request->blt_desconto) : null,
            'blt_juros' => $request->blt_juros ? str_replace(['.', ','], ['', '.'], $request->blt_juros) : null,
            'blt_multa' => $request->blt_multa ? str_replace(['.', ','], ['', '.'], $request->blt_multa) : null,
            'blt_data_pago' => $request->blt_data_pago,
            'blt_valor_tarifa' => $request->blt_valor_tarifa,
            'lote_id' => $request->lote_id,
            'remessa_id' => $request->remessa_id,
            'blt_erro_registro' => $request->blt_erro_registro,
            'blt_zoop_id' => $request->blt_zoop_id,
            'blt_link' => $request->blt_link,
            'blt_transacao_id' => $request->blt_transacao_id,
            'blt_transacao_id_pix' => $request->blt_transacao_id_pix,
            'blt_webhook_log' => $request->blt_webhook_log,
            'blt_numero_nfse' => $request->blt_numero_nfse,
            'blt_erro_nota' => $request->blt_erro_nota,
            'blt_vencimento_original' => $request->blt_vencimento_original
        ]);
        return redirect()->route('boleto.index')->with('message', 'Criado com sucesso!');
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
