<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;

class ProductsController extends Controller
{
    public function __construct(
        protected ProductsService $productService
    ) {
    }

    public function index() : object
    {
        return $this->productService->findAll();
    }
}
