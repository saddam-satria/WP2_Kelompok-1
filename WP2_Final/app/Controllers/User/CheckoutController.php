<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Repositories\VoucherRepository;
use App\Services\PaymentService;

class CheckoutController extends BaseController
{
    public function index()
    {
        $title = "Checkout";
        $session = session();
        $currentCart = $session->cart;
        if (is_null($currentCart)) {
            return redirect()->to(base_url("/user/select-item"))->with("error", "keranjang masih kosong");
        };
        $currentUser = $session->current_user[0];
        $voucherRepository = new VoucherRepository();
        $vouchers = $voucherRepository->getVoucherOnAccount($currentUser->id, array("voucherCode", "discount", "isPercentage", "expire"));

        $amount = 0;
        $cartAsKG = 0;
        $cart = $currentCart[0];
        $service = $cart->servicePrice;
        $package = $cart->packagePrice;


        foreach ($currentCart as $cart) {
            $qty = (float) $cart->quantity / $cart->quantityPerKG;
            $cartAsKG = $cartAsKG + $qty;
            $amount = $amount + $qty * $cart->itemPrice;
        }

        $amount = $amount + $cart->servicePrice + $cart->packagePrice;
        $currentVoucher = $this->request->getVar("voucher");

        $voucherModel = null;
        $discount = 0;
        $isPercentage = false;

        if ($currentVoucher) {
            $voucherModel = $voucherRepository->getVoucherByID($currentVoucher, array("isPercentage", "discount", "voucherCode"));
            if (count($voucherModel) > 0) {
                $voucher = $voucherModel[0];
                $discount = $voucher->discount;
                $isPercentage = $voucher->isPercentage;
            }
        }

        if (!is_null($voucherModel) && $discount > 0 && $isPercentage) {
            $realDiscount = (float) $amount * ($discount / 100);
            $amount = (float) $amount - $realDiscount;
        }

        if (!is_null($voucherModel) && $discount > 0 && !$isPercentage) {
            $amount = (float) $amount - $discount;
        }


        return view("user/cart/checkout", compact("title", "vouchers", "amount", "service", "package", "cartAsKG", "currentUser", "currentVoucher", "voucherModel", "discount", "isPercentage"));
    }
    public function selectVoucher()
    {
        $voucher = $this->request->getVar("voucher");
        return redirect()->to(base_url("/user/checkout?voucher=" . $voucher));
    }
    public function payment()
    {
        $paymentSerivce = new PaymentService();
        $result = $paymentSerivce->payment($this->request->getVar("voucher"));

        if (!$result["status"]) {
            return redirect()->to(base_url("/user/orders"))->with("error", "gagal checkout");
        }

        return redirect()->to(base_url("/user/payment?id=" . $result["data"]));
    }
}
