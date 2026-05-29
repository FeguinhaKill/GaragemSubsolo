<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UsuarioSeeder::class,
            FuncionarioSeeder::class,
            FormaPagamentoSeeder::class,
            ProdutoSeeder::class,
            EstoqueSeeder::class,
            OrdemServicoSeeder::class,
            OrdemServicoItemSeeder::class,
            PagamentoSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
