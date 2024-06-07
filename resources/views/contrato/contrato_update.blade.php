@extends('auth.layout')
@section('auth.content')
<form action="{{ route('contrato.update', ['contrato' => $contrato->contrato_id]) }}" method="POST">
    @csrf
    @method('PUT')
    <section class="d-flex justify-content-center">
        <div class="card m-5" style="width: 65vw;">
            <h2 class="mx-5 mt-5 title-color">Dados da Cobrança</h2>
            <nav class="tipo-cobranca-list my-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="changeCobranca('unica')"
                            class="ms-5 mx-3 tipo-cobranca-active">Venda (Cobrança Única)</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="changeCobranca('recorrente')"
                            class="mx-3">Contrato (Cobrança Recorrente)</a></li>
                </ol>
            </nav>
            <div id="periodicidadeList" class="periodicidade-list mx-5 mb-4">
                <label class="periodicidade-item selected">
                    <input class="radio-input" type="radio" name="ctr_periodicidade" value="1" checked="">Mensal</label>
                <label class="periodicidade-item">
                    <input class="radio-input" type="radio" name="ctr_periodicidade" value="2">Bimestral</label>
                <label class="periodicidade-item">
                    <input class="radio-input" type="radio" name="ctr_periodicidade" value="3">Trimestral</label>
                <label class="periodicidade-item">
                    <input class="radio-input" type="radio" name="ctr_periodicidade" value="4">
                    Quadrimestral </label>
                <label class="periodicidade-item">
                    <input class="radio-input" type="radio" name="ctr_periodicidade" value="6">
                    Semestral </label>
                <label class="periodicidade-item">
                    <input class="radio-input" type="radio" name="ctr_periodicidade" value="12">
                    Anual </label>
            </div>
            <div class="mb-3 mx-5">
                <select name="cliente_id" class="form-select" value="{{ $contrato->cliente_id }}">
                    <option disabled selected>Cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->cliente_id }}" {{ $cliente->cliente_id == $contrato->cliente_id ? 'selected' : '' }}>{{ $cliente->cli_nome_fantasia }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Descrição (produto ou serviço)" name="ctr_descricao" value="{{ $contrato->ctr_descricao }}" class="form-control">
            </div>
            <div class="mb-3 mx-5">
                <select name="lancamento_categoria_id" class="form-select" value="{{ $contrato->lancamento_categoria_id }}">
                    <option disabled selected>Categoria de lançamento</option>
                    @foreach ($lancamentos_categoria as $lancamento_categoria)
                        <option value="{{ $lancamento_categoria->lancamento_categoria_id }}" {{ $lancamento_categoria->lancamento_categoria_id == $contrato->lancamento_categoria_id ? 'selected' : '' }}>
                            {{ $lancamento_categoria->lac_descricao }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Valor" name="ctr_valor" value="{{ $contrato->ctr_valor }}" class="form-control moeda">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Parcelas (boletos)" name="ctr_parcelamento" value="{{ $contrato->ctr_parcelamento }}" class="form-control">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Vencimento" name="ctr_data_vencimento" value="{{ $contrato->ctr_data_vencimento }}" class="form-control">
            </div>
            <div class="mb-3 mx-5">
                <select name="conta_id" class="form-select" value="{{ $contrato->conta_id }}">
                    <option disabled selected>Conta</option>
                    @foreach ($contas as $conta)
                        <option value="{{ $conta->conta_id }}" {{ $conta->conta_id == $contrato->conta_id ? 'selected' : '' }}>{{ $conta->cta_nome_cedente }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mx-5">
                <select name="centro_custo_id" class="form-select" value="{{ $contrato->centro_custo_id }}">
                    <option disabled selected>Grupo</option>
                    @foreach ($centros_custo as $centro_custo)
                        <option value="{{ $centro_custo->centro_custo_id }}" {{ $centro_custo->centro_custo_id == $contrato->centro_custo_id ? 'selected' : '' }}>{{ $centro_custo->cec_nome }}</option>
                    @endforeach
                </select>
            </div>
            <hr>
            <h5 class="mx-5">Parâmetros</h5>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Desconto até o vencimento" name="ctr_desconto"
                    value="{{ $contrato->ctr_desconto }}" class="form-control moeda">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Juros de mora por dia corrido" value="0,40" name="ctr_juros"
                    value="{{ $contrato->ctr_juros }}" class="form-control moeda">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Multa após vencimento" name="ctr_multa" value="10,00"
                    value="{{ $contrato->ctr_multa }}" class="form-control moeda">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Mais Instruções" name="ctr_instrucao" value="{{ $contrato->ctr_instrucao }}" class="form-control">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Observação"
                    value="Título sujeito a protesto bancário após 10 dias de atraso." name="ctr_observacao"
                    value="{{ $contrato->ctr_observacao }}" class="form-control">
            </div>
            <div class="form-check d-flex mx-4">
                <strong class="me-5 mb-3">E-mail:</strong>
                <div>
                    <input type="hidden" name="ctr_enviar_email" value="N">
                    <input class="ms-2 form-check-input me-2" value="{{ $contrato->ctr_enviar_email }}" name="ctr_enviar_email" type="checkbox"
                        id="ctr_enviar_email" checked="checked">
                    <label class="form-check-label" for="ctr_enviar_email">Enviar cobrança</label>
                </div>
                <div>
                    <input type="hidden" name="ctr_enviar_aviso" value="N">
                    <input class="ms-2 form-check-input me-2" value="{{ $contrato->ctr_enviar_aviso }}" name="ctr_enviar_aviso" type="checkbox"
                        id="ctr_enviar_aviso" checked="checked">
                    <label class="form-check-label" for="ctr_enviar_aviso">Lembrete de vencimento</label>
                </div>
                <div>
                    <input type="hidden" name="ctr_enviar_atraso" value="N">
                    <input class="ms-2 form-check-input me-2" value="{{ $contrato->ctr_enviar_atraso }}" name="ctr_enviar_atraso" type="checkbox"
                        id="ctr_enviar_atraso" checked="checked">
                    <label class="form-check-label" for="ctr_enviar_atraso">Aviso de atraso</label>
                </div>
            </div>

            <div class="form-check d-flex mx-4">
                <strong class="me-4 mb-3">WhatsApp:</strong>
                <div>
                    <input type="hidden" name="ctr_enviar_cobranca_wpp" value="N">
                    <input class="ms-2 form-check-input me-2" value="{{ $contrato->ctr_enviar_cobranca_wpp }}" name="ctr_enviar_cobranca_wpp" type="checkbox"
                        id="ctr_enviar_cobranca_wpp" checked="checked">
                    <label class="form-check-label" for="ctr_enviar_cobranca_wpp">Enviar cobrança</label>
                </div>
                <div>
                    <input type="hidden" name="ctr_enviar_aviso_wpp" value="N">
                    <input class="ms-2 form-check-input me-2" value="{{ $contrato->ctr_enviar_aviso_wpp }}" name="ctr_enviar_aviso_wpp" type="checkbox"
                        id="ctr_enviar_aviso_wpp" checked="checked">
                    <label class="form-check-label" for="ctr_enviar_aviso_wpp">Lembrete de vencimento</label>
                </div>
            </div>
            <small class="me-5 mb-3 mx-5">* O boleto será enviado 11 dias antes do vencimento, conforme configuração.</small>
            <div class="form-check d-flex mx-3">
                <div>
                    <input type="hidden" name="ctr_ativo" value="n">
                    <input class="ms-2 form-check-input me-2" value="{{ $contrato->ctr_ativo }}" name="ctr_ativo" type="checkbox" id="contrato_ativo"
                        checked="checked">
                    <label class="form-check-label" for="contrato_ativo">Contrato ativo</label>
                </div>
                <div>
                    <input type="hidden" name="ctr_pix" value="n">
                    <input class="ms-2 form-check-input me-2" value="{{ $contrato->ctr_pix }}" name="ctr_pix" type="checkbox" id="ctr_pix"
                        checked="checked">
                    <label class="form-check-label" for="ctr_pix">Aceitar Pix (1% taxa + R$ 0,50)</label>
                </div>
                <div>
                    <input type="hidden" name="ctr_boleto" value="n">
                    <input class="ms-2 form-check-input me-2" value="{{ $contrato->ctr_boleto }}" name="ctr_boleto" type="checkbox" id="ctr_boleto"
                        checked="checked">
                    <label class="form-check-label" for="ctr_boleto">Aceitar Boleto</label>
                </div>
                <div>
                    <input type="hidden" name="ctr_cartao" value="n">
                    <input class="ms-2 form-check-input me-2" value="{{ $contrato->ctr_cartao }}" name="ctr_cartao" type="checkbox" id="acc_cartao">
                    <label class="form-check-label" for="ctr_cartao">Aceitar cartão</label>
                    <div id="qtd_parcelas">
                        <label for="ctr_qtd_parcelas" class="active">Parcelamento</label>
                        <div>
                            <select class="form-select" value="{{ $contrato->ctr_cartao }}" name="ctr_qtd_parcelas" title="Parcelamento">
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-5">
                <input type="hidden" name="ctr_emitir_nfse" value="n">
                <input class="form-check-input me-2" value="{{ $contrato->ctr_emitir_nfse }}" name="ctr_emitir_nfse" type="checkbox" id="emitir_nfse">
                <label class="form-check-label" for="emitir_nfse">Emitir NFS-e</label>
            </div>
            <div id="div_emiti_nfse">
                <div class="d-flex mx-5">
                    <div class="mt-3 me-3">
                        <select name="nfse_codigo_servico_id" class="form-select" value="{{ $contrato->nfse_codigo_servico_id }}">
                            <option disabled selected>Código de serviço</option>
                            @foreach ($nfses as $nfse)
                                <option value="{{ $nfse->nfse_codigo_servico_id }}" {{ $nfse->nfse_codigo_servico_id == $contrato->nfse_codigo_servico_id ? 'selected' : '' }}>{{ $nfse->nfc_codigo }} -
                                    {{ $nfse->nfc_nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <input value="{{ $contrato->ctr_retencao }}" class="form-control moeda " placeholder="Retenção" type="text" name="ctr_retencao" min-value="1" value="0,00">
                    </div>
                </div>
                <div class="mt-3 m-3 mx-5">
                    <textarea name="ctr_nfe_mensagem" value="{{ $contrato->ctr_nfe_mensagem }}" class="form-control" placeholder="Descrição da NFS-e"></textarea>
                </div>
                <div class="m-3 mx-5">
                    <p><small>Você pode utilizar #MES_ANTERIOR# e #MES_ATUAL# para substituir os valores</small></p>
                    <span>Momento da emissão da NFS-E:</span>
                    <div class="d-flex">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="ctr_emitir_nfse_antes_quitacao" value="{{ $nfse->ctr_emitir_nfse_antes_quitacao }}"
                                id="emitir_nfse_antes_quitacao" checked="checked">
                            <label class="form-check-label" for="emitir_nfse_antes_quitacao">
                                Antes da Quitação
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ctr_emitir_nfse_antes_quitacao" value="{{ $nfse->ctr_emitir_nfse_antes_quitacao }}"
                                id="emitir_nfse_depois_quitacao">
                            <label class="form-check-label" for="emitir_nfse_depois_quitacao">
                                Após da Quitação
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 mx-5">
                <input value="{{ $contrato->ctr_data_renovacao }}" class="form-control" placeholder="Renovado em" type="text" name="ctr_data_renovacao">
            </div>
            <div class="my-3 mx-5">
                <input value="{{ $contrato->ctr_observacao_interna }}" class="form-control moeda" placeholder="Observação interna" type="text"
                    name="ctr_observacao_interna">
            </div>
            <div class="d-flex justify-content-between mx-5 my-3">
                <button type="submit" class="btn btn-primary">SALVAR E GERAR FATURA</button>
                <button type="submit" class="btn">VOLTAR</button>
            </div>
        </div>
    </section>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('acc_cartao')
        const parcelamentoDiv = document.getElementById('qtd_parcelas')
        parcelamentoDiv.style.display = checkbox.checked ? 'block' : 'none'

        checkbox.addEventListener('change', function () {
            parcelamentoDiv.style.display = this.checked ? 'block' : 'none'
        })
    })
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('emitir_nfse')
        const parcelamentoDiv = document.getElementById('div_emiti_nfse')
        parcelamentoDiv.style.display = checkbox.checked ? 'block' : 'none'

        checkbox.addEventListener('change', function () {
            parcelamentoDiv.style.display = this.checked ? 'block' : 'none'
            parcelamentoDiv.style.backgroundColor = checkbox.checked ? 'rgba(255, 193, 13, 0.05)' : ''
        })
    })

    document.addEventListener('DOMContentLoaded', function () {
        const radioInputs = document.querySelectorAll('.radio-input')
        const labels = document.querySelectorAll('.periodicidade-item')

        radioInputs.forEach(input => {
            input.addEventListener('change', function () {
                labels.forEach(label => {
                    label.classList.remove('selected')
                })
                this.parentElement.classList.add('selected')
            })
        })
    })
    let elements = document.getElementsByClassName('moeda')
    Array.from(elements).forEach(function (element) {
        element.addEventListener('input', function (e) {
            let value = e.target.value
            value = value.replace(/\D/g, '')
            value = value.replace(/(\d)(\d{2})$/, '$1,$2')
            value = value.replace(/(?=(\d{3})+(\D))\B/g, '.')
            e.target.value = value
        })
    })
    function changeCobranca(c) {
        const periodicidadeList = document.getElementById('periodicidadeList')
        const periodicidadeItem = document.querySelectorAll('.breadcrumb-item a')
        if (c === 'recorrente') {
            periodicidadeList.style.display = 'grid';
        } else {
            periodicidadeList.style.display = 'none';
        }
        periodicidadeItem.forEach(item => {
            item.classList.remove('tipo-cobranca-active')
            if ((c === 'recorrente' && item.textContent.includes('Contrato')) ||
                (c === 'unica' && item.textContent.includes('Venda'))) {
                item.classList.add('tipo-cobranca-active')
            }
        });
    }
</script>
@endsection
