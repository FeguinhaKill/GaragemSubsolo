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
        Schema::create('ordem_servico_item', function (Blueprint $table) {
            $table->id();
            $table->ordem_servico_id();
            $table->produto_id();
            $table->quantidade();
            $table->tipo_servico();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_servico_item');
    }
};
