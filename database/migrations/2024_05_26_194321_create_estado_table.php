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
        Schema::create('estado', function (Blueprint $table) {
            $table->char('estado_id', 2)->primary();
            $table->string('est_nome', 72)->nullable();
            $table->timestamp('excluido')->nullable();
            $table->index('estado_id', 'idx_1')->using('BTREE');
            $table->index('est_nome', 'idx_2')->using('BTREE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado');
    }
};
