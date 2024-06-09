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
        Schema::create('nfse_codigo_servico', function (Blueprint $table) {
            $table->id('nfse_codigo_servico_id');
            $table->char('nfc_codigo', 20)->nullable();
            $table->string('nfc_nome', 255)->nullable();
            $table->string('nfc_company_id', 100)->nullable();
            $table->char('nfc_padrao', 1)->nullable()->default('s');
            $table->timestamp('excluido')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfse_codigo_servico');
    }
};
