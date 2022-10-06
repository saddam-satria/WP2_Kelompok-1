<?php

namespace App\Database\Seeds;

use App\Models\Package as ModelsPackage;
use CodeIgniter\Database\Seeder;

class Package extends Seeder
{
    public function run()
    {
        $data = array(
            "packageName" => "standart",
            "packagePrice" => 2000
        );
        $packageModel = new ModelsPackage();
        $packageModel->insert($data);
    }
}
