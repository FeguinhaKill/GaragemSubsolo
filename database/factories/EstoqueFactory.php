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
        return [
            'produto_id' => Produto::factory(),
            'quantidade' => $this->faker->numberBetween(5, 100),
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
