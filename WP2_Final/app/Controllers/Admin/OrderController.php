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
            "paymentMethod",  "token", "amount", "email"
        );
        return DataTable::of($this->orderRepository->getOrdersAjax($columns))->format("amount", function ($amount) {
            return number_format($amount, 0, ".", ".");
        })->format("paymentMethod", function ($data) {
            return is_null($data) ? "-" : $data;
        })->add('action', function ($row) {
            return '

                <div class="d-flex">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-secondary btn-sm mx-2"><i class="fas fa-eye"></i></button>
                    <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                </div>

            ';
        })->toJson(true);
    }
}
