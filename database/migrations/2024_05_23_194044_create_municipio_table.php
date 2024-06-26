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
        Schema::create('municipio', function (Blueprint $table) {
            $table->id('municipio_id');
            $table->string('mun_nome', 100);
            $table->char('estado_id', 2)->nullable();
            $table->string('mun_codigo_ibge', 50)->nullable();
            $table->timestamp('excluido')->nullable();
            $table->timestamp('cadastrado')->nullable();
            $table->timestamp('atualizado')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('estado_id')->references('estado_id')->on('estado')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipio');
    }
};
