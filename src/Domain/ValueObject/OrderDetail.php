<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Domain\ValueObject;

class OrderDetail
{
    private int $itemCount;

    private float $totalCost;

    private float $vat;

    private float $netPrice;

    public function __construct(
        int $itemCount,
        float $totalCost,
        float $vat,
        float $netPrice
    ) {
        $this->itemCount = $itemCount;
        $this->totalCost = $totalCost;
        $this->vat = $vat;
        $this->netPrice = $netPrice;
    }

    public function getItemCount(): int
    {
        return $this->itemCount;
    }

    public function getTotalCost(): float
    {
        return $this->totalCost;
    }

    public function getVat(): float
    {
        return $this->vat;
    }

    public function getNetPrice(): float
    {
        return $this->netPrice;
    }
}