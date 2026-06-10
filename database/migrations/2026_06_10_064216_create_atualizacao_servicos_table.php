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
        Schema::create('atualizacao_servicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordem_servico_id')->constrained('ordem_servico');
            $table->foreignId('usuario_id')->constrained();
            $table->foreignId('funcionario_id')->constrained();
            $table->date('data_atualizacao');
            $table->string('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atualizacao_servicos');
    }
};
