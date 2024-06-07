@extends('auth.layout')
@section('auth.content')
<form action="{{ route('boleto.update', ['boleto' => $boleto->boleto_id]) }}" method="post">
    @csrf
    @method('PUT')
    <section class="d-flex justify-content-center">
        <div class="card m-5" style="width: 65vw;">
            <h2 class="mx-5 mt-5 title-color">Dados da Fatura</h2>
            <div class="mb-3 mx-5">
                <strong>Contrato: </strong><span>{{ $boleto->contrato_id }}</span><br>
                <strong>Fatura: </strong><span>{{ $boleto->boleto_id }}</span></strong><br>
                <strong>Data de criação: </strong><span>{{ $boleto->cadastrado }}</span><br>
                <strong>Cliente: </strong><span>{{ $boleto->contrato->cliente->cli_nome_fantasia }}</span><br>
                <strong>Cod. Transação:</strong>
                    <span>
                        {{ $boleto->blt_transacao_id }}
                        @if($boleto->blt_transacao_id && $boleto->blt_transacao_id_pix)
                            <span>/</span>
                        @endif
                        {{ $boleto->blt_transacao_id_pix }}
                    </span><br>
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Descrição" value="{{ $boleto->blt_descricao }}" name="blt_descricao"class="form-control">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Observação" value="{{ $boleto->blt_observacao }} {{$boleto->contrato->ctr_observacao}}" name="blt_observacao"class="form-control">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Valor" value="{{ $boleto->blt_valor }}" name="blt_valor"class="form-control moeda">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Data de Vencimento" value="{{ $boleto->blt_data_vencimento }}" name="blt_data_vencimento"class="form-control moeda">
            </div>
            <h5 class="mx-5">Parâmetros</h5>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Desconto até o vencimento" value="{{ $boleto->blt_desconto ? $boleto->blt_desconto : '0,00' }}" name="blt_desconto" class="form-control moeda">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Juros de mora por dia corrido" value="{{ $boleto->blt_juros ? $boleto->blt_juros : '0,40' }}" name="blt_juros" class="form-control moeda">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Multa após vencimento" value="{{ $boleto->blt_multa ? $boleto->blt_multa : '10,00' }}" name="blt_multa" class="form-control moeda">
            </div>
            <div class="mb-3 mx-5">
                <input type="text" placeholder="Multa após vencimento" value="{{ $boleto->blt_taxa ? $boleto->blt_taxa : '0,00' }}" name="blt_taxa" class="form-control moeda">
            </div>
            <div class="d-flex justify-content-between mx-5 my-3">
                <button type="submit" class="btn btn-primary">SALVAR</button>
                <button type="submit" class="btn">VOLTAR</button>
            </div>
    </section>
</form>

<script>
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
</script>
@endsection
