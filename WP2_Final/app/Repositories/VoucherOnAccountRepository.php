<?php

namespace App\Repositories;

use App\Models\VoucherOnAccount;

class VoucherOnAccountRepository extends VoucherOnAccount
{
    public function insertVoucher(string $voucher_id, string $user_id)
    {
        $data = array(
            "voucher_id" => $voucher_id,
            "account_id" => $user_id
        );
        return $this->insert($data, false);
    }
}
