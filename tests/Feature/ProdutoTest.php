<?php

namespace Tests\Feature;

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdutoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test listing Pedidos.
     *
     * @return void
     */
    public function testListProdutos()
    {
        Produto::factory(5)->create();

        $response = $this->getJson('/api/produtos');

        $response->assertStatus(201)
            ->assertJsonCount(5, 'data');
    }

    /**
     * Test creating a Pedido.
     *
     * @return void
     */
    public function testCreateProduto()
    {
        $produto = Produto::factory()->create();

        $response = $this->postJson('/api/produtos', [
            'name' => $produto->name,
            'price' => $produto->price,
            'thumb' => $produto->thumb
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
    public function testShowProduto()
    {
        $produto = Produto::factory()->create();

        $response = $this->getJson('/api/produtos/' . $produto->id);

        $response->assertStatus(200)
            ->assertJson(['data' => [
                'id' => $produto->id,
                'name' => $produto->name,
                'price' => $produto->price,
                'thumb' => $produto->thumb
            ]]);
    }

    /**
     * Test updating a Pedido.
     *
     * @return void
     */
    public function testUpdateProduto()
    {
        $produto = Produto::factory()->create();

        $response = $this->putJson('/api/produtos/' . $produto->id, [
            'name' => 'Test Name',
        ]);

        $response->assertStatus(200)
            ->assertJson(['data' => [
                'name' => 'Test name',
                'price' => $produto->price,
                'thumb' => $produto->thumb
            ]]);
    }

    /**
     * Test deleting a Pedido.
     *
     * @return void
     */
    public function testDeleteProduto()
    {
        $produto = Produto::factory()->create();

        $response = $this->deleteJson('/api/produtos/' . $produto->id);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Produto deleted successfully']);

        $deletedProduto = Produto::find($produto->id);

        $this->assertNull($deletedProduto);
    }
}
