<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('cliente_id');
            $table->char('estado_id', 2)->nullable();
            $table->unsignedBigInteger('municipio_id')->unsigned()->nullable();
            $table->string('cli_empresa', 255)->nullable();
            $table->string('cli_nome_fantasia', 255)->nullable();
            $table->string('cli_responsavel', 255)->nullable();
            $table->string('cli_cpf_cnpj', 255)->nullable();
            $table->char('cli_cep', 9)->nullable();
            $table->string('cli_endereco', 255)->nullable();
            $table->string('cli_numero', 20)->nullable();
            $table->string('cli_bairro', 255)->nullable()->default('Centro');
            $table->string('cli_complemento', 255)->nullable();
            $table->string('cli_telefone', 100)->nullable();
            $table->string('cli_celular', 15)->nullable();
            $table->char('cli_ativo', 1)->nullable();
            $table->string('cli_email', 255)->nullable();
            $table->string('cli_site', 255)->nullable();
            $table->string('cli_login', 255)->nullable();
            $table->string('cli_senha', 50)->nullable();
            $table->integer('licenciada_id')->unsigned()->nullable();
            $table->text('cli_anotacao')->nullable();
            $table->text('cli_contatos')->nullable();
            $table->string('cli_email_corporativo', 255)->nullable();
            $table->string('cli_buyer_id', 255)->nullable();
            $table->string('cli_inscricao_municipal', 50)->nullable();
            $table->string('cli_sku', 100)->nullable();
            $table->timestamp('cadastrado')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('atualizado')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('excluido')->nullable();
            $table->foreign('estado_id')->references('estado_id')->on('estado')->onDelete('set null');
            $table->foreign('municipio_id')->references('municipio_id')->on('municipio')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
