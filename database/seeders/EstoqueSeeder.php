<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estoque;
use App\Models\Produto;

class EstoqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produtos = Produto::all();

        foreach ($produtos as $produto) {
            Estoque::factory()->forProduto($produto)->create();
        }
    }
}
