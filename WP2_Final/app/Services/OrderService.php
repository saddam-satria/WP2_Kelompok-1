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
    public function historyOrderUser(string $user_id, $columns = "*")
    {
        return $this->orderRepository->getOrderUserByStatus($columns, $user_id, true);
    }
}
