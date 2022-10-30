<?php

namespace App\Database\Seeds;

use App\Models\ItemOnCart as ModelsItemOnCart;
use CodeIgniter\Database\Seeder;

class ItemOnCart extends Seeder
{
    public function run()
    {
        $data = array(
            "cart_id" => "6b89dfd4-1f32-48b4-84b4-ab8a87a4010d",
            "item_id" => 1,
            "quantity" => 1,
            "description" => "test"
        );
        $itemOnCartModel = new ModelsItemOnCart();
        $itemOnCartModel->insert($data);
    }
}
