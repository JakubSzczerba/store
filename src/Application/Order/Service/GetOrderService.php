<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Application\Order\Service;

use App\Domain\Order\Entity\Order;
use App\Domain\Order\OrderRepositoryInterface;

class GetOrderService
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getOrder(int $orderId): Order
    {
        return $this->orderRepository->getById($orderId);
    }
}