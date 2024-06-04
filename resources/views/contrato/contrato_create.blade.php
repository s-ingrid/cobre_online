@extends('auth.layout')
@section('auth.content')
<form action="{{ route('contrato.store') }}"  method="post">
    @csrf
    <div class="d-flex justify-content-center">
        <div class="card m-5" style="width: 50vw;">
            <div class="mb-3">
                <select id="lançamento" name="municipio_id" class="form-select">
                    <option disabled selected>Cliente</option>
                    <option>Cliente Teste</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Descrição (produto ou serviço)" name="ctr_descricao" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Categoria de lançamento" name="" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Valor" name="ctr_valor" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Parcelas (boletos)" name="ctr_qtd_parcelas" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Vencimento" name="ctr_data_vencimento" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Conta" name="conta_id" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Grupo" name="centro_custo_id" class="form-control">
            </div>
            Parâmetros
            <div class="mb-3">
                <input type="text" placeholder="Desconto até o vencimento" name="ctr_desconto" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Juros de mora por dia corrido" value="0,40" name="ctr_juros" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Multa após vencimento" name="ctr_multa" value="10,00" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Mais Instruções" name="ctr_instrucao" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Observação" value="Título sujeito a protesto bancário após 10 dias de atraso." name="ctr_observacao" class="form-control">
            </div>
            <div class="form-check d-flex">
                <span class="me-5">E-mail:</span>
                <div>
                    <input class="ms-2 form-check-input" name="ctr_enviar_email" type="checkbox" id="ctr_enviar_email" checked="checked">
                    <label class="form-check-label" for="ctr_enviar_email">Enviar cobrança</label>
                </div>
                <div>
                    <input class="ms-2 form-check-input" name="ctr_enviar_aviso" type="checkbox" id="ctr_enviar_aviso" checked="checked">
                    <label class="form-check-label" for="ctr_enviar_aviso">Lembrete de vencimento</label>
                </div>
                <div>
                    <input class="ms-2 form-check-input" name="ctr_enviar_atraso" type="checkbox" id="ctr_enviar_atraso" checked="checked">
                    <label class="form-check-label" for="ctr_enviar_atraso">Aviso de atraso</label>
                </div>
            </div>

            <div class="form-check d-flex">
                <span class="me-4">WhatsApp:</span>
                <div>
                    <input class="ms-2 form-check-input" name="ctr_enviar_cobranca_wpp" type="checkbox" id="ctr_enviar_cobranca_wpp" checked="checked" disabled="">
                    <label class="form-check-label" for="ctr_enviar_cobranca_wpp">Enviar cobrança</label>
                </div>
                <div>
                    <input class="ms-2 form-check-input" name="ctr_enviar_aviso_wpp" type="checkbox" id="ctr_enviar_aviso_wpp" checked="checked" disabled="">
                    <label class="form-check-label" for="ctr_enviar_aviso_wpp">Lembrete de vencimento</label>
                </div>
            </div>
            <span class="me-5">* O boleto será enviado 11 dias antes do vencimento, conforme configuração.</span>
            <div class="form-check d-flex">
                <div>
                    <input class="ms-2 form-check-input" name="ctr_ativo" type="checkbox" id="ctr_enviar_email" checked="checked">
                    <label class="form-check-label" for="ctr_enviar_email">Enviar cobrança</label>
                </div>
                <div>
                    <input class="ms-2 form-check-input" name="ctr_ativo" type="checkbox" id="contrato_ativo" checked="checked">
                    <label class="form-check-label" for="contrato_ativo">Contrato ativo</label>
                </div>
                <div>
                    <input class="ms-2 form-check-input" name="ctr_pix" type="checkbox" id="ctr_pix" checked="checked">
                    <label class="form-check-label" for="ctr_pix">Aceitar Pix (1% taxa + R$ 0,50)</label>
                </div>
                <div>
                    <input class="ms-2 form-check-input" name="ctr_boleto" type="checkbox" id="ctr_boleto" checked="checked">
                    <label class="form-check-label" for="ctr_boleto">Aceitar Boleto</label>
                </div>
                <div>
                    <input class="ms-2 form-check-input" onchange="toggleParcelas(this)" name="ctr_cartao" type="checkbox" id="ctr_cartao">
                    <label class="form-check-label" for="ctr_cartao">Aceitar cartão</label>
                    <span id="qtd_parcelas">
                    <label for="ctr_qtd_parcelas" class="active">Parcelamento</label>
                    <div>
                        <select class="form-select" name="ctr_qtd_parcelas" id="ctr_qtd_parcelas" value="" tabindex="-1" title="Parcelamento">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">SALVAR</button>
    </div>
</form>

<script>

</script>
@endsection
