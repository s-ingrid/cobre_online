@extends('auth.layout')
@section('auth.content')
<section class="d-flex justify-content-center" style="height: 90vh;">
    <div class="card m-5" style="width: 80vw;">
        <div class="d-flex justify-content-between">
            <span>Contrato</span>
            <a href="{{ route('contrato.create') }}">
                <button class="btn btn-primary" type="submit">NOVO CONTRATO</button>
            </a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">Contrato</th>
                <th scope="col">Cliente</th>
                <th scope="col">Demonstrativo</th>
                <th scope="col">Periodicidade</th>
                <th scope="col">Prox. venc.</th>
                <th scope="col">Ativo</th>
                <th scope="col">Valor</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($contratos as $contrato)
                    <tr>
                        <td>
                            {{ $contrato->contrato_id }}
                        </td>
                        <td>
                            {{ $contrato->cliente_id }}
                        </td>
                        <td>
                            {{ $contrato->ctr_descricao }}
                        </td>
                        <td>
                            {{ $contrato->ctr_periodicidade }}
                        </td>
                        <td>
                            {{ $contrato->ctr_data_renovacao }}
                        </td>
                        <td>
                            {{ $contrato->ctr_ativo }}
                        </td>
                        <td>
                            {{ $contrato->ctr_valor }}
                        </td>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a class="btn-logout ml-2" href="{{ route('contrato.edit', ['contrato' => $contrato->contrato_id]) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('contrato.destroy', ['contrato' => $contrato->contrato_id]) }}" method="POST">
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
        <!-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmação de Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza de que deseja deletar este contrato?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Deletar</button>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteForm;
        var deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                deleteForm = button.closest('form');
                var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });
        });

        document.getElementById('confirmDelete').addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    });
</script>
@endsection