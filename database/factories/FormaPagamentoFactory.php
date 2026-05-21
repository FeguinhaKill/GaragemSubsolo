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
            'desconto' => null,
        ];
    }
    public function configure()
    {
        return $this->sequence(
            ['nome' => 'PIX'],
            ['nome' => 'Cartão de Crédito'],
            ['nome' => 'Cartão de Débito'],
            ['nome' => 'Boleto Bancário'],
            ['nome' => 'Dinheiro'],
        );
    }
}
