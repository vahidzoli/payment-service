<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Order;
use Tests\TestCase;

class PayOrderTest extends TestCase
{
    public function testSuccessfulPost()
    {
        $customer = Customer::factory()->create();
        $order = Order::factory()->create();

        $response = $this->postJson($this->postUrl($order->id), [
            'order_id' => $order->id,
            'customer_email' => $customer->email,
            'value' => 33.4
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Payment Successful' || 'Insufficient Funds',
        ]);
    }

    private function postUrl(int $orderId)
    {
        return sprintf('/api/orders/%d/pay', $orderId);
    }
}
