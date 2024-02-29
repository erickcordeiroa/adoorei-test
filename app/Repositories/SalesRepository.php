<?php

namespace App\Repositories;

use App\Models\Sale;

class SalesRepository extends BaseRepository
{

    protected $entity;

    public function __construct()
    {
        $this->entity = app(Sale::class);
    }
}
