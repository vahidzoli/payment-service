<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class OrderCreateTest extends TestCase
{

    public function testSuccessfulPost()
    {
        $customer = Customer::factory()->create();

        $response = $this->postJson('/api/orders', [
            'customer_id' => $customer->id,
        ]);

        $response->assertStatus(201);
        $id = $response->json('data.id');
        $order = Order::find($id);

        $this->assertResponseContainsOrder($response, $order);
        $this->assertEquals($customer->id, $order->customer_id);
    }

    /**
     * @dataProvider validationDataProvider
     */
    public function testValidation(array $invalidData, string $invalidParameter)
    {
        $customer = Customer::factory()->create();

        $validData = [
            'customer_id' => $customer->id,
        ];

        $data = array_merge($validData, $invalidData);

        $response = $this->postJson('/api/orders', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors([$invalidParameter]);
    }

    public function validationDataProvider()
    {
        return [
            [['customer_id' => null], 'customer_id'],
            [['customer_id' => []], 'customer_id'],
            [['customer_id' => ''], 'customer_id']
        ];
    }

    private function assertResponseContainsOrder(TestResponse $response, Order $order): void
    {
        $response->assertJson([
            'data' => $this->orderToResourceArray($order),
        ]);
    }
}
