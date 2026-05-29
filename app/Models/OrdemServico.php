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
    protected $table = "ordem_servico";

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

    public function getStatusAttribute($value)
    {
        if (!in_array($value, ['fechada', 'cancelada'], true)
            && $this->data_fechamento
            && $this->data_fechamento->lt(now()->startOfDay())
        ) {
            return 'atrasado';
        }

        return $value;
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }

}
