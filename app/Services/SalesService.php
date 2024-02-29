<?php

namespace App\Services;

use App\DTO\SalesDTO;
use App\Models\Sale;
use App\Repositories\ProductsRepository;
use App\Repositories\SaleProductsRepository;
use App\Repositories\SalesRepository;
use Exception;

class SalesService
{
    public function __construct(
        protected SalesRepository $salesRepository,
        protected ProductsRepository $productsRepository,
        protected SaleProductsRepository $saleProductsRepository
    ) {
    }

    public function findAll(): object
    {
        try {
            return $this->salesRepository->relationships('products')->orderBy('created_at', 'desc')->get();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function find(int $id): object|null
    {
        try {
            return $this->salesRepository->relationships('products')->find($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function create(array $data): object
    {
        try {
            $sale = $this->salesRepository->create(['amount' => 0]);

            foreach ($data['products'] as $item) {
                $product = $this->productsRepository->find($item['id']);

                if ($item) {
                    $amount = $item['amount'];
                    $totalAmount = $product->price * $amount;

                    $sale->amount += $totalAmount;
                    $sale->save();

                    $this->saleProductsRepository->create([
                        'sale_id' => $sale->id,
                        'product_id' => $product->id,
                        'amount' => $amount,
                    ]);
                }
            }

            return $sale;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function addProductsToSale(int $id, array $newProducts): object
    {
        try {
            $sale = $this->salesRepository->find($id);

            if (!$sale) {
                throw new Exception('Venda não encontrada');
            }

            foreach ($newProducts['products'] as $item) {
                $product = $this->productsRepository->find($item['id']);

                if ($product) {
                    $existingProducts = $this->saleProductsRepository
                        ->findByWhere([
                            'sale_id' => $sale->id,
                            'product_id' => $product->id
                        ]);

                    if ($existingProducts) {
                        $existingProducts->amount += $item['amount'];
                        $existingProducts->save();

                        $totalAmount = $product->price * $item['amount'];
                        $sale->amount += $totalAmount;
                        $sale->save();
                    } else {
                        $amount = $item['amount'];
                        $totalAmount = $product->price * $amount;

                        $sale->amount += $totalAmount;
                        $sale->save();

                        $this->saleProductsRepository->create([
                            'sale_id' => $sale->id,
                            'product_id' => $product->id,
                            'amount' => $amount,
                        ]);
                    }
                }
            }

            return $sale;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(int $id): object
    {
        try {
            $result = $this->salesRepository->destroy($id);
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
