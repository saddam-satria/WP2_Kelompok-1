<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService
{
    private $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function orderUser(string $user_id, $columns = "*")
    {
        return $this->orderRepository->getOrderByUser($columns, $user_id);
    }
    public function historyOrderUser(string $user_id, $columns = "*", ?int $page = null)
    {
        $paginate = ($page - 1) * 10;
        return $this->orderRepository->getOrderUserByStatus($columns, $user_id, true, 10, $paginate);
    }
    public function getTotalData(string $column = "*", string $allias = "total_data")
    {
        return $this->orderRepository->getTotalData($column, $allias);
    }
    public function getNewestOrder()
    {
        return $this->orderRepository->getNewestOrder();
    }
}
