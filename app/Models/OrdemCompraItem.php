<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdemCompra;
use App\Models\Produto;

class OrdemCompraItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrdemCompraItemFactory> */
    use HasFactory;
    protected $table = "ordem_compra_item";

    protected $fillable = [
        'ordem_compra_id',
        'produto_id',
        'quantidade',
        'valor_total',
    ];

    protected $casts = [
        'valor_total' => 'float',
    ];

    public function ordem_compra()
    {
        return $this->belongsTo(OrdemCompra::class, 'ordem_compra_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
