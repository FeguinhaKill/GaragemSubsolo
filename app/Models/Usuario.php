<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;

class Usuario extends Model
{
    /** @use HasFactory<\Database\Factories\UsuarioFactory> */
    use HasFactory;
    
    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'email',
        'telefone',
        'endereco', 
        'categoria_usuario',
        'imagem',
        'senha',
    ];

    //Relacionamento 1:1 entre Usuário e Funcionario
    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'usuario_id');
    }
}
