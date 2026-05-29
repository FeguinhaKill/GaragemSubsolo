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
            // FuncionarioSeeder removido - o Observer cria Funcionários automaticamente
            // quando um Usuário com categoria "funcionario" é criado
            FormaPagamentoSeeder::class,
            ProdutoSeeder::class,
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
