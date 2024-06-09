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
        Schema::create('banco', function (Blueprint $table) {
            $table->id('banco_id');
            $table->char('bco_numero', 3)->default('');
            $table->string('bco_nome', 50)->default('');
            $table->char('bco_ativo', 1)->default('s');
            $table->string('bco_arquivo', 50)->nullable();
            $table->dateTime('excluido')->nullable();
            $table->timestamp('cadastrado')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banco');
    }
};
