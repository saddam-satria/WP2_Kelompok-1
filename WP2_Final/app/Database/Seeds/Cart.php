<?php

namespace App\Database\Seeds;

use App\Models\Cart as ModelsCart;
use CodeIgniter\Database\Seeder;

class Cart extends Seeder
{
    public function run()
    {
        $data = array(
            "account_id" => "3c499014-13e5-4f79-93a1-31889c75e14c",
            "service_id" => 1,
            "package_id" => 1,
        );

        $cart = new ModelsCart();
        $cart->insert($data);
    }
}
