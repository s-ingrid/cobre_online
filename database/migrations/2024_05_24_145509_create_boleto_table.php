<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boleto', function (Blueprint $table) {
            $table->increments('boleto_id');
            $table->unsignedBigInteger('contrato_id')->unsigned()->nullable();
            $table->date('blt_data_vencimento')->nullable();
            $table->timestamp('blt_data_cadastro')->nullable();
            $table->double('blt_valor', 10, 2)->nullable();
            $table->decimal('blt_valor_pago', 10, 2)->nullable();
            $table->double('blt_taxa', 10, 2)->nullable();
            $table->string('blt_descricao', 255)->nullable();
            $table->string('blt_observacao', 255)->nullable();
            $table->string('blt_chave', 50)->nullable();
            $table->decimal('blt_desconto', 10, 2)->nullable();
            $table->double('blt_juros', 10, 2)->nullable();
            $table->double('blt_multa', 10, 2)->nullable();
            $table->date('blt_data_pago')->nullable();
            $table->decimal('blt_valor_tarifa', 10, 2)->nullable();
            $table->integer('blt_qtd_parcelas')->default(1);
            $table->integer('lote_id')->nullable();
            $table->timestamp('atualizado')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->enum('blt_registrado', ['S', 'N'])->default('N');
            $table->integer('remessa_id')->nullable();
            $table->enum('blt_erro_registro', ['S', 'N'])->nullable();
            $table->string('blt_zoop_id', 100)->nullable();
            $table->string('blt_link', 255)->nullable();
            $table->string('blt_transacao_id', 100)->nullable();
            $table->string('blt_transacao_id_pix', 255)->nullable();
            $table->text('blt_webhook_log')->nullable();
            $table->string('blt_numero_nfse', 50)->nullable();
            $table->enum('blt_erro_nota', ['S', 'N'])->nullable();
            $table->integer('forma_pagamento_id')->default(1);
            $table->date('blt_vencimento_original')->nullable();
            $table->timestamp('excluido')->nullable();
            $table->timestamp('cadastrado')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('contrato_id')->references('contrato_id')->on('contrato')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boleto');
    }
};
