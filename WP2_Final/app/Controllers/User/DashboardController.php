<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Repositories\AccountRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ServiceRepository;
use App\Services\OrderService;

class DashboardController extends BaseController
{
    private $orderService;
    public function __construct()
    {
        $this->orderService = new OrderService(new OrderRepository());
    }

    public function index()
    {
        $serviceRepository = new ServiceRepository();
        $services = $serviceRepository->getServices();
        $order = null;

        $session = session();
        $currentUser = $session->current_user[0];
        $isAdmin = $currentUser->isAdmin;

        if(!$isAdmin)
        {
            $order = $this->orderService->getNewestOrder();
        }


        $totalAmount = 0;
        $totalKg = 0;
        $orders = null;
        $totalOrder = 0;
        $totalFinishOrder =0;
        $totalAccount = 0;
        $accounts = null;

        if($isAdmin){
            $orderRepository = new OrderRepository();
            $orders = $orderRepository->getOrders();
            $accountRepository = new AccountRepository();
            $accounts = $accountRepository->getAccounts(array("email","firstname","lastname", "address"), 5);
            $totalAccount = $accountRepository->getCountUser()[0];

            foreach($orders as $order)
            {
                $totalAmount = $totalAmount + $order->amount;
                $totalKg = $totalKg + $order->totalItem;
                $totalOrder++;

                if($order->isFinish)
                {
                    $totalFinishOrder++;
                }
            }

        }

        $orderByPercent = ($totalFinishOrder / $totalOrder) * 100;
        $newestOrders = $orderRepository->getNewestOrderLimit(array("*"),false,5);
        
        return view("user/dashboard", compact("services", "order", "totalAmount","totalKg","totalOrder","orderByPercent", "totalAccount", "accounts","newestOrders"));
    }
}
