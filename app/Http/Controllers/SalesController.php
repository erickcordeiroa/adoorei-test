<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Http\Resources\SalesResource;
use App\Services\SalesService;

class SalesController extends Controller
{
    /**
     * @OA\Info(
     *     title="Adoorei Test Vaga Pleno/Senior",
     *     version="1.0",
     *     description="Utilizando o Laravel cria uma API rest, A Loja ABC LTDA, vende produtos de diferentes nichos. No momento precisamos registrar a venda de celulares.",
     *     @OA\Contact(
     *         email="erickcordeiroa@gmail.com@gmail.com",
     *         name="Erick Cordeiro"
     *     ),
     *     @OA\License(
     *         name="",
     *     )
     * )
     */

    public function __construct(
        protected SalesService $salesService
    ) {
    }

    /**
     * @OA\Get(
     *      path="/api/sales",
     *      operationId="getSalesList",
     *      tags={"Sales"},
     *      summary="Get list of sales",
     *      description="Returns list of sales",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *      ),
     * )
     */
    public function index()
    {
        $sales = $this->salesService->findAll();
        return SalesResource::collection($sales);
    }

    /**
     * @OA\Post(
     *      path="/api/sales",
     *      operationId="createSale",
     *      tags={"Sales"},
     *      summary="Create a new sale",
     *      description="Stores a newly created sale in the storage",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Sale data",
     *          @OA\JsonContent(
     *              required={"products"},
     *              @OA\Property(property="products", type="array", @OA\Items(
     *                  @OA\Property(property="id", type="integer", default=1),
     *                  @OA\Property(property="amount", type="integer", default=1),
     *              )),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      ),
     * )
     */
    public function store(SaleRequest $request)
    {
        try {
            $this->salesService->create($request->all());
            return response()->json(['message' => 'Sales was successfully created']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/sales/{id}",
     *      operationId="getSaleOne",
     *      tags={"Sales"},
     *      summary="Get One sale",
     *      description="Returns details of a single sale",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the sale",
     *          @OA\Schema(type="integer"),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Sale not found",
     *      ),
     * )
     */
    public function show(int $id)
    {
        $sale = $this->salesService->find($id);

        if (!$sale) {
            return response()->json(['message' => 'Sales not found']);
        }

        return new SalesResource($sale);
    }


    /**
     * @OA\Post(
     *      path="/api/sales/{id}/add-product",
     *      operationId="addProductSale",
     *      tags={"Sales"},
     *      summary="Create a new Product in the sale",
     *      description="Stores a newly product in the sale",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the sale",
     *          @OA\Schema(type="integer"),
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Sale data",
     *          @OA\JsonContent(
     *              required={"products"},
     *              @OA\Property(property="products", type="array", @OA\Items(
     *                  @OA\Property(property="id", type="integer", default=1),
     *                  @OA\Property(property="amount", type="integer", default=1),
     *              )),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      ),
     * )
     */
    public function addProductToSale(int $id, SaleRequest $request)
    {
        try {
            $this->salesService->addProductsToSale($id, $request->all());
            return response()->json(['message' => 'Product successfully included in your sale']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/sales/{id}",
     *      operationId="deleteSaleOne",
     *      tags={"Sales"},
     *      summary="Delete a sale",
     *      description="Return message if it's ok",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the sale",
     *          @OA\Schema(type="integer"),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Sale not found",
     *      ),
     * )
     */
    public function destroy(int $id)
    {
        try {
            $this->salesService->delete($id);
            return response()->json(['message' => 'Sales was successfully cancelled']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
