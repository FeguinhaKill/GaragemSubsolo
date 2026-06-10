<?php

namespace App\Observers;

use App\Models\OrdemCompraItem;
use App\Models\Produto;

class OrdemCompraItemObserver
{
    /**
     * Chamado quando um OrdemCompraItem está sendo criado
     */
    public function creating(OrdemCompraItem $item)
    {
        $this->definirValorTotalDoItem($item);
    }

    /**
     * Chamado quando um OrdemCompraItem é criado
     */
    public function created(OrdemCompraItem $item)
    {
        $this->atualizarEstoque($item, -1);
        $this->atualizarValorTotal($item);
    }

    /**
     * Chamado quando um OrdemCompraItem está sendo atualizado
     */
    public function updating(OrdemCompraItem $item)
    {
        $this->definirValorTotalDoItem($item);
    }

    /**
     * Chamado quando um OrdemCompraItem é atualizado
     */
    public function updated(OrdemCompraItem $item)
    {
        $this->atualizarValorTotal($item);
    }

    /**
     * Chamado quando um OrdemCompraItem é deletado
     */
    public function deleted(OrdemCompraItem $item)
    {
        $this->atualizarEstoque($item, 1);
        $this->atualizarValorTotal($item);
    }

    /**
     * Define o valor_total do item com base no preço do produto e na quantidade
     */
    private function definirValorTotalDoItem(OrdemCompraItem $item)
    {
        $produto = Produto::find($item->produto_id);
        $item->valor_total = $produto
            ? round($produto->preco * $item->quantidade, 2)
            : 0;
    }

    /**
     * Atualiza o valor total da OrdemServico
     */
    private function atualizarValorTotal(OrdemCompraItem $item)
    {
        if ($item->ordem_compra) {
            $item->ordem_compra->calcularValorTotal();
        }
    }

    private function atualizarEstoque(OrdemCompraItem $item, int $sinal): void
    {
        $produto = $item->produto()->first();

        if (! $produto) {
            return;
        }

        $estoque = $produto->estoque()->first();

        if (! $estoque) {
            return;
        }

        $quantidadeUsada = max(0, (int) $item->quantidade);
        $estoque->quantidade = max(0, (int) $estoque->quantidade + ($sinal * $quantidadeUsada));
        $estoque->save();
    }
}
