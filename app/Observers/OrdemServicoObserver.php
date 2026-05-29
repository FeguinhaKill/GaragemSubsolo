<?php

namespace App\Observers;

use App\Models\OrdemServico;
use App\Models\Pagamento;
use App\Models\FormaPagamento;

class OrdemServicoObserver
{
    /**
     * Chamado quando uma OrdemServico é criada
     */
    public function created(OrdemServico $ordemServico)
    {
        // Busca uma forma de pagamento aleatória
        $formaPagamento = FormaPagamento::find(rand(1, 5));

        $valorBruto = $ordemServico->valor_total;

        $desconto = $formaPagamento->desconto;

        $valorTotal = $valorBruto * (1 - $desconto / 100);

        // Cria pagamento
        Pagamento::create([
            'usuario_id' => $ordemServico->usuario_id,
            'ordem_servico_id' => $ordemServico->id,
            'forma_pagamento_id' => $formaPagamento->id,

            'valor_bruto' => $valorBruto,
            'desconto' => $desconto,
            'valor_total' => number_format($valorTotal, 2, '.', ''),

            'status' => 'em andamento',
            'data_vencimento' => now()->addDays(30),
        ]);
    }
}