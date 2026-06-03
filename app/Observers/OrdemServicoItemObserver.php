<?php

namespace App\Observers;

use App\Models\OrdemServicoitem;
use App\Models\Produto;

class OrdemServicoItemObserver
{
    /**
     * Chamado quando um OrdemServicoItem está sendo criado
     */
    public function creating(OrdemServicoitem $item)
    {
        $this->definirValorTotalDoItem($item);
    }

    /**
     * Chamado quando um OrdemServicoItem é criado
     */
    public function created(OrdemServicoitem $item)
    {
        $this->atualizarValorTotal($item);
    }

    /**
     * Chamado quando um OrdemServicoItem está sendo atualizado
     */
    public function updating(OrdemServicoitem $item)
    {
        $this->definirValorTotalDoItem($item);
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
     * Define o valor_total do item com base no preço do produto e na quantidade
     */
    private function definirValorTotalDoItem(OrdemServicoitem $item)
    {
        $produto = Produto::find($item->produto_id);
        $item->valor_total = $produto
            ? round($produto->preco * $item->quantidade, 2)
            : 0;
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
