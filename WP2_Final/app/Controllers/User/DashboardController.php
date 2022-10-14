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
        return view("user/dashboard", compact("services"));
    }
    public function orders()
    {
        $title = "Cucian Anda";
        $orders = $this->orderService->orderUser(session()->current_user[0]["id"]);
        return view("user/order/index", compact("title", "orders"));
    }
    public function histories()
    {
        $title = "Riwayat Cucian Anda";
        if (is_null($this->request->getVar("page")) || $this->request->getVar("page") == 0) {
            return redirect()->to(base_url("user/histories?page=1"));
        }

        $currentPage = $this->request->getVar("page");
        $histories = $this->orderService->historyOrderUser(session()->current_user[0]["id"], "*", $currentPage);
        $data = $this->orderService->getTotalData()[0];
        $totalData = $data->total_data > 9 ? (int)$data->total_data / 10 : 1;
        return view("user/order/history", compact("title", "histories", "totalData", "currentPage"));
    }
    public function add()
    {
        $title = "Tambah Cucian Baru";
        $default_service = $this->request->getVar("service");
        $services = array("nyuci", "gosok", "all in one", "sneakers");
        $packages = array("premium", "standart", "super");
        return view("user/order/insert", compact("title", "default_service", "services", "packages"));
    }
}
