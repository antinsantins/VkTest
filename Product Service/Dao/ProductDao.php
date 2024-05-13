<?php

namespace src\Product\Service\Dao;

class ProductDao
{
    public function addProduct($name, $price, $otherAttributes = [])
    {
        $product = new Product();
        $product->name = $name;
        $product->price = $price;

        foreach ($otherAttributes as $key => $value) {
            $product->{$key} = $value;
        }

        $product->save();

        return $product;
    }
}
