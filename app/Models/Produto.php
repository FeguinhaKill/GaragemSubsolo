<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'marca',
        'preco',
        'descricao',
        'imagem',
    ];

    protected $casts = [
        'preco' => 'float',
    ];


      //Um produto possui um registro de estoque

    public function estoque()
    {
        return $this->hasOne(Estoque::class);
    }
}
