<?php

namespace Tests\Unit;

use App\Models\Customer;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function testCreateOrder()
    {
        $customer = Customer::factory()->create();
        $data  = [
            'customer_id' => $customer->id,
        ];
            
        $response = $this->postJson('/api/orders', $data);
        $response->assertStatus(201);
        $response->assertJsonStructure(
            [
                'data' => [
                    'id',
                    'customer',
                    'payed',
                    'created_at'
                ]
            ]
        );
    }

    public function testGetAllOrders()
    {
        $response = $this->getJson('/api/orders');
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' => [
                    '*' => [
                        'id',
                        'customer',
                        'payed',
                        'created_at'
                    ]    
                ]
            ]
        );
    }

    public function testUpdateOrder()
    {
        $customer = Customer::factory()->create();
        $data  = [
            'customer_id' => $customer->id,
        ];
            
        $response = $this->postJson('/api/orders', $data);
        $response->assertStatus(201);

        $orderId = $response['data']['id'];

        $update = $this->putJson('/api/orders/'.$orderId,
        [
            'customer_id' => $customer->id,
            'payed' => 1
        ]
        );
        $update->assertStatus(200);
    }

    public function testDeleteOrder()
    {
        $customer = Customer::factory()->create();
        $data  = [
            'customer_id' => $customer->id,
        ];
            
        $response = $this->postJson('/api/orders', $data);
        $response->assertStatus(201);

        $orderId = $response['data']['id'];

        $update = $this->json('DELETE', '/api/orders/'.$orderId);
        $update->assertStatus(200);
    }
}
