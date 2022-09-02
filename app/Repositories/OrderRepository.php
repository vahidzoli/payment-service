<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Services\PaymentServiceInterface;

class OrderRepository implements OrderRepositoryInterface 
{
    private $payment;

    public function __construct(PaymentServiceInterface $paymentServiceInterface)
    {
        $this->payment = $paymentServiceInterface; 
    }

    public function getAllOrders() 
    {
        return Order::all();
    }

    public function getOrderById($orderId) 
    {
        return Order::findOrFail($orderId);
    }

    public function deleteOrder($orderId) 
    {
        Order::destroy($orderId);
    }

    public function createOrder(array $orderDetails) 
    {
        $orderDetails['payed'] = $orderDetails['payed'] ?? false;

        return Order::create($orderDetails);
    }

    public function updateOrder(array $newDetails, $order) 
    {
        $order->update($newDetails);

        return $order;
    }

    public function addProduct(array $newDetails, $order) 
    {
        if($order->payed == false){
            $order->products()->attach($newDetails['product_id']);

            return 'The product was attached to the order';
        }

        return 'The order has already payed';
    }

    public function payOrDer(array $payload, $order) 
    {
        if($order->payed == false){
            $response = $this->payment->pay($payload);

            if( !strcmp($response['message'] , "Payment Successful")) {
                $order->update([
                    'payed' => true
                ]);
            }

            return $response['message'];
        }
        
        return 'The order has already payed';
    }
}