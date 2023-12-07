<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Application\Order\Controller;

use App\Application\Order\Command\CreateOrderCommand;
use App\Application\Order\Query\GetOrderQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class OrderController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function createOrder(Request $request): JsonResponse
    {
        $products = json_decode($request->getContent(), true);

        if ($products === null) {
            return new JsonResponse(['error' => 'Products required'], 400);
        }

        try {
            $command = new CreateOrderCommand($products);

            $envelope = $this->messageBus->dispatch($command);
            $handledStamp = $envelope->last(HandledStamp::class);

            return new JsonResponse(['message' => $handledStamp->getResult()->jsonSerialize()], 200);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function getOrder(Request $request, int $id): JsonResponse
    {
        try {
            $query = new GetOrderQuery($id);

            $envelope = $this->messageBus->dispatch($query);
            $handledStamp = $envelope->last(HandledStamp::class);

            return new JsonResponse(['message' => $handledStamp->getResult()->jsonSerialize()], 200);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}