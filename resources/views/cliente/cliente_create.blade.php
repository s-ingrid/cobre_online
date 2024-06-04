@extends('auth.layout')
@section('auth.content')
<form action="{{ route('cliente.store') }}"  method="post">
    @csrf
    <div class="d-flex justify-content-center">
        <div class="card m-5" style="width: 50vw;">
            <div class="mb-3">
                <input type="text" placeholder="CPF/CNPJ" name="cli_cpf_cnpj" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Razão Social" name="cli_empresa" class="form-control">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Nome fantasia" name="cli_nome_fantasia" class="form-control">
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
            Endereço
            <div class="mb-3">
                <input type="text" placeholder="CEP" name="cli_cep" class="form-control">
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
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
            </div>
            <div class="mb-3">
                <select id="municipio" name="municipio_id" class="form-select">
                    <option disabled selected>Selecione primeiro o estado</option>
                </select>
            </div>
            Informações complementares
            <div class="mb-3">
                <input type="text" placeholder="E-mail Corporativo" name="cli_email_corporativo" class="form-control">
            </div>
            <div class="mb-3">
                <textarea name="cli_contatos" class="form-control" placeholder="Contatos"></textarea>
            </div>
            <div class="mb-3">
                <textarea name="cli_anotacao" class="form-control" placeholder="Anotações"></textarea>
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
