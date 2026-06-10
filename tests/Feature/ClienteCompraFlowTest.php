<?php

namespace Tests\Feature;

use App\Models\Estoque;
use App\Models\FormaPagamento;
use App\Models\OrdemCompra;
use App\Models\Produto;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClienteCompraFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_buy_a_product_and_be_redirected_to_purchase_payment(): void
    {
        $usuario = Usuario::factory()->create(['categoria_usuario' => 'cliente']);
        $produto = Produto::create([
            'nome' => 'Bicicleta Teste',
            'marca' => 'Marca',
            'preco' => 149.90,
            'descricao' => 'Teste',
            'tipo' => 'Bicicleta',
            'imagem' => 'images/produtos/semimagem.jpeg',
        ]);

        Estoque::create([
            'produto_id' => $produto->id,
            'quantidade' => 5,
        ]);

        FormaPagamento::factory()->create([
            'nome' => 'PIX',
            'desconto' => 0.00,
        ]);

        $response = $this->withSession(['usuario_id' => $usuario->id])
            ->post(route('produtos.comprar', $produto->id));

        $response->assertRedirect();

        $ordemCompra = OrdemCompra::where('usuario_id', $usuario->id)->latest()->first();
        $this->assertNotNull($ordemCompra);
        $this->assertEquals('aberta', $ordemCompra->status);
        $this->assertEquals($produto->preco, $ordemCompra->valor_total);

        $this->assertDatabaseHas('ordem_compra_item', [
            'ordem_compra_id' => $ordemCompra->id,
            'produto_id' => $produto->id,
            'quantidade' => 1,
        ]);

        $this->assertDatabaseHas('pagamentosCompra', [
            'ordem_compra_id' => $ordemCompra->id,
            'usuario_id' => $usuario->id,
        ]);
    }
}
