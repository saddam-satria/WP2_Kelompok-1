<?php

namespace App\Database\Seeds;

use App\Models\Account as ModelsAccount;
use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;

class Account extends Seeder
{
    public function run()
    {
        $data = array(
            "email" => "admin@gmail.com",
            "firstname" => "admin",
            "address" => "admin",
            "gender" => "LAKI-LAKI",
            "verificationCode" => "ADMIN!@#",
            "isAdmin" => true,
        );
        $account_model = new ModelsAccount();
        $account_model->insert($data);
    }
}
