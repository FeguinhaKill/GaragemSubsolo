<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagamentoCompra extends Model
{
    /** @use HasFactory<\Database\Factories\PagamentoCompraFactory> */
   use HasFactory;

    protected $table = 'pagamentosCompra';

    protected $fillable = [
        'usuario_id',
        'ordem_compra_id',
        'forma_pagamento_id',
        'valor_bruto',
        'desconto',
        'valor_total',
        'status',
        'data_pago',
    ];

    protected $casts = [
        'data_pago' => 'datetime',
        'valor_bruto' => 'float',
        'desconto' => 'float',
        'valor_total' => 'float',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function OrdemCompra()
    {
        return $this->belongsTo(OrdemCompra::class, 'ordem_compra_id');
    }

    public function formaPagamento()
    {
        return $this->belongsTo(FormaPagamento::class, 'forma_pagamento_id');
    }
}
