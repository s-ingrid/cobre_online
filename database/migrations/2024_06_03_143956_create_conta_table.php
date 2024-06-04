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
        Schema::create('conta', function (Blueprint $table) {
            $table->id('conta_id');
            $table->string('cta_local_pagamento')->default('');
            $table->string('cta_nome_cedente')->nullable();
            $table->string('cta_descricao')->nullable();
            $table->char('cta_especie_documento', 2)->default('DM');
            $table->char('cta_aceite', 1)->default('N');
            $table->char('cta_especie_valor', 2)->default('R$');
            $table->char('cta_agencia', 10)->nullable();
            $table->integer('cta_agencia_digito')->nullable();
            $table->char('cta_conta', 11)->nullable();
            $table->integer('cta_conta_digito')->nullable();
            $table->char('cta_codigo_cedente', 10)->nullable();
            $table->char('cta_padrao', 1)->nullable();
            $table->string('cta_instrucao')->nullable();
            $table->integer('cta_nosso_numero')->nullable();
            $table->char('cta_contrato', 15)->nullable();
            $table->integer('licenciada_id')->unsigned()->nullable();
            $table->unsignedBigInteger('banco_id')->unsigned()->nullable();
            $table->char('carteira_id', 10)->nullable();
            $table->char('cta_variacao_carteira', 10)->nullable();
            $table->double('cta_taxa', 10, 2)->nullable();
            $table->double('cta_juros', 10, 2)->nullable();
            $table->double('cta_multa', 10, 2)->nullable();
            $table->string('cta_observacao')->nullable();
            $table->timestamp('excluido')->nullable();
            $table->timestamps();
            $table->enum('cta_gerar_remessa', ['S', 'N'])->default('N');
            $table->string('cta_cpf_cnpj')->nullable();
            $table->string('cta_seller_id')->nullable();
            $table->decimal('cta_taxa_zoop', 10, 2)->default(0.00);
            $table->unsignedBigInteger('cta_conta_transferencia')->nullable();
            $table->enum('cta_enviar_recibo', ['S', 'N'])->default('S');
            $table->string('cta_company_id')->nullable();
            $table->string('cta_gateway_id')->nullable();
            $table->string('cta_gateway_key')->nullable();
            $table->enum('cta_gateway', ['zoop', 'rede', 'cielo', 'getnet'])->default('zoop');
            $table->tinyInteger('cta_dias_vencimento')->default(30);
            $table->index('conta_id', 'idx_1')->using('BTREE');
            $table->unique('conta_id');
            $table->foreign('banco_id')->references('banco_id')->on('banco')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conta');
    }
};
