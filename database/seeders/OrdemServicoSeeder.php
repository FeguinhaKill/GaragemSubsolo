<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OrdemServico;
use Illuminate\Database\Seeder;

class OrdemServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrdemServico::factory()->count(5)->create();
    }
}
