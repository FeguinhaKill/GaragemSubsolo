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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ordem_servico_id')->constrained('ordem_servico')->cascadeOnDelete();
            $table->unsignedBigInteger('forma_pagamento_id');

            $table->decimal('valor_bruto', 10, 2);
            $table->decimal('desconto', 8, 2)->default(0);
            $table->decimal('valor_total', 10, 2);

            $table->string('status')->default('em_andamento');
            $table->timestamp('data_pago')->nullable();
            $table->date('data_vencimento')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
