<?php

namespace App\Services;

use App\Models\Boleto;
use Carbon\Carbon;
use App\Http\Controllers\BoletoController;

class BoletoService
{
    protected $boleto;

    public function __construct() {
        $this->boleto = new Boleto();
    }

    public function criarBoletos($contrato, $valorParcela, $numParcelas, $dataVencimentoInicial)
    {
        for ($i = 0; $i < $numParcelas; $i++) {
            $dataVencimento = Carbon::parse($dataVencimentoInicial)->addMonths($i);

            Boleto::create([
                'contrato_id' => $contrato->id,
                'blt_data_vencimento' => $dataVencimento->toDateString(),
                'blt_valor' => $valorParcela,
                'blt_qtd_parcelas' => $numParcelas,
                // outros campos do boleto, se necessário
            ]);
        }
    }
}
