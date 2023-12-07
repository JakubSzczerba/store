<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Domain\Item\Factory;

use App\Domain\Item\Entity\Item;
use App\Domain\Order\Entity\Order;
use App\Domain\Product\Entity\Product;

class ItemFactory implements ItemFactoryInterface
{
    public function createNew(
        Product $product,
        int $quantity,
        Order $order
    ): Item {
        return new Item(
            $product,
            $quantity,
            $order
        );
    }
}