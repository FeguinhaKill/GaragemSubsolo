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
       Schema::create('ordem_compra_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordem_compra_id')->constrained('ordem_compra')->cascadeOnDelete();
            $table->foreignId('produto_id')->constrained()->cascadeOnDelete();
            $table->integer('quantidade');
            $table->decimal('valor_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_compra_item');
    }
};
