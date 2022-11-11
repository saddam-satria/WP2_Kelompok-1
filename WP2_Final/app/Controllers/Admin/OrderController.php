<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DetailOrder;
use App\Repositories\ItemRepository;
use App\Repositories\NotificationRepository;
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
            "paymentMethod",  "token", "amount", "email", "laundry_order.id AS orderID","status"
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
        })->toJson(true);
    }
    public function edit(string $id)
    {
        $title = "Admin Edit Order";

        $orderStatus = $this->orderRepository->getStatusOrder();
      

        $order = $this->orderRepository->getOrderByID($id, array("token","paymentMethod","status","totalItem","amount","payment","laundry_order.id", "description","isTrouble"));

        if(count($order) < 1)
        {
            return redirect()->to(base_url("admin/orders"));
        }
        $order = $order[0];
        $statusOrders = [];

        foreach ($orderStatus as $status) {
            if($status != $order->status){
                $statusOrders[] = $status;
            }
        }

        

        return view("admin/order/update", compact("title", "order","statusOrders"));
    }
    public function detail(string $id)
    {
        $title = "Admin Detail Order";
        $order = $this->orderRepository->getOrderByID($id, array("isFinish","isTrouble","token","paymentMethod","status","totalItem","amount","payment","laundry_order.id", "description"));

        if(count($order) < 1)
        {
            return redirect()->to(base_url("admin/orders"));
        }
        $order = $order[0];
        $detailOrderModel = new DetailOrder();
        $items = $detailOrderModel->select()->where("order_id", $order->id)->join("item", "item.itemID=detail_order.item_id")->get()->getResultObject();

        return view("admin/order/detail", compact("title", "order","items"));
    }
    public function update(string $id)
    {
        $order = $this->orderRepository->getOrderByID($id, array("amount","totalItem","account.email"));
        $data = array(
            "payment" => $this->request->getVar("payment"),
            "paymentMethod" => $this->request->getVar("paymentMethod"),
            "description" => $this->request->getVar("description"),
            "status" => $this->request->getVar("status"),
            "isTrouble" => $this->request->getVar("isTrouble") == "on" 
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

        if(str_contains(strtolower($data['status']),"sudah di ambil"))
        {
            $notifRepository = new NotificationRepository();
            $payloadNotification = array(
                "to" => $order->email,
                "from" => "admin sistem",
                "message" => "Pesanan Anda Sudah Selesai, Terima Kasih Sudah Menggunakan Layanan Kami"
            );

            $notifRepository->insert($payloadNotification);
    
            $data['isFinish'] = true; 
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
