<?php

namespace src\OrderService\controllers\impl;

use src\OrderService\controllers\OrderController;


class OrderControllerImpl extends OrderController
{
    protected $orderDao;

    public function __construct(OrderDao $orderDao)
    {
        $this->orderDao = $orderDao;
    }

    public function create(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'contract_id' => 'required',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            $order = $this->orderDao->createOrder(
                $request->client_id,
                $request->contract_id,
                $request->products
            );

            return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
