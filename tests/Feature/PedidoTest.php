<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PedidoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test listing Pedidos.
     *
     * @return void
     */
    public function testListPedidos()
    {
        $cliente = Cliente::factory()->create();
        $produto = Produto::factory()->create();

        Pedido::create([
            'cliente_id' => $cliente->id,
            'produto_id' => $produto->id
        ]);

        $response = $this->getJson('/api/pedidos');

        $response->assertStatus(201)
            ->assertJsonCount(1, 'data');
    }

    /**
     * Test creating a Pedido.
     *
     * @return void
     */
    public function testCreatePedido()
    {
        $cliente = Cliente::factory()->create();
        $produto = Produto::factory()->create();

        $response = $this->postJson('/api/pedidos', [
            'cliente_id' => $cliente->id,
            'produto_id' => $produto->id,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'data'
        ]);
    }

    /**
     * Test showing a Pedido.
     *
     * @return void
     */
    public function testShowPedido()
    {
        $cliente = Cliente::factory()->create();
        $produto = Produto::factory()->create();
        $pedido = Pedido::create([
            'cliente_id' => $cliente->id,
            'produto_id' => $produto->id
        ]);

        $response = $this->getJson('/api/pedidos/' . $pedido->id);

        $response->assertStatus(200)
            ->assertJson(['data' => [
                'id' => $pedido->id,
                'cliente_id' => $pedido->cliente_id,
                'produto_id' => $pedido->produto_id,
            ]]);
    }

    /**
     * Test updating a Pedido.
     *
     * @return void
     */
    public function testUpdatePedido()
    {
        $cliente1 = Cliente::factory()->create();
        Cliente::factory()->create();
        $produto1 = Produto::factory()->create();
        Produto::factory()->create();

        $pedido = Pedido::create([
            'cliente_id' => $cliente1->id,
            'produto_id' => $produto1->id
        ]);

        $response = $this->putJson('/api/pedidos/' . $pedido->id, [
            'cliente_id' => 2,
        ]);

        $response->assertStatus(200)
            ->assertJson(['data' => ['cliente_id' => 2, 'produto_id' => 1]]);
    }

    /**
     * Test deleting a Pedido.
     *
     * @return void
     */
    public function testDeletePedido()
    {
        $cliente = Cliente::factory()->create();
        $produto = Produto::factory()->create();

        $pedido = Pedido::create([
            'cliente_id' => $cliente->id,
            'produto_id' => $produto->id
        ]);

        $response = $this->deleteJson('/api/pedidos/' . $pedido->id);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Pedido deleted successfully']);

        $deletedPedido = Pedido::find($pedido->id);

        $this->assertNull($deletedPedido);
    }
}
