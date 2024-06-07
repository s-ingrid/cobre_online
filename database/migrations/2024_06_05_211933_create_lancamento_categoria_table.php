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
        Schema::create('lancamento_categoria', function (Blueprint $table) {
            $table->id('lancamento_categoria_id');
            $table->string('lac_descricao', 255)->nullable();
            $table->integer('tipo_custo_id')->nullable();
            $table->enum('lac_tipo', ['R', 'D'])->nullable();
            $table->enum('lac_produto_servico', ['S', 'N'])->default('N');
            $table->timestamp('cadastrado')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('atualizado')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('excluido')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamento_categoria');
    }
};
