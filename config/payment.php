<?php

return [
    'provider' => env('PAYMENT_PROVIDER', 'loop'),

    'services' => [
        'loop' => [
            'class' => App\Services\LoopPaymentService::class
        ],
        'custom' => [
            'class' => App\Services\CustomPaymentService::class
        ]
    ],
];