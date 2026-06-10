<?php

namespace Database\Factories;

use App\Models\OrdemCompraItem;
use App\Models\OrdemCompra;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrdemCompraItem>
 */
class OrdemCompraItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ordemCompraId = OrdemCompra::inRandomOrder()->value('id') ?: OrdemCompra::factory()->create()->id;
        $produtoId = Produto::inRandomOrder()->value('id') ?: Produto::factory()->create()->id;

        return [
            'ordem_compra_id' => $ordemCompraId,
            'produto_id' => $produtoId,
            'quantidade' => $this->faker->numberBetween(1, 10),
            'valor_total' => $this->faker->numberBetween(1, 5000),
        ];
    }
}
