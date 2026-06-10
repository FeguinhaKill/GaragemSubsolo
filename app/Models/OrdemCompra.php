<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\PagamentoCompra;
use App\Models\OrdemCompraitem;

class OrdemCompra extends Model
{
    /** @use HasFactory<\Database\Factories\OrdemCompraFactory> */
    use HasFactory;
    protected $table = "ordem_compra";

    protected $fillable = [
        'usuario_id',
        'data_compra',
        'status',
        'valor_total',
    ];

    protected $casts = [
        'data_compra' => 'date',
        'valor_total' => 'float',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }


    public function itens()
    {
        return $this->hasMany(OrdemCompraitem::class, 'ordem_compra_id');
    }

    public function pagamentoscompra()
    {
        return $this->hasMany(PagamentoCompra::class, 'ordem_compra_id');
    }

    public function calcularValorTotalCompra()
    {
        $total = $this->itens()->sum('valor_total');
        $this->update(['valor_total' => $total]);
        return $total;
    }

}

