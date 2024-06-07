<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public readonly Cliente $cliente;

    public function __construct() {
        $this->cliente = new Cliente();
    }
    public function index()
    {
        $clientes = $this->cliente->all();
        return view('cliente.cliente', ['clientes' => $clientes]);
    }

    public function create(Request $request)
    {
        $estados = Estado::all();
        return view('cliente.cliente_create', ['estados'=> $estados]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'estado_id' => 'nullable|size:2',
            'municipio_id' => 'nullable|integer',
            'cli_empresa' => 'required|string|max:255',
            'cli_nome_fantasia' => 'required|string|max:255',
            'cli_responsavel' => 'nullable|string|max:255',
            'cli_cpf_cnpj' => 'required|string|max:255',
            'cli_cep' => 'nullable|size:9',
            'cli_endereco' => 'nullable|string|max:255',
            'cli_numero' => 'nullable|string|max:20',
            'cli_bairro' => 'nullable|string|max:255',
            'cli_complemento' => 'nullable|string|max:255',
            'cli_telefone' => 'nullable|string|max:100',
            'cli_celular' => 'nullable|string|max:15',
            'cli_ativo' => 'nullable|char|max:1',
            'cli_email' => 'nullable|string|email|max:255',
            'cli_site' => 'nullable|string|max:255',
            'cli_login' => 'nullable|string|max:255',
            'cli_senha' => 'nullable|string|max:50',
            'licenciada_id' => 'nullable|string',
            'cli_anotacao' => 'nullable|string',
            'cli_contatos' => 'nullable|string',
            'cli_email_corporativo' => 'nullable|string|email|max:255',
            'cli_buyer_id' => 'nullable|string|max:255',
            'cli_inscricao_municipal' => 'nullable|string|max:50',
            'cli_sku' => 'nullable|string|max:100',
            'cadastrado' => 'nullable|date',
            'atualizado' => 'nullable|date',
            'excluido' => 'nullable|date',
        ]);

        $this->cliente->create([
            'estado_id' => $request->estado_id,
            'municipio_id' => $request->municipio_id,
            'cli_empresa' => $request->cli_empresa,
            'cli_nome_fantasia' => $request->cli_nome_fantasia,
            'cli_responsavel' => $request->cli_responsavel,
            'cli_cpf_cnpj' => $request->cli_cpf_cnpj,
            'cli_cep' => $request->cli_cep,
            'cli_endereco' => $request->cli_endereco,
            'cli_numero' => $request->cli_numero,
            'cli_bairro' => $request->cli_bairro,
            'cli_complemento' => $request->cli_complemento,
            'cli_telefone' => $request->cli_telefone,
            'cli_celular' => $request->cli_celular,
            'cli_ativo' => $request->cli_ativo,
            'cli_email' => $request->cli_email,
            'cli_site' => $request->cli_site,
            'cli_login' => $request->cli_login,
            'cli_senha' => $request->cli_senha,
            'licenciada_id' => $request->licenciada_id,
            'cli_anotacao' => $request->cli_anotacao,
            'cli_contatos' => $request->cli_contatos,
            'cli_email_corporativo' => $request->cli_email_corporativo,
            'cli_buyer_id' => $request->cli_buyer_id,
            'cli_inscricao_municipal' => $request->cli_inscricao_municipal,
            'cli_sku' => $request->cli_sku,
        ]);

        return redirect()->route('cliente.index')->with('message', 'Criado com sucesso!');
    }

    public function edit(string $id)
    {
        $cliente = $this->cliente->find($id);
        $estados = Estado::all();
        $municipios = Municipio::all();
        return view('cliente.cliente_update', [
            'cliente' => $cliente,
            'estados' => $estados,
            'municipios'=> $municipios
        ]);
    }


    public function update(Request $request, $id)
    {
        $cliente = $this->cliente->find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $request->validate([
            'estado_id' => 'nullable|size:2',
            'municipio_id' => 'nullable|integer',
            'cli_empresa' => 'required|string|max:255',
            'cli_nome_fantasia' => 'required|string|max:255',
            'cli_responsavel' => 'nullable|string|max:255',
            'cli_cpf_cnpj' => 'required|string|max:255',
            'cli_cep' => 'nullable|size:9',
            'cli_endereco' => 'nullable|string|max:255',
            'cli_numero' => 'nullable|string|max:20',
            'cli_bairro' => 'nullable|string|max:255',
            'cli_complemento' => 'nullable|string|max:255',
            'cli_telefone' => 'nullable|string|max:100',
            'cli_celular' => 'nullable|string|max:15',
            'cli_ativo' => 'nullable|char|max:1',
            'cli_email' => 'nullable|string|email|max:255',
            'cli_site' => 'nullable|string|max:255',
            'cli_login' => 'nullable|string|max:255',
            'cli_senha' => 'nullable|string|max:50',
            'licenciada_id' => 'nullable|string',
            'cli_anotacao' => 'nullable|string',
            'cli_contatos' => 'nullable|string',
            'cli_email_corporativo' => 'nullable|string|email|max:255',
            'cli_buyer_id' => 'nullable|string|max:255',
            'cli_inscricao_municipal' => 'nullable|string|max:50',
            'cli_sku' => 'nullable|string|max:100',
            'cadastrado' => 'nullable|date',
            'atualizado' => 'nullable|date',
            'excluido' => 'nullable|date',
        ]);

        $cliente->update([
            'estado_id' => $request->estado_id,
            'municipio_id' => $request->municipio_id,
            'cli_empresa' => $request->cli_empresa,
            'cli_nome_fantasia' => $request->cli_nome_fantasia,
            'cli_responsavel' => $request->cli_responsavel,
            'cli_cpf_cnpj' => $request->cli_cpf_cnpj,
            'cli_cep' => $request->cli_cep,
            'cli_endereco' => $request->cli_endereco,
            'cli_numero' => $request->cli_numero,
            'cli_bairro' => $request->cli_bairro,
            'cli_complemento' => $request->cli_complemento,
            'cli_telefone' => $request->cli_telefone,
            'cli_celular' => $request->cli_celular,
            'cli_ativo' => $request->cli_ativo,
            'cli_email' => $request->cli_email,
            'cli_site' => $request->cli_site,
            'cli_login' => $request->cli_login,
            'cli_senha' => $request->cli_senha,
            'licenciada_id' => $request->licenciada_id,
            'cli_anotacao' => $request->cli_anotacao,
            'cli_contatos' => $request->cli_contatos,
            'cli_email_corporativo' => $request->cli_email_corporativo,
            'cli_buyer_id' => $request->cli_buyer_id,
            'cli_inscricao_municipal' => $request->cli_inscricao_municipal,
            'cli_sku' => $request->cli_sku,
        ]);

        return redirect()->route('cliente.index')->with('message', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $cliente = $this->cliente->find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $cliente->delete();
        return redirect()->route('cliente.index')->with('message', 'Deletado com sucesso!');
    }
}
