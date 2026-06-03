<?php

namespace App\Observers;

use App\Models\OrdemServicoitem;

class OrdemServicoItemObserver
{
    /**
     * Chamado quando um OrdemServicoItem é criado
     */
    public function created(OrdemServicoitem $item)
    {
        $this->atualizarValorTotal($item);
    }

    /**
     * Chamado quando um OrdemServicoItem é atualizado
     */
    public function updated(OrdemServicoitem $item)
    {
        $this->atualizarValorTotal($item);
    }

    /**
     * Chamado quando um OrdemServicoItem é deletado
     */
    public function deleted(OrdemServicoitem $item)
    {
        $this->atualizarValorTotal($item);
    }

    /**
     * Atualiza o valor total da OrdemServico
     */
    private function atualizarValorTotal(OrdemServicoitem $item)
    {
        if ($item->ordem_servico) {
            $item->ordem_servico->calcularValorTotal();
        }
    }
}
