<?php

namespace Database\Factories;

use App\Models\OrdemCompra;
use App\Models\Usuario;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrdemCompra>
 */
class OrdemCompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_id' => Usuario::all()->random()->id,
            'data_compra' => Carbon::now(),
            'status' => $this->faker->randomElement(['aberta', 'fechada']),
            'valor_total' => $this->faker->numberBetween(1, 5000),
        ];
    }
}
