<?php

namespace App\Repositories;

use App\Models\Voucher;

class VoucherRepository extends Voucher
{
    private $voucherTable;
    private $voucheronAccountTable;
    public function __construct()
    {
        $database = \Config\Database::connect();
        $this->voucherTable =  $database->table("voucher");
        $this->voucheronAccountTable = $database->table("voucher_on_account");
        $this->allowCallbacks();
    }
    public function getVoucherByID(string $voucherCode, array $columns = ["*"])
    {
        return $this->voucherTable->select($columns)->where("voucherCode", $voucherCode)->get()->getResultObject();
    }
    public function getVoucherOnAccount(string $account_id, array $columns = ["*"])
    {
        return $this->voucheronAccountTable->select($columns)->where("account_id", $account_id)->join("voucher", "voucher.voucherID = voucher_on_account.voucher_id")->get()->getResultObject();
    }
}
