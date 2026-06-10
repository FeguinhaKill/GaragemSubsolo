<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClienteSolicitarServicoTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_create_a_service_request(): void
    {
        $usuario = Usuario::factory()->create(['categoria_usuario' => 'cliente']);
        Usuario::factory()->create(['categoria_usuario' => 'funcionario']);

        $response = $this->withSession(['usuario_id' => $usuario->id])
            ->post(route('ordem_servico.storeClienteRequest'), [
                'descricao' => 'Preciso de revisão completa na bicicleta, com ajuste de freio e corrente.',
            ]);

        $response->assertRedirect(route('ordem_servico.formclientes'));
        $response->assertSessionHas('success', 'Solicitação de serviço criada com sucesso!');

        $this->assertDatabaseHas('ordem_servico', [
            'usuario_id' => $usuario->id,
            'status' => 'aberta',
            'descricao' => 'Preciso de revisão completa na bicicleta, com ajuste de freio e corrente.',
        ]);

        $this->assertDatabaseHas('ordem_servico', [
            'usuario_id' => $usuario->id,
            'valor_total' => 0,
        ]);
    }
}
