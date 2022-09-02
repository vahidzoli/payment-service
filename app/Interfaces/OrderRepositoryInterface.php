<?php

namespace App\Interfaces;

interface OrderRepositoryInterface 
{
    public function getAllOrders();
    public function getOrderById($orderId);
    public function deleteOrder($orderId);
    public function createOrder(array $orderDetails);
    public function updateOrder(array $newDetails, $order);
    public function addProduct(array $newDetails, $order);
    public function payOrder(array $payload, $order);
}