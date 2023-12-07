<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Domain\Collector;

use App\Domain\Order\Entity\Order;
use App\Domain\ValueObject\OrderDetail;

class OrderDataCollector
{
    private const VAT = 0.23;

    public function splitOrderDetails(Order $order): OrderDetail
    {
        $itemCount = 0;
        $totalCost = 0.0;

        foreach ($order->getItems() as $item) {
            $itemCount += $item->getQuantity();
            $totalCost += ($item->getProduct()->getPrice() * $item->getQuantity());
        }

        $totalVat = $totalCost * self::VAT;
        $totalNetCost = $totalCost - $totalVat;

        return new OrderDetail(
            $itemCount,
            $totalCost,
            $totalVat,
            $totalNetCost
        );
    }
}