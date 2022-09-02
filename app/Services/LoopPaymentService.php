<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LoopPaymentService implements PaymentServiceInterface
{

    public function pay(array $payload)
    {
        $response = $this->loopPaymentAdapter($payload);
        
        return $response->json();
    }

    private function loopPaymentAdapter(array $payload)
    {
        return Http::post('https://superpay.view.agentur-loop.com/pay', $payload);
    }

}