<?php

namespace App\Services;

interface PaymentServiceInterface
{
    public function pay(array $payload);
}