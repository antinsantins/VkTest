<?php

namespace src\OrderService\Dao;


use src\Dao\Order;
use src\Dao\Product;

class OrderDao
{
    public function createOrder($clientId, $contractId, $products)
    {
        $order = new Order();
        $order->client_id = $clientId;
        $order->contract_id = $contractId;
        $order->status = 'new';
        $order->save();

        foreach ($products as $productData) {
            $product = Product::findOrFail($productData['id']);

            if ($product->quantity < $productData['quantity']) {
                throw new \Exception('Not enough quantity in stock for product ' . $product->name);
            }

            $order->products()->attach($product->id, ['quantity' => $productData['quantity']]);
            $product->decrement('quantity', $productData['quantity']);
        }

        return $order;
    }
}
