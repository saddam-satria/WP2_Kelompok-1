<?php

namespace App\Services;

use App\Repositories\VoucherOnAccountRepository;
use App\Repositories\VoucherRepository;

class VoucherService
{
    private $voucherRepository;
    private $voucherOnAccountRepository;
    public function __construct(VoucherRepository $voucherRepository, VoucherOnAccountRepository $voucherOnAccountRepository)
    {
        $this->voucherRepository = $voucherRepository;
        $this->voucherOnAccountRepository = $voucherOnAccountRepository;
    }

    public function claimVoucher(string $voucherCode)
    {
        $voucherModel = $this->voucherRepository->getVoucherByID($voucherCode, array("voucherID", "expire"));

        if (count($voucherModel) < 1) {
            return false;
        }


        $voucher = $voucherModel[0];


        $isExpire = date("Y-m-d") > $voucher->expire;


        if ($isExpire) {
            return false;
        }



        $voucherID = $voucher->voucherID;
        $session = session();
        $currentUser = $session->current_user[0];


        $account_id = $currentUser->id;

        return $this->voucherOnAccountRepository->insertVoucher($voucherID, $account_id);
    }
}
