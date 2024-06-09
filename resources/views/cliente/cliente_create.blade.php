@extends('auth.layout')
@section('auth.content')
<form action="{{ route('cliente.store') }}"  method="post">
    @csrf
    <section class="d-flex justify-content-center">
        <div class="card-div m-5" style="width: 50vw;">
            <h2 class="my-3 title-color">Dados do Cliente</h2>
            <div class="mb-3">
                <input type="text" placeholder="CPF/CNPJ" name="cli_cpf_cnpj" class="form-control">
                @if($errors->has('cli_cpf_cnpj'))
                    <small class="error">Preenchimento obrigatório</small>
                @endif
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Razão Social" name="cli_empresa" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Nome fantasia" name="cli_nome_fantasia" class="form-control">
                @if($errors->has('cli_nome_fantasia'))
                    <small class="error">Preenchimento obrigatório</small>
                @endif
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Responsável" name="cli_responsavel" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Inscrição Municipal" name="cli_inscricao_municipal" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="E-mail do financeiro" name="cli_email" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Telefone(s)" name="cli_telefone" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Celular" name="cli_celular" class="form-control">
            </div>
            <hr class="hr-text" data-content="ENDEREÇO">
            <div class="mb-3">
                <input type="text" id="cep" placeholder="CEP" name="cli_cep" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Logradouro" name="cli_endereco" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Número" name="cli_numero" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Bairro" name="cli_bairro" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Complemento" name="cli_complemento" class="form-control">
            </div>
            <div class="mb-3">
                <select id="estado" name="estado_id" onchange="buscarMunicipios(this.value)" class="form-select">
                    <option disabled selected>Selecionar estado</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->estado_id }}">{{ $estado->est_nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select id="municipio" name="municipio_id" class="form-select">
                    <option disabled selected>Selecione primeiro o estado</option>
                </select>
            </div>
            <hr class="hr-text" data-content="INFORMAÇÕES COMPLEMENTARES">
            <div class="mb-3">
                <input type="text" placeholder="E-mail Corporativo" name="cli_email_corporativo" class="form-control">
            </div>
            <div class="mb-3">
                <textarea name="cli_contatos" class="form-control" placeholder="Contatos"></textarea>
            </div>
            <div class="mb-3">
                <textarea name="cli_anotacao" class="form-control" placeholder="Anotações"></textarea>
            </div>
            <div class="d-flex mb-3">
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="cliente_ativo" value="S" id="cliente_ativo" checked="checked">
                    <label class="form-check-label" for="cliente_ativo">
                        Ativo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="cliente_ativo" value="N" id="cliente_ativo">
                    <label class="form-check-label" for="cliente_ativo">
                        Bloqueado
                    </label>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">SALVAR</button>
                <a href="{{ route('cliente.index') }}">VOLTAR</a>
            </div>
        </div>
    </section>
</form>

<script>
    function buscarMunicipios(estadoId) {
        const municipioSelect = document.getElementById('municipio')

        if (estadoId) {
            fetch(`/municipios/${estadoId}`)
                .then(response => response.json())
                .then(data => {
                    municipioSelect.innerHTML = '<option disabled selected>Selecionar o município</option>'
                    data.forEach(municipio => {
                        municipioSelect.innerHTML += `<option value="${municipio.municipio_id}">${municipio.mun_nome}</option>`
                    });
                })
                .catch(error => console.error('Erro:', error))
        } else {
            municipioSelect.innerHTML = '<option disabled selected>Selecione primeiro o estado</option>'
        }
    }


    $(document).ready(function(){
        $('#cep').mask('00000-000')
    })
    @if (session('success'))
        $(document).ready(function(){
            toastr.success("{{ session('success') }}")
        })
    @endif
</script>
@endsection
