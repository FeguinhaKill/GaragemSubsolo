<?php

namespace Tests\Feature;

use App\Models\FormaPagamento;
use App\Models\OrdemCompra;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrdemCompraPaymentObserverTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_payment_for_a_purchase_order(): void
    {
        $usuario = Usuario::factory()->create();
        FormaPagamento::factory()->create([
            'nome' => 'PIX',
            'desconto' => 10.00,
        ]);

        $ordemCompra = OrdemCompra::factory()->create([
            'usuario_id' => $usuario->id,
            'valor_total' => 100.00,
        ]);

        $this->assertDatabaseHas('pagamentosCompra', [
            'ordem_compra_id' => $ordemCompra->id,
            'usuario_id' => $usuario->id,
            'status' => 'em andamento',
        ]);
    }
}
