<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Repositories\OrderRepository;
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
        $services = array(
            array(
                "name" => "nyuci",
                "image" => "assets/img/nyuci.png"
            ),
            array(
                "name" => "gosok",
                "image" => "assets/img/gosok.png"
            ),
            array(
                "name" => "all in one",
                "image" => "assets/img/allinone.png"
            ),
            array(
                "name" => "sneakers",
                "image" => "assets/img/sneakers.png"
            ),
        );
        $currentOrder = $this->orderService->getNewestOrder();
        return view("user/dashboard", compact("services", "currentOrder"));
    }
}
