<?php

namespace App\Database\Seeds;

use App\Models\Voucher as ModelsVoucher;
use CodeIgniter\Database\Seeder;

class Voucher extends Seeder
{
    public function run()
    {
        $data = array(
            "discount" => 20,
            "isPercentage" => true,
            "expire" => "2022-12-09"
        );
        $voucherModel = new ModelsVoucher();
        $voucherModel->insert($data);
    }
}
