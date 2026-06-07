<?php

namespace App\Observers;

use App\Models\OrdemServico;
use App\Models\Pagamento;
use App\Models\FormaPagamento;

class OrdemServicoObserver
{
    
    public function saved(OrdemServico $ordemServico)
    {
        if ($ordemServico->valor_total <= 0) {
            return;
        }

        $pagamento = Pagamento::where('ordem_servico_id', $ordemServico->id)->first();

        if ($pagamento) {
            if ($pagamento->status === 'pago') {
                return;
            }

            $formaPagamento = $pagamento->formaPagamento ?? FormaPagamento::inRandomOrder()->first();
            if (! $formaPagamento) {
                return;
            }

            $valorBruto = $ordemServico->valor_total;
            $desconto = $formaPagamento->desconto;
            $valorTotal = round($valorBruto * (1 - $desconto / 100), 2);

            $pagamento->update([
                'valor_bruto' => $valorBruto,
                'desconto' => $desconto,
                'valor_total' => $valorTotal,
                'forma_pagamento_id' => $formaPagamento->id,
            ]);

            return;
        }

        $formaPagamento = FormaPagamento::inRandomOrder()->first();
        if (! $formaPagamento) {
            return;
        }

        $valorBruto = $ordemServico->valor_total;
        $desconto = $formaPagamento->desconto;
        $valorTotal = round($valorBruto * (1 - $desconto / 100), 2);

        Pagamento::create([
            'usuario_id' => $ordemServico->usuario_id,
            'ordem_servico_id' => $ordemServico->id,
            'forma_pagamento_id' => $formaPagamento->id,
            'valor_bruto' => $valorBruto,
            'desconto' => $desconto,
            'valor_total' => $valorTotal,
            'status' => 'em andamento',
            'data_vencimento' => now()->addDays(30),
        ]);
    }
}
