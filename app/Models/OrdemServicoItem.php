<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdemServico;
use App\Models\Produto;

class OrdemServicoitem extends Model
{
    use HasFactory;
    /** @use HasFactory<\Database\Factories\OrdemServicoFactory> */
    protected $table = "ordem_servico_item";

    protected $fillable = [
        'ordem_servico_id',
        'produto_id',
        'quantidade',
        'tipo_servico',
        'valor_total',
    ];

    protected $casts = [
        'data_abertura' => 'date',
        'data_fechamento' => 'date',
        'valor_total' => 'float',
    ];

    public function ordem_servico()
    {
        return $this->belongsTo(OrdemServico::class, 'ordem_servico_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
