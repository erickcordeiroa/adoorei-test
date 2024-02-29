<?php

declare(strict_types=1);

namespace App\DTO;

class SalesDTO
{
    public function __construct(
        public float $amount,
        public object $products
    ) {
    }
}