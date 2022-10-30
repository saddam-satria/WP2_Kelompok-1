<?php

namespace App\Database\Seeds;

use App\Models\Cart as ModelsCart;
use CodeIgniter\Database\Seeder;

class Cart extends Seeder
{
    public function run()
    {
        $data = array(
            "account_id" => "a5c3b51b-c2b0-4f7a-a112-7de3a57d7557",
            "service_id" => 1,
            "package_id" => 1,
        );

        $cart = new ModelsCart();
        $cart->insert($data);
    }
}
