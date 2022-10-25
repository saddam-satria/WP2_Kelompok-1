<?php

namespace App\Database\Seeds;

use App\Models\User as ModelsUser;
use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = array(
            "email" => "admin@gmail.com",
            "name" => "admin",
            "role_id" => 1,
            "password" => "admin"
        );

        $userModel = new ModelsUser();
        $userModel->insert($data);
    }
}
