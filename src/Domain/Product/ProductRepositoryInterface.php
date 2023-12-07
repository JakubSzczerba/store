<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Product\Entity\Product;

interface ProductRepositoryInterface
{
    public function getById(int $id): ?Product;
}