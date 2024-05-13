<?php

namespace src\OrderService\Entity;

use src\Entity\Client;
use src\Entity\Contract;
use src\Entity\Product;

class Order
{
    protected $fillable = ['client_id', 'contract_id', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}