<?php

namespace App\Database\Seeds;

use App\Models\Role as ModelsRole;
use CodeIgniter\Database\Seeder;

class Role extends Seeder
{
    public function run()
    {
        $data = array(
            "roleId" => 1,
            "name" => "admin"
        );

        $roleModel = new ModelsRole();

        $roleModel->insert($data);
    }
}
