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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome',100);
            $table->string('cpf_cnpj',30);
            $table->string('email',30);
            $table->string('telefone',20);
            $table->string('endereco',100);
            $table->string('categoria_usuario',30);
            $table->string('plano_fid',30);
            $table->string('imagem',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
