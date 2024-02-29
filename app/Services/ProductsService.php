<?php

namespace App\Services;

use App\Repositories\ProductsRepository;
use Exception;

class ProductsService
{
    public function __construct(protected ProductsRepository $productsRepository)
    {
    }

    public function findAll(): object
    {
        try {
            return $this->productsRepository->all();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
