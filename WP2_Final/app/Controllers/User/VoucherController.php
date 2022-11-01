<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Repositories\VoucherOnAccountRepository;
use App\Repositories\VoucherRepository;
use App\Services\VoucherService;

class VoucherController extends BaseController
{
    private $voucherService;
    public function __construct()
    {
        $this->voucherService = new VoucherService(new VoucherRepository(), new VoucherOnAccountRepository());
    }
    public function claimingVoucher()
    {
        $voucherCode = $this->request->getVar("voucher");

        $result = $this->voucherService->claimVoucher($voucherCode);

        if (!$result) {
            return redirect()->to(base_url("/user/dashboard"))->with("error", "voucher tidak dapat di klaim");
        }

        return redirect()->to(base_url("/user/dashboard"))->with("success", "voucher berhasil ditambahkan, pakai sekarang");
    }
}
