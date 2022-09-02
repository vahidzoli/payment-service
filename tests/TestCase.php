<?php

namespace Tests;

use App\Models\Order;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function orderToResourceArray(Order $order)
    {
        return [
            'id' => $order->id,
            'customer' => $order->customer->name,
            'payed' => $order->payed,
            'created_at' => $order->created_at->format('l, d-M-Y')
        ];
    }
}
