<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrdemServico;
use App\Models\FormaPagamento;

class Pagamento extends Model
{
    /** @use HasFactory<\Database\Factories\PagamentoFactory> */
    use HasFactory;

    protected $table = 'pagamentos';

    protected $fillable = [
        'user_id',
        'ordem_servico_id',
        'forma_pagamento_id',
        'valor_bruto',
        'desconto',
        'valor_total',
        'status',
        'data_pago',
        'data_vencimento',
    ];

    protected $casts = [
        'data_pago' => 'datetime',
        'data_vencimento' => 'date',
        'valor_bruto' => 'float',
        'desconto' => 'float',
        'valor_total' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ordemServico()
    {
        return $this->belongsTo(OrdemServico::class, 'ordem_servico_id');
    }

    public function formaPagamento()
    {
        return $this->belongsTo(FormaPagamento::class, 'forma_pagamento_id');
    }
}
