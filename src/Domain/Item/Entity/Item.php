<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Domain\Item\Entity;

use App\Domain\Order\Entity\Order;
use App\Domain\Product\Entity\Product;
use App\Infrastructure\Item\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: "App\Domain\Product\Entity\Product")]
    private Product $product;

    #[ORM\Column(nullable: false)]
    private int $quantity;

    #[ORM\ManyToOne(targetEntity: "App\Domain\Order\Entity\Order", inversedBy: "items")]
    private Order $order;

    public function __construct(Product $product, int $quantity, Order $order)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->order = $order;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}