<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Repositories\OrderRepository;
use App\Repositories\ServiceRepository;
use App\Services\OrderService;

class DashboardController extends BaseController
{
    private $orderService;
    public function __construct()
    {
        // dd(session()->current_user[0]);
        $this->orderService = new OrderService(new OrderRepository());
    }

    public function index()
    {
        $serviceRepository = new ServiceRepository();
        $services = $serviceRepository->getServices();
        $currentOrder = $this->orderService->getNewestOrder();
        return view("user/dashboard", compact("services", "currentOrder"));
    }
}
