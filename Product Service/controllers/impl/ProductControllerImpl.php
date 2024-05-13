<?php

namespace src\Product\Service\controllers\impl;


use src\Product\Controllers\ProductController;

class ProductControllerImpl extends ProductController
{
    protected $productDao;

    public function __construct(ProductDao $productDao)
    {
        $this->productDao = $productDao;
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            $product = $this->productDao->addProduct(
                $request->name,
                $request->price,
            );

            return response()->json(['message' => 'Product added successfully', 'product_id' => $product->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
