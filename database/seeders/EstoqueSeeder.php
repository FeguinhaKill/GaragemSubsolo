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
        $localizacoes = [];

        for ($rack = 1; $rack <= 4; $rack++) {
            for ($bloco = 1; $bloco <= 10; $bloco++) {
                for ($andar = 1; $andar <= 3; $andar++) {
                    $localizacoes[] = sprintf('R%02d.B%02d.A%d', $rack, $bloco, $andar);
                }
            }
        }

        foreach ($produtos as $index => $produto) {
            Estoque::factory()->forProduto($produto)->create([
                'unidade_medida' => ['Litro', 'Quilo', 'Unidade'][$index % 3],
                'localizacao' => $localizacoes[$index % count($localizacoes)],
            ]);
        }
    }
}
