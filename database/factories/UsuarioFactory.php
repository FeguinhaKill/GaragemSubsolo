<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'cpf_cnpj' => $this->faker->numerify('###.###.###-##'),
            'telefone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'endereco' => $this->faker->address(),
            'categoria_usuario' => $this->faker->randomElement(['cliente', 'funcionario', 'empresa']),
            'plano_fid' => $this->faker->randomElement(['plano_basico', 'plano_premium', 'plano_vip']),
            'imagem' => null,
        ];
    }
}
