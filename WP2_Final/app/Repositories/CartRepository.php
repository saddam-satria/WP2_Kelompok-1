<?php

namespace App\Repositories;

use App\Models\Cart;


class CartRepository extends Cart
{
    private $cartTable;
    public function __construct()
    {
        $database = \Config\Database::connect();
        $this->cartTable =  $database->table("cart");
    }
    public function getCarts(array $columns = ["*"])
    {
        return $this->cartTable->select($columns)->get()->getResultObject();
    }
}
