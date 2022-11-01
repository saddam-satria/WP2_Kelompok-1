<?php

namespace App\Database\Seeds;

use App\Models\Service as ModelsService;
use CodeIgniter\Database\Seeder;

class Service extends Seeder
{
    public function run()
    {
        $data = array(
            "serviceName" => "nyuCI",
            "servicePrice" => 1000
        );

        $serviceModel = new ModelsService();
        $serviceModel->insert($data);
    }
}
