<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AddProductRequest;
use App\Http\Requests\API\OrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository) 
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(): JsonResponse 
    {
        return response()->json(
            new OrderCollection($this->orderRepository->getAllOrders()),
            Response::HTTP_OK
        );
    }

    public function store(OrderRequest $request): JsonResponse 
    {
        return response()->json(
            [
                'data' => new OrderResource($this->orderRepository->createOrder($request->all())) 
            ],
            Response::HTTP_CREATED
        );
    }

    public function show(Order $order): JsonResponse 
    {
        return response()->json(
            [
                'data' => new OrderResource($this->orderRepository->getOrderById($order->id))
            ],
            Response::HTTP_OK
        );
    }

    public function update(OrderRequest $request, Order $order): JsonResponse 
    {
        return response()->json(
            [
                'data' => new OrderResource($this->orderRepository->updateOrder($request->all(), $order)) 
            ],
            Response::HTTP_OK
        );
    }

    public function destroy(Order $order): JsonResponse 
    {
        $this->orderRepository->deleteOrder($order->id);

        return response()->json(['data' => 'The order was deleted.'], Response::HTTP_OK);
    }

    public function addProductToOrder(AddProductRequest $request, Order $order): JsonResponse
    {
        $message = $this->orderRepository->addProduct($request->all(), $order);

        return response()->json(['message' => $message], Response::HTTP_OK);
    }

    public function payOrder(Request $request, Order $order): JsonResponse
    {        
        $payload = $request->only([
            'order_id', 'customer_email', 'value'
        ]);

        try {
            $message = $this->orderRepository->payOrder($payload, $order);

            return response()->json(['message' => $message], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'message' => $th->getMessage(),
                ],
                Response::HTTP_NOT_IMPLEMENTED
            );
        }
    }
}