<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtualizacaoServico extends Model
{
    /** @use HasFactory<\Database\Factories\AtualizacaoServicoFactory> */
    use HasFactory;
     protected $fillable = [
        'ordem_servico_id',
        'usuario_id',
        'funcionario_id',
        'data_atualizacao',
        'comentario',
    ];

    public function produto()
    {
        return $this->belongsTo(OrdemServico::class, 'ordem_servico_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }
}
