<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Application\Order\Service;

use App\Domain\Item\Factory\ItemFactoryInterface;
use App\Domain\Order\Entity\Order;
use App\Domain\Order\Factory\OrderFactoryInterface;
use App\Domain\Product\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class CreateOrderService implements CreateOrderServiceInterface
{
    private OrderFactoryInterface $orderFactory;

    private ProductRepositoryInterface $productRepository;

    private ItemFactoryInterface $itemFactory;

    private EntityManagerInterface $entityManager;

    public function __construct(
        OrderFactoryInterface $orderFactory,
        ProductRepositoryInterface $productRepository,
        ItemFactoryInterface $itemFactory,
        EntityManagerInterface $entityManager
    ) {
        $this->orderFactory = $orderFactory;
        $this->productRepository = $productRepository;
        $this->itemFactory = $itemFactory;
        $this->entityManager = $entityManager;
    }

    public function createOrder(array $products): Order
    {
        $order = $this->orderFactory->createNew(new \DateTimeImmutable('now'));

        foreach ($products as $row) {
            $product = $this->productRepository->getById($row['product_id']);
            if ($product) {
                $item = $this->itemFactory->createNew(
                    $product,
                    $row['quantity'],
                    $order
                );
                $this->entityManager->persist($item);
            }
            $order->addItem($item);
        }
        $this->entityManager->persist($order);
        $this->entityManager->flush();

        return $order;
    }
}