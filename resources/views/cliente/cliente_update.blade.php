@extends('auth.layout')
@section('auth.content')
<form action="{{ route('cliente.update', ['cliente' => $cliente->cliente_id]) }}"  method="POST">
    @csrf
    @method('PUT')
    <div class="d-flex justify-content-center">
        <div class="card m-5" style="width: 50vw;">
            <div class="mb-3">
                <input type="text" placeholder="CPF/CNPJ" name="cli_cpf_cnpj" value="{{ $cliente->cli_cpf_cnpj }}" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Razão Social" name="cli_empresa" value="{{ $cliente->cli_empresa }}" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Nome fantasia" name="cli_nome_fantasia" value="{{ $cliente->cli_nome_fantasia }}" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Responsável" name="cli_responsavel" value="{{ $cliente->cli_responsavel }}" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Inscrição Municipal" name="cli_inscricao_municipal" value="{{ $cliente->cli_inscricao_municipal }}" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="E-mail do financeiro" name="cli_email" value="{{ $cliente->cli_email }}" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Telefone(s)" name="cli_telefone" value="{{ $cliente->cli_telefone }}" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Celular" name="cli_celular" value="{{ $cliente->cli_celular }}" class="form-control">
            </div>
            Endereço
            <div class="mb-3">
                <input type="text" placeholder="CEP" name="cli_cep" value="{{ $cliente->cli_cep }}" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Logradouro" name="cli_endereco" value="{{ $cliente->cli_endereco }}" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Número" name="cli_numero" value="{{ $cliente->cli_numero }}" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Bairro" name="cli_bairro" value="{{ $cliente->cli_bairro }}" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Complemento" name="cli_complemento" value="{{ $cliente->cli_complemento }}" class="form-control">
            </div>
            <div class="mb-3">
                <select id="estado" name="estado_id" onchange="buscarMunicipios(this.value)" value="{{ $cliente->estado_id }}" class="form-select">
                    <option disabled selected>Selecionar estado</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->estado_id }}" {{ $estado->estado_id == $cliente->estado_id ? 'selected' : '' }}>{{ $estado->est_nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select id="municipio" name="municipio_id" value="{{ $cliente->municipio_id }}" class="form-select">
                    <option disabled selected>Selecione...</option>
                    @foreach ($municipios as $municipio)
                        <option value="{{ $municipio->municipio_id }}" {{ $municipio->municipio_id == $cliente->municipio_id ? 'selected' : '' }}>{{ $municipio->mun_nome }}</option>
                    @endforeach
                </select>
            </div>
            Informações complementares
            <div class="mb-3">
                <input type="text" placeholder="E-mail Corporativo" name="cli_email_corporativo" value="{{ $cliente->cli_email_corporativo }}" class="form-control">
            </div>
            <div class="mb-3">
                <textarea name="cli_contatos" value="{{ $cliente->cli_contatos }}" class="form-control" placeholder="Contatos"></textarea>
            </div>
            <div class="mb-3">
                <textarea name="cli_anotacao" value="{{ $cliente->cli_anotacao }}" class="form-control" placeholder="Anotações"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
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
</script>
@endsection
