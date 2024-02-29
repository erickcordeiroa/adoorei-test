<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProducts;
use App\Repositories\ProductsRepository;
use App\Repositories\SaleProductsRepository;
use App\Repositories\SalesRepository;
use App\Services\SalesService;
use Tests\TestCase;

class SalesServiceTest extends TestCase
{

    protected $salesRepository;
    protected $productsRepository;
    protected $salesProductsRepository;
    protected $salesService;

    protected function setUp(): void
    {
        $this->salesRepository = new SalesRepository(new Sale());
        $this->productsRepository = new ProductsRepository(new Product());
        $this->salesProductsRepository = new SaleProductsRepository(new SaleProducts());
        $this->salesService = new SalesService(
            $this->salesRepository, $this->productsRepository, $this->salesProductsRepository);
        parent::setUp();
    }
    /**
     * A basic feature test example.
     */
    public function test_find_all(): void
    {
        $result = $this->salesService->findAll();
        $this->assertIsArray($result);
    }

    public function test_find_one(): void
    {
        $result = $this->salesService->find(1);
        $this->assertIsArray($result);
    }
}
