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
    public function getCartsByUser(string $user_id, array $columns = ["*"])
    {
        return $this->cartTable->select($columns)->where("account_id", $user_id)->get()->getResultObject();
    }
    public function getCartByID(string $cart_id, $columns = ["*"])
    {
        return $this->cartTable->select($columns)->where("cartId", $cart_id)->get()->getResultObject();
    }
    public function getDetailCart(string $cart_id, $columns = ["*"])
    {
        return $this->cartTable->select($columns)->join("service", "service.serviceID = cart.service_id")->join("package", "package.packageID = cart.package_id")->where("cartId", $cart_id)->get()->getResultObject();
    }
}
