<?php

namespace App\Observers;

use App\Models\OrdemCompra;
use App\Models\PagamentoCompra;
use App\Models\FormaPagamento;

class OrdemCompraObserver
{

    public function saved(OrdemCompra $OrdemCompra)
    {
        if ($OrdemCompra->valor_total <= 0) {
            return;
        }

        $pagamentoCompra = PagamentoCompra::where('ordem_compra_id', $OrdemCompra->id)->first();

        if ($pagamentoCompra) {
            if ($pagamentoCompra->status === 'pago') {
                return;
            }

            $FormaPagamento = $pagamentoCompra->FormaPagamento ?? FormaPagamento::inRandomOrder()->first();
            if (! $FormaPagamento) {
                return;
            }

            $valorBruto = $OrdemCompra->valor_total;
            $desconto = $FormaPagamento->desconto;
            $valorTotal = round($valorBruto * (1 - $desconto / 100), 2);

            $pagamentoCompra->update([
                'valor_bruto' => $valorBruto,
                'desconto' => $desconto,
                'valor_total' => $valorTotal,
                'forma_pagamento_id' => $FormaPagamento->id,
            ]);

            return;
        }

        $FormaPagamento = FormaPagamento::inRandomOrder()->first();
        if (! $FormaPagamento) {
            return;
        }

        $valorBruto = $OrdemCompra->valor_total;
        $desconto = $FormaPagamento->desconto;
        $valorTotal = round($valorBruto * (1 - $desconto / 100), 2);

        PagamentoCompra::create([
            'usuario_id' => $OrdemCompra->usuario_id,
            'ordem_compra_id' => $OrdemCompra->id,
            'forma_pagamento_id' => $FormaPagamento->id,
            'valor_bruto' => $valorBruto,
            'desconto' => $desconto,
            'valor_total' => $valorTotal,
            'status' => 'em andamento',
        ]);
    }
}
