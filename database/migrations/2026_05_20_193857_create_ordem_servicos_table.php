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
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained()->cascadeOnDelete();
            $table->foreignId('funcionario_id')->constrained()->cascadeOnDelete();
            $table->data_abertura();
            $table->data_fechamento();
            $table->status();
            $table->valor_total();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_servicos');
    }
};
