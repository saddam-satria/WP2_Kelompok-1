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
        $this->orderService = new OrderService(new OrderRepository());
    }

    public function index()
    {
        $serviceRepository = new ServiceRepository();
        $services = $serviceRepository->getServices();
        $order = $this->orderService->getNewestOrder();
        return view("user/dashboard", compact("services", "order"));
    }
}
