<?php

namespace App\Repositories;

use App\Models\Product;

class ProductsRepository extends BaseRepository
{

    protected $entity;

    public function __construct()
    {
        $this->entity = app(Product::class);
    }
}
