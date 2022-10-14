<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends Order
{
    private $query;
    public function __construct()
    {
        $db = \Config\Database::connect();
        $this->query = $db->table("order");
    }
    public function getOrder(string $columns = "*", ?int $limit = null, int $offset = 0)
    {
        $order = $this->query->select($columns);
        return $order->get($limit, $offset);
    }
    public function getOrderByUser(string $columns = "*", string $user_id)
    {
        $currentOrder = $this->query->select($columns);
        return $currentOrder->where("account_id", $user_id)->get()->getResult();
    }
    public function getOrderUserByStatus(string $columns = "*", string $user_id, bool $status = false, ?int $limit = null, int $offset = 0)
    {
        $currenHistory = $this->query->select($columns);
        return $currenHistory->where("account_id", $user_id)->where("orderStatus", $status)->get($limit, $offset)->getResult();
    }
    public function getTotalData(string $column = "", string $allias = "")
    {
        return $this->query->selectCount($column, $allias)->get()->getResultObject();
    }
}
