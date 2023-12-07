<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Application\Order\CommandHandler;

use App\Application\Order\Command\CreateOrderCommand;
use App\Application\Order\DTO\OrderDTO;
use App\Application\Order\Service\CreateOrderService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateOrderHandler
{
    public CreateOrderService $createOrderService;

    public function __construct(CreateOrderService $createOrderService)
    {
        $this->createOrderService = $createOrderService;
    }

    public function __invoke(CreateOrderCommand $command): OrderDTO
    {
        $order = $this->createOrderService->createOrder($command->getProducts()['products']);

        return new OrderDTO(
            $order->getId(),
            $order->getCreatedAt(),
            $order->getItems()
        );
    }
}