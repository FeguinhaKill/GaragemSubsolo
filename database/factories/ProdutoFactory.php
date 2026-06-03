<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
$sentenca = random_int(1, 3);
        return [

            'nome' => fake()->words($sentenca, true),

            'marca' => fake()->randomElement([
                'Shimano',
                'Sram',
                'KMC',
                'Pirelli',
                'Absolute',
                'TSW'
            ]),

            'preco' => $this->faker->randomFloat(2, 20, 900),
            'descricao' => $this->faker->sentence(),
            'imagem' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
