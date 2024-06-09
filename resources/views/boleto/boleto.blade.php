@extends('auth.layout')
@section('auth.content')
<section class="d-flex justify-content-center" style="height: 90vh;">
    <div class="card-div m-5" style="width: 80vw;">
        <div class="d-flex justify-content-between">
            <h3 class="my-4 mx-3 title-color">Boletos</h3>
            <a href="{{ route('contrato.create') }}">
                <button class="btn btn-create my-4 mx-3" type="submit">+ EMITIR COBRANÇA</button>
            </a>
        </div>
        <div class="scrollable-container m-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Descrição</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Valor</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($boletos as $boleto)
                        <tr>
                            <td>
                                {{ $boleto->boleto_id }}
                                {{$boleto->contrato->cliente->cli_nome_fantasia}}
                                @if($boleto->contrato->cliente->cli_responsavel)
                                    ({{$boleto->contrato->cliente->cli_responsavel}})<br/>
                                @endif
                                <small>{{$boleto->contrato->cliente->cli_telefone}}</small><br/>
                                <small>{{$boleto->contrato->cliente->cli_email}}</small><br/>
                                <small>{{$boleto->contrato->ctr_descricao}}</small><br/>
                            </td>
                            <td>
                                @if ($boleto->blt_data_vencimento)
                                    <span class="d-flex align-items-center">{{ date("d/m/Y", strtotime($boleto->blt_data_vencimento)) }}</span>
                                @endif
                            </td>
                            <td>
                                R$ {{ number_format($boleto->blt_valor, 2, ',', '.') }}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn-logout ml-2" href="{{ route('boleto.edit', ['boleto' => $boleto->boleto_id]) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('boleto.destroy', ['boleto' => $boleto->boleto_id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-logout delete-btn" type="submit">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmação de Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza de que deseja deletar este boleto?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Deletar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let deleteForm
        let deleteButtons = document.querySelectorAll('.delete-btn')

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault()
                deleteForm = button.closest('form')
                let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'))
                deleteModal.show()
            })
        })

        document.getElementById('confirmDelete').addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit()
            }
        })
    })

    @if (session('success'))
        $(document).ready(function(){
            toastr.success("{{ session('success') }}")
        })
    @endif
</script>
@endsection
