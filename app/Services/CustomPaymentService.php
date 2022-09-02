<?php

namespace App\Services;

class CustomPaymentService implements PaymentServiceInterface
{

    public function pay(array $payload)
    {
        $messages = ['Payment Successful', 'Insufficient Funds'];

        $random = array_rand($messages);
        
        $response['message'] = $messages[$random];

        return $response;
    }

}