<?php

namespace Database\Factories;

use App\Models\FormaPagamento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FormaPagamento>
 */
class FormaPagamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'desconto' => 0.00,
        ];
    }
    public function configure()
    {
        return $this->sequence(
            ['nome' => 'PIX', 'desconto' => 15.00],
            ['nome' => 'Cartão de Crédito', 'desconto' => 0.00],
            ['nome' => 'Cartão de Débito', 'desconto' => 0.00],
            ['nome' => 'Boleto Bancário', 'desconto' => 7.50],
            ['nome' => 'Dinheiro', 'desconto' => 15.00],
        );
    }
}
