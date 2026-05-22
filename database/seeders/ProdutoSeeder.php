<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estoque;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Estoque::factory()->count(10)->create();
    }
}
