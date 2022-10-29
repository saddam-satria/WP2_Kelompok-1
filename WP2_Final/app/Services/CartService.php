<?php

namespace App\Services;

use App\Repositories\CartRepository;

class CartService
{

    private $cartRepository;
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function insertToCart(string $user_id, string $service, string $package, string $item, $quantity = 0, string $description)
    {
        $data = array(
            "account_id" => $user_id,
            "service" => $service,
            "package" => $package,
            "item" => $item,
            "quantity" => $quantity,
            "description" => $description
        );

        return $this->cartRepository->insert($data, false);
    }
}
