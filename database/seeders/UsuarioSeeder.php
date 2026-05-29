<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::factory()->count(6)->create([
            'categoria_usuario' => 'cliente'
        ]);

        Usuario::factory()->count(1)->create([
            'categoria_usuario' => 'empresa'
        ]);

        Usuario::factory()->count(3)->create([
            'categoria_usuario' => 'funcionario'
        ]);
    }
}
