<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends Order
{
    private $query;
    private  $statusOrder = array('DITERIMA', 'SEDANG DICUCI', 'SUDAH SELESAI', 'SUDAH DI AMBIL');
    public function __construct()
    {
        $db = \Config\Database::connect();
        $this->query = $db->table("laundry_order");
        $this->allowCallbacks(true);
    }
    public function getOrder(string $columns = "*", ?int $limit = null, int $offset = 0)
    {
        $order = $this->query->select($columns);
        return $order->get($limit, $offset)->getResult();
    }
    public function getNewestOrder(string $columns = "*", ?int $limit = null, int $offset = 0)
    {
        $order = $this->query->select($columns);
        return $order->orderBy("created_at")->get($limit, $offset)->getFirstRow();
    }
    public function getOrderByUser(string $user_id, array $columns = ["*"])
    {
        $currentOrder = $this->query->select($columns);
        return $currentOrder->where("isFinish", false)->where("account_id", $user_id)->join("service", "service.serviceID = laundry_order.service_id")->join("package", "package.packageID = laundry_order.package_id")->get()->getResult();
    }
    public function getOrderUserByStatus(string $columns = "*", string $user_id, bool $status = false, ?int $limit = null, int $offset = 0)
    {
        $currenHistory = $this->query->select($columns);
        return $currenHistory->where("account_id", $user_id)->where("isFinish", $status)->get($limit, $offset)->getResultObject();
    }
    public function getTotalData(string $column = "", string $allias = "")
    {
        return $this->query->selectCount($column, $allias)->get()->getResultObject();
    }
    public function getStatusOrder(): array
    {
        return $this->statusOrder;
    }
    public function getOrderByCode(string $orderCode, array $columns = ["*"])
    {
        return $this->query->select($columns)->where("token", $orderCode)->get()->getResultObject();
    }
    public function getOrderByID(string $order_id, array $columns = ["*"])
    {
        return $this->query->select($columns)->where("id", $order_id)->join("service", "laundry_order.service_id = service.serviceID")->join("package", "laundry_order.package_id = package.packageID")->get()->getResultObject();
    }
    public function getOrdersAjax($columns = ["*"])
    {
        return $this->query->select($columns)->join("account", "account.id = laundry_order.account_id")->orderBy("laundry_order.created_at", "DESC");
    }
    public function getOrders(array $columns = ["*"])
    {
        return $this->query->select($columns)->get()->getResultObject();
    }
    public function getOrderByFinish(bool $isFinish=false,array $columns=["*"] )
    {
        return $this->query->select($columns)->where("isFinish", $isFinish)->get()->getResultObject();
    }
    public function getNewestOrderLimit(array $columns=["*"], bool $status=false,?int $limit = 0, ?int $offset =0){
        return $this->query->select($columns)->where("isFinish", $status)->orderBy("created_at","DESC")->get($limit,$offset)->getResultObject();
    }
}
