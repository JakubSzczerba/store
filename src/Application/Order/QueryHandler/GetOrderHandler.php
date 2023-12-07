<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Application\Order\QueryHandler;

use App\Application\Order\DTO\OrderDTO;
use App\Application\Order\Query\GetOrderQuery;
use App\Application\Order\Service\GetOrderService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetOrderHandler
{
    public GetOrderService $getOrderService;

    public function __construct(GetOrderService $getOrderService)
    {
        $this->getOrderService = $getOrderService;
    }

    public function __invoke(GetOrderQuery $query): OrderDTO
    {
        $order = $this->getOrderService->getOrder($query->getOrderId());

        return new OrderDTO(
            $order->getId(),
            $order->getCreatedAt(),
            $order->getItems()
        );
    }
}