<?php

namespace Database\Factories;

use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstoqueFactory extends Factory
{
    protected $model = Estoque::class;

    public function definition(): array
    {
        $localizacoes = [];

        for ($rack = 1; $rack <= 4; $rack++) {
            for ($bloco = 1; $bloco <= 10; $bloco++) {
                for ($andar = 1; $andar <= 3; $andar++) {
                    $localizacoes[] = sprintf('R%02d.B%02d.A%d', $rack, $bloco, $andar);
                }
            }
        }

        return [
            'produto_id' => Produto::factory(),
            'quantidade' => $this->faker->numberBetween(5, 100),
            'unidade_medida' => $this->faker->randomElement(['Litro', 'Quilo', 'Unidade']),
            'localizacao' => $this->faker->randomElement($localizacoes),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function forProduto(Produto $produto): self
    {
        return $this->state(function () use ($produto) {
            return [
                'produto_id' => $produto->id,
            ];
        });
    }
}
