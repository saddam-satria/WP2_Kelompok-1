<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PackageRepository;
use App\Repositories\ServiceRepository;
use App\Services\OrderService;

class OrderController extends BaseController
{
    private $orderService;
    private $packageRepository;
    public function __construct()
    {
        $this->orderService =  new OrderService(new OrderRepository());
        $this->itemRepository = new ItemRepository();
        $this->packageRepository = new PackageRepository();
    }
    public function index()
    {
        $title = "Cucian Anda";
        $orderRepository = new OrderRepository();
        $orders = $orderRepository->getOrderByUser(session()->current_user[0]->id);
        return view("user/order/index", compact("title", "orders"));
    }

    public function create()
    {
        $session = session();
        $currentCart = $session->cart_id;

        if (!is_null($currentCart)) {
            return redirect()->to(base_url("/user/select-item"));
        }

        $title = "Tambah Cucian Baru";
        $default_service = $this->request->getVar("service");
        $serviceRepository = new ServiceRepository();
        $services = $serviceRepository->getServices(array("serviceName"));
        $packages = $this->packageRepository->getPackages(array("packageName"));
        return view("user/order/insert", compact("title", "default_service", "services", "packages"));
    }


    public function detail(string $id)
    {
        $title = "detail cucian";
        return view("user/order/detail", compact("title", "id"));
    }

    public function histories()
    {
        $title = "Riwayat Cucian Anda";
        if (is_null($this->request->getVar("page")) || $this->request->getVar("page") == 0) {
            return redirect()->to(base_url("user/histories?page=1"));
        }

        $currentPage = $this->request->getVar("page");
        $histories = $this->orderService->historyOrderUser(session()->current_user[0]->id, "*", $currentPage);
        $data = $this->orderService->getTotalData()[0];
        $totalData = $data->total_data > 9 ? (int)$data->total_data / 10 : 1;
        return view("user/order/history", compact("title", "histories", "totalData", "currentPage"));
    }
}
