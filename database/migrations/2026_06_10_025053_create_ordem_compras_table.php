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
        Schema::create('ordem_compra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained()->cascadeOnDelete();
            $table->date('data_compra');
            $table->string('status');
            $table->decimal('valor_total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_compras');
    }
};
