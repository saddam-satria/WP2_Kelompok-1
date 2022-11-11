<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ItemOnCart;
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
        $orderRepository = new OrderRepository();

        $columns= array("laundry_order.id","laundry_order.account_id","laundry_order.totalItem","laundry_order.paymentMethod","service.serviceName","service.servicePrice","package.packagePrice","package.packageName","laundry_order.status","laundry_order.description","laundry_order.amount","laundry_order.payment","laundry_order.isTrouble","laundry_order.isFinish");
        $orderModel = $orderRepository->getOrderByID($id, $columns);

        if (count($orderModel) < 1) {
            return redirect()->to("/user/orders");
        }

        $order = $orderModel[0];

        $session = session();

        $currentUser = $session->current_user[0];

        if ($currentUser->id != $order->account_id) {
            return redirect()->to(base_url("/user/orders"));
        }

        $db = \Config\Database::connect();
        $detailOrder = $db->table("detail_order");

        if ($order->payment < 1 && !$order->isFinish) {
            return redirect()->to(base_url("/user/payment?id=" . $order->id));
        }

        $items = $detailOrder->select()->where("order_id", $order->id)->join("item", "item.itemID=detail_order.item_id")->get()->getResultObject();

        return view("user/order/detail", compact("title", "id", "order", "items"));
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
    public function orderComplete()
    {
        $title = "Pembayaran";
        $order_id = $this->request->getVar("id");
        $orderRepository = new OrderRepository();


        $orderModel = $orderRepository->getOrderByID($order_id, array("token", "laundry_order.id"));

        if (count($orderModel) < 1) {
            return redirect()->to(base_url("/user/orders"));
        }
        $order = $orderModel[0];



        return view("user/order/complete", compact("title", "order"));
    }
}
