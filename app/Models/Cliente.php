<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    protected $primaryKey = 'cliente_id';

    protected $fillable = [
        'estado_id',
        'municipio_id',
        'cli_empresa',
        'cli_nome_fantasia',
        'cli_responsavel',
        'cli_cpf_cnpj',
        'cli_cep',
        'cli_endereco',
        'cli_numero',
        'cli_bairro',
        'cli_complemento',
        'cli_telefone',
        'cli_celular',
        'cli_ativo',
        'cli_email',
        'cli_site',
        'cli_login',
        'cli_senha',
        'licenciada_id',
        'cli_anotacao',
        'cli_contatos',
        'cli_email_corporativo',
        'cli_buyer_id',
        'cli_inscricao_municipal',
        'cli_sku',
        'cadastrado',
        'atualizado',
        'excluido',
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'municipio_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'estado_id');
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'cliente_id', 'cliente_id');
    }
}
