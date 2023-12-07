<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Domain\Order\Factory;

use App\Domain\Order\Entity\Order;

interface OrderFactoryInterface
{
    public function createNew(\DateTimeImmutable $dateTimeImmutable): Order;
}