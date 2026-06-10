<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\OrdemCompra;
use App\Models\FormaPagamento;
use Carbon\Carbon;
use App\Models\PagamentoCompra;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PagamentoCompra>
 */
class PagamentoCompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_id' => User::factory(),
            'ordem_servico_id' => OrdemCompra::factory(),
            'forma_pagamento_id' => FormaPagamento::factory(),
            'valor_bruto' => $this->faker->randomFloat(2, 50, 2000),
            'valor_total' => 0.00,
            'status' => $this->faker->randomElement(['pago', 'em_andamento']),
            'data_pago' => null,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (PagamentoCompra $pagamentoCompra) {
            $percentual = $pagamentoCompra->formaPagamento->desconto ?? 0;

            $pagamentoCompra->desconto = (float)$percentual;
            $pagamentoCompra->valor_total = (float)($pagamentoCompra->valor_bruto * (100 - $percentual) / 100);

            if ($pagamentoCompra->status === 'pago' && $pagamentoCompra->data_pago === null) {
                $pagamentoCompra->data_pago = Carbon::now();
            }

            $pagamentoCompra->save();
        });
    }
}
