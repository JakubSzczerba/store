<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Domain\Order;

use App\Domain\Order\Entity\Order;

interface OrderRepositoryInterface
{
    public function getById(int $id): ?Order;
}