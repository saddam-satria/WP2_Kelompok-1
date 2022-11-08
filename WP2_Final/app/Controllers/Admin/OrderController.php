<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Repositories\OrderRepository;
use \Hermawan\DataTables\DataTable;

class OrderController extends BaseController
{
    private $orderRepository;
    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function index()
    {
        $title = "Admin Orderan";
        return view("admin/order/index", compact("title"));
    }
    public function orderAjax()
    {
        $columns = array(
            "paymentMethod",  "token", "amount", "email", "laundry_order.id AS orderID"
        );
        return DataTable::of($this->orderRepository->getOrdersAjax($columns))->format("amount", function ($amount) {
            return number_format($amount, 0, ".", ".");
        })->format("paymentMethod", function ($data) {
            return is_null($data) ? "-" : $data;
        })->add('action', function ($row) {
            return '
                
                <div class="d-flex">
                    <a href="'.base_url("admin/order/edit/" .$row->orderID).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="'.base_url("admin/order/" .$row->orderID).'" class="btn btn-secondary btn-sm mx-2"><i class="fas fa-eye"></i></a>
                    <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                </div>

            ';
        })->toJson(true);
    }
    public function edit(string $id)
    {
        $title = "Admin Edit Order";
        $order = $this->orderRepository->getOrderByID($id, array("token","paymentMethod","status","totalItem","amount","payment","id", "description"));

        if(count($order) < 1)
        {
            return redirect()->to(base_url("admin/orders"));
        }
        $order = $order[0];

        return view("admin/order/update", compact("title", "order"));
    }
    public function detail(string $id)
    {
        $title = "Admin Detail Order";
        $order = $this->orderRepository->getOrderByID($id, array("isFinish","isTrouble","token","paymentMethod","status","totalItem","amount","payment","id", "description"));

        if(count($order) < 1)
        {
            return redirect()->to(base_url("admin/orders"));
        }
        $order = $order[0];

        return view("admin/order/detail", compact("title", "order"));
    }
}
