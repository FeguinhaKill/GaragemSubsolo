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
            //cria um produto novo toda vez que gerar um estoque
            'produto_id' => Produto::factory(),
            'quantidade' => $this->faker->numberBetween(0, 100),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
