<?php

namespace Database\Factories;

use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;

/**
 * @extends Factory<Funcionario>
 */
class FuncionarioFactory extends Factory
{
    // Guarda os IDs dos usuários usados para não repetir
    private static $usuariosUsados = [];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): 
    array{
        // Procura usuarios com categoria funcionario
        $usuario = Usuario::where(
            'categoria_usuario',
            'funcionario'
        )
        // Evita pegar usuarios que já são funcionarios
        ->whereNotIn('id',self::$usuariosUsados)
        ->inRandomOrder()
        ->first();

        if (!$usuario) {
            throw new \Exception(
                'Não existem usuários funcionários disponíveis.'
            );
        }

        self::$usuariosUsados[] = $usuario->id;

        return [

            'usuario_id' => $usuario->id,
            'nome_cargo' => $this->faker->randomElement(['mecânico','contador','gerente','atendente','almoxarife']),
            'salario' => $this->faker->randomFloat(2, 1000, 10000),

        ];
    }
}
