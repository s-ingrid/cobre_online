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
        Schema::create('contrato', function (Blueprint $table) {
            $table->id('contrato_id');
            $table->integer('licenciada_id')->nullable();
            $table->unsignedBigInteger('cliente_id')->unsigned()->nullable();
            $table->integer('conta_id')->nullable();
            $table->char('ctr_enviar_email', 1)->default('s');
            $table->char('ctr_enviar_aviso', 1)->default('s');
            $table->char('ctr_enviar_atraso', 3)->default('s');
            $table->integer('ctr_periodicidade')->nullable();
            $table->decimal('ctr_taxa', 10, 2)->nullable();
            $table->decimal('ctr_juros', 10, 2)->nullable();
            $table->decimal('ctr_multa', 10, 2)->nullable();
            $table->decimal('ctr_desconto', 10, 2)->nullable();
            $table->decimal('ctr_valor', 10, 2)->nullable();
            $table->date('ctr_data_vencimento')->nullable();
            $table->string('ctr_descricao', 255)->nullable();
            $table->string('ctr_instrucao', 255)->nullable();
            $table->string('ctr_observacao', 255)->nullable();
            $table->integer('ctr_parcelamento')->default(1);
            $table->char('ctr_ativo', 1)->default('s');
            $table->date('ctr_data_renovacao')->nullable();
            $table->decimal('ctr_valor_desconto', 10, 2)->nullable();
            $table->char('ctr_cartao', 1)->nullable()->default('N');
            $table->enum('ctr_pix', ['S', 'N'])->default('N');
            $table->enum('ctr_boleto', ['S', 'N'])->default('S');
            $table->integer('ctr_qtd_parcelas')->default(1);
            $table->enum('ctr_assinatura', ['S', 'N'])->nullable()->default('N');
            $table->integer('ctr_qtd_tentativas')->nullable()->default(0);
            $table->enum('ctr_emitir_nfse', ['S', 'N'])->nullable()->default('N');
            $table->unsignedBigInteger('nfse_codigo_servico_id')->unsigned()->nullable();
            $table->double('ctr_retencao', 10, 2)->default(0.00);
            $table->text('ctr_nfe_mensagem')->nullable();
            $table->string('ctr_observacao_interna', 255)->nullable();
            $table->enum('ctr_aceitar_bitcoin', ['S', 'N'])->nullable()->default('N');
            $table->unsignedBigInteger('centro_custo_id')->unsigned()->nullable();
            $table->timestamp('ctr_data_cadastro')->nullable();
            $table->enum('ctr_emitir_nfse_antes_quitacao', ['S', 'N'])->nullable()->default('S');
            $table->unsignedBigInteger('lancamento_categoria_id')->unsigned()->nullable();
            $table->timestamp('cadastrado')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('atualizado')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('excluido')->nullable();
            $table->integer('ctr_tolerancia')->nullable()->default(0);
            $table->string('ctr_sku', 20)->nullable();
            $table->char('ctr_enviar_cobranca_wpp', 1)->default('S');
            $table->char('ctr_enviar_aviso_wpp', 1)->default('S');
            $table->foreign('cliente_id')->references('cliente_id')->on('cliente')->onDelete('cascade');
            $table->foreign('nfse_codigo_servico_id')->references('nfse_codigo_servico_id')->on('nfse_codigo_servico')->onDelete('set null');
            $table->foreign('lancamento_categoria_id')->references('lancamento_categoria_id')->on('lancamento_categoria')->onDelete('set null');
            $table->foreign('centro_custo_id')->references('centro_custo_id')->on('centro_custo')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato');
    }
};
