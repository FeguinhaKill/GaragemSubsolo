<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Funcionario;

class OrdemServico extends Model
{
    use HasFactory;
    /** @use HasFactory<\Database\Factories\OrdemServicoFactory> */
    protected $table = "ordem_servicos";

    protected $fillable = [
        'usuario_id',
        'funcionario_id',
        'data_abertura',
        'data_fechamento',
        'status',
        'valor_total',

    ];

    protected $casts = [
        'data_abertura' => 'date',
        'data_fechamento' => 'date',
        'valor_total' => 'float',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

}
