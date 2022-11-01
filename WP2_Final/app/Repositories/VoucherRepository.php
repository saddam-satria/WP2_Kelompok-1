<?php

namespace App\Repositories;

use App\Models\Voucher;

class VoucherRepository extends Voucher
{
    private $voucherTable;
    public function __construct()
    {
        $database = \Config\Database::connect();
        $this->voucherTable =  $database->table("voucher");
    }
    public function getVoucherByID(string $voucherCode, array $columns = ["*"])
    {
        return $this->voucherTable->select($columns)->where("voucherCode", $voucherCode)->get()->getResultObject();
    }
}
