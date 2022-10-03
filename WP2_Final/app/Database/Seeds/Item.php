<?php

namespace App\Database\Seeds;

use App\Models\Item as ModelsItem;
use CodeIgniter\Database\Seeder;

class Item extends Seeder
{
    public function run()
    {
        $data = array(
            "itemName" => "T-shirt",
            "itemPrice" => 3000,
            "quantityPerKG" => 4,
        );

        $itemModel = new ModelsItem();
        $itemModel->insert($data);
    }
}
