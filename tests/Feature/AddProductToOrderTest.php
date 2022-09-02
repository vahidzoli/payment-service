<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use Tests\TestCase;

class AddProductToOrderTest extends TestCase
{
    public function testSuccessfulPost()
    {
        $product = Product::factory()->create();
        $order = Order::factory()->create();

        $response = $this->postJson($this->postUrl($order->id), [
            'product_id' => $product->id,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'The product was attached to the order',
        ]);
    }

    /**
     * @dataProvider validationDataProvider
     */
    public function testValidation(array $invalidData, string $invalidParameter)
    {
        $order = Order::factory()->create();
        $product = Product::factory()->create();

        $validData = [
            'product_id' => $product->id,
        ];

        $data = array_merge($validData, $invalidData);

        $response = $this->postJson($this->postUrl($order->id), $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([$invalidParameter]);
    }

    public function validationDataProvider()
    {
        return [
            [['product_id' => null], 'product_id'],
            [['product_id' => ''], 'product_id'],
            [['product_id' => []], 'product_id'],
        ];
    }

    private function postUrl(int $orderId)
    {
        return sprintf('/api/orders/%d/add', $orderId);
    }
}
