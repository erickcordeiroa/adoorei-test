<?php

namespace App\Services;

use App\DTO\SalesDTO;
use App\Models\Sale;
use App\Repositories\SalesRepository;
use Exception;

class SalesService
{
    public function __construct(protected SalesRepository $salesRepository)
    {
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

    public function create(SalesDTO $data): object
    {
        try {
            $sale = $this->salesRepository->create($data);
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
