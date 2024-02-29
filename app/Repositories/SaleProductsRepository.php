<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\SaleProducts;

class SaleProductsRepository extends BaseRepository
{

    protected $entity;

    public function __construct()
    {
        $this->entity = app(SaleProducts::class);
    }
}
