<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormaPagamento extends Model
{
    use HasFactory;
    protected $table = 'forma_pagamentos';

    protected $fillable = [
        'nome',
        'desconto',
    ];
}
