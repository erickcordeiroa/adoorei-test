<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalesResource;
use App\Services\SalesService;
use Error;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalesController extends Controller
{
    public function __construct(
        protected SalesService $salesService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = $this->salesService->findAll();
        return SalesResource::collection($sales);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
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
     * Remove the specified resource from storage.
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
