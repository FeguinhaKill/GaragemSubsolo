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
        Schema::table('ordem_servico_item', function (Blueprint $table) {
            if (! Schema::hasColumn('ordem_servico_item', 'valor_total')) {
                $table->decimal('valor_total', 10, 2)->default(0)->after('tipo_servico');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordem_servico_item', function (Blueprint $table) {
            $table->dropColumn('valor_total');
        });
    }
};
