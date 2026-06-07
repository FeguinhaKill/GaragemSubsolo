<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::factory()->count(6)->create([
            'categoria_usuario' => 'cliente'
        ]);

        Usuario::factory()->count(1)->create([
            'categoria_usuario' => 'empresa'
        ]);

        Usuario::factory()->count(3)->create([
            'categoria_usuario' => 'funcionario'
        ]);
        Usuario::create([
            'nome' => 'testeadmin',
            'cpf_cnpj' => '000.000.000-00',
            'email' => 'testeadm@gmail.com',
            'telefone' => '(00) 00000-0000',
            'endereco' => 'Rua Teste, 123',
            'categoria_usuario' => 'admin',
            'imagem' => null,
            'senha' => '123456',

        ]);
        Usuario::create([
            'nome' => 'testecliente',
            'cpf_cnpj' => '000.000.000-00',
            'email' => 'testecliente@gmail.com',
            'telefone' => '(00) 00000-0000',
            'endereco' => 'Rua Teste, 123',
            'categoria_usuario' => 'cliente',
            'imagem' => null,
            'senha' => '123456',

        ]);
    }
}
