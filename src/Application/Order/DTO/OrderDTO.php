<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Application\Order\DTO;

use Doctrine\Common\Collections\Collection;

class OrderDTO
{
    private int $id;

    private \DateTimeImmutable $date;

    private Collection $items;

    public function __construct(int $id, \DateTimeImmutable $date, Collection $items)
    {
        $this->id = $id;
        $this->date = $date;
        $this->items = $items;
    }

    public function getDate(): string
    {
        return $this->date->format('d-m-Y-H-i-s');
    }

    public function getItems(): array
    {
        $items = [];
        foreach ($this->items as $item) {
            $data['id'] = $item->getProduct()->getId();
            $data['name'] = $item->getProduct()->getName();
            $data['price'] = $item->getProduct()->getPrice();
            $data['quantity'] = $item->getQuantity();
            $items[] = $data;
        }

        return $items;
    }

    public function getCost(): float
    {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $totalPrice += ($item->getProduct()->getPrice() * $item->getQuantity());
        }

        return $totalPrice;
    }

    public function jsonSerialize(): array
    {
        return [
            'order number' => $this->id,
            'date' => $this->getDate(),
            'items' => $this->getItems(),
            'total cost' => $this->getCost(),
        ];
    }
}