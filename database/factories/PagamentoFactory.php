<?php

namespace Database\Factories;

use App\Models\Pagamento;
use App\Models\User;
use App\Models\OrdemServico;
use App\Models\FormaPagamento;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pagamento>
 */
class PagamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'ordem_servico_id' => OrdemServico::factory(),
            'forma_pagamento_id' => FormaPagamento::factory(),
            'valor_bruto' => $this->faker->randomFloat(2, 50, 2000),
            'desconto' => 0.00,
            'valor_total' => 0.00,
            'status' => $this->faker->randomElement(['pago', 'em_andamento']),
            'data_pago' => null,
            'data_vencimento' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Pagamento $pagamento) {
            $percentual = $pagamento->formaPagamento->desconto ?? 0;

            $pagamento->desconto = (float)$percentual;
            $pagamento->valor_total = (float)($pagamento->valor_bruto * (100 - $percentual) / 100);

            if ($pagamento->status === 'pago' && $pagamento->data_pago === null) {
                $pagamento->data_pago = Carbon::now();
            }

            $pagamento->save();
        });
    }
}
