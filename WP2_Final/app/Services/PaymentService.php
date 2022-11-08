<?php

namespace App\Services;

use App\Models\DetailOrder;
use App\Models\Notification;
use App\Models\Order;
use App\Repositories\AccountRepository;
use App\Repositories\CartRepository;
use App\Repositories\PackageRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\VoucherRepository;

class PaymentService
{
    public function payment(?string $currentVoucher)
    {
        $session = session();
        $currentCart = $session->cart;
        if (is_null($currentCart)) {
            return [
                "status" => false,
                "data" => null
            ];
        };
        $currentUser = $session->current_user[0];

        $quantity = 0;
        $amount = 0;
        foreach ($currentCart as $cart) {
            $quantity = $quantity + ($cart->quantity / $cart->quantityPerKG);
            $qty = $cart->quantity / $cart->quantityPerKG;
            $amount = $amount + $qty * $cart->itemPrice;
        }

        $cart = $currentCart[0];
        $cart_id = $session->cart_id;
        $amount = $amount + $cart->servicePrice + $cart->packagePrice;

        $serviceRepository = new ServiceRepository();
        $packageRepository = new PackageRepository();

        $service = $serviceRepository->getServiceByName($cart->serviceName, array("serviceID"));
        $service_id = $service[0]->serviceID;
        $package = $packageRepository->getPackageByName($cart->packageName, array("packageID"));
        $package_id = $package[0]->packageID;

        $voucherRepository = new VoucherRepository();
        $voucherUsed = null;
        $discount = 0;

        if ($currentVoucher) {
            $voucherModel = $voucherRepository->getVoucherByID($currentVoucher, array("isPercentage", "discount", "voucherCode"));
            if (count($voucherModel) > 0) {
                $voucher = $voucherModel[0];
                $voucherUsed = $voucher->voucherCode;
                if ($voucher->isPercentage) {
                    $discount = $discount + (float) $amount * ($voucher->discount / 100);
                } else {
                    $discount = $discount + $amount - $voucher->discount;
                }
            }
        }



        $data = array(
            "amount" => $amount,
            "totalItem" => $quantity,
            "service_id" => $service_id,
            "package_id" => $package_id,
            "account_id" => $currentUser->id,
            "status" => 'DITERIMA',
            "payment" => 0,
            "discount" => $discount,
            "voucherCode" => $voucherUsed
        );
        $orderModel = new Order();
        $order_id = $orderModel->insert($data);


        if (!$order_id) {
            return [
                "status" => false,
                "data" => null
            ];
        }

        $detailOrderModel = new DetailOrder();

        foreach ($currentCart as $cart) {
            $payload = array(
                "order_id" => $order_id,
                "quantity" => $cart->quantity,
                "description" => $cart->description,
                "item_id" => $cart->item_id
            );

            $detailOrderModel->insert($payload);
        };

        $session->remove("cart");
        $session->remove("cart_id");

        $cartRepository = new CartRepository();

        $cartRepository->delete($cart_id);

        $notificationModel = new Notification();

        $payloadNotification = array(
            "to" => $currentUser->email,
            "from" => "admin sistem",
            "message" => "orderan dengan id" . $order_id . " " . "berhasil, silahkan melanjutkan ke pembayaran"
        );

        $userRepository = new AccountRepository();

        $adminUsers = $userRepository->getAdminUser(array("email"));

        
        $notificationModel->insert($payloadNotification);
        if(count($adminUsers) > 0)
        {
            foreach($adminUsers as $admin){
                $payloadAdminNotification = array(
                    "to" => $admin->email,
                    "from" => "Sistem",
                    "message" => "orderan baru dari" . " " . $currentUser->email . " " . "dengan order id" . " " . $order_id
                );
                $notificationModel->insert($payloadAdminNotification);
            }

        }
        



        return [
            "status" => true,
            "data" => $order_id
        ];
    }
}
