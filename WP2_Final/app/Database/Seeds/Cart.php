<?php

namespace App\Database\Seeds;

use App\Models\Cart as ModelsCart;
use CodeIgniter\Database\Seeder;

class Cart extends Seeder
{
    public function run()
    {
        $data = array(
            "account_id" => "87244a73-ed24-45be-ab3b-d035125ced69",
            "service" => "nyuci",
            "package_id" => 1,
            "item_id" => 1,
            "quantity" => 10,
            "description" => "testing aja"
        );

        $cart = new ModelsCart();
        $cart->insert($data);
    }
}
