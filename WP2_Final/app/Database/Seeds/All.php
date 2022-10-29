<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class All extends Seeder
{
    public function run()
    {
        // $this->call("Account");
        $this->call("Service");
        $this->call("Item");
        $this->call("Package");
        $this->call("Voucher");
        // $this->call("Cart");
    }
}
