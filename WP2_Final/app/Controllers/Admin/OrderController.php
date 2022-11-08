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
                    <form action="'. base_url("admin/order/" . $row->orderID) .'" method="POST">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </form>
                </div>

            ';
        })->add("status", function($row) {
            return '
            <div class="d-flex">
                <a href="'.base_url("admin/order/edit/" .$row->orderID).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
            </div>

        ';
        })->add("isFinish", function($row){
            return '
            <div class="d-flex">
                <a href="'.base_url("admin/order/edit/" .$row->orderID).'" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
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
    public function update(string $id)
    {
        $order = $this->orderRepository->getOrderByID($id, array("amount","totalItem"));
        $data = array(
            "payment" => $this->request->getVar("payment"),
            "paymentMethod" => $this->request->getVar("paymentMethod"),
            "description" => $this->request->getVar("description"),
        );

        if(count($order)< 1)
        {
            return redirect()->to(base_url("/admin/orders"))->with("error", "order tidak ditemukan");
        }

        $order = $order[0];



        if($order->amount > (float)$data["payment"])
        {
            return redirect()->to(base_url("/admin/order/edit/" . $id))->with("error", "nominal kurang");
        }


        

        $updatedOrder = $this->orderRepository->update($id, $data);

        if(!$updatedOrder){
            return redirect()->to(base_url("/admin/order/". $id))->with("error", "terjadi kesalahan");
        }

        return redirect()->to(base_url("/admin/order/edit/". $id))->with("success", "sukses mengubah data orderan");

    }
    public function destroy(string $id)
    {
        $result = $this->orderRepository->delete($id);

        if(!$result){
            return redirect()->to(base_url("/admin/orders"))->with("error", "terjadi kesalahan");
        }

        return redirect()->to(base_url("/admin/orders"))->with("success", "sukses menghapus data orderan");


    }
}
