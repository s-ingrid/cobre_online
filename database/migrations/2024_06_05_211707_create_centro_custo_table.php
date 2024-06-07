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
        Schema::create('centro_custo', function (Blueprint $table) {
            $table->id('centro_custo_id');
            $table->string('cec_nome', 255)->nullable();
            $table->integer('licenciada_id')->nullable();
            $table->timestamp('cadastrado')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('excluido')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centro_custo');
    }
};
