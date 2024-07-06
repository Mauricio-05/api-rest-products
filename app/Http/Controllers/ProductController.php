<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\Contracts\ProductRepository;
use Error;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    public function __construct(
        protected ProductRepository $productRepository
    ) {
    }

    public function create(CreateProductRequest $request)
    {
        try {
            $product = $request->validated();

            $productCreate = $this->productRepository->create($product);

            return response()->json([
                'ok' => true,
                'data' => $productCreate,
                'message' => 'Product created'
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            throw new Error($e->getMessage());
        }
    }


    public function findAll()
    {
        try {
            $products = $this->productRepository->findAll();

            return response()->json([
                'ok' => true,
                'data' => $products,
                'message' => 'Products list'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            throw new Error($e->getMessage());
        }
    }


    public function findById($id)
    {
        try {
            $product = $this->productRepository->findById($id);

            return response()->json([
                'ok' => true,
                'data' => $product,
                'message' => 'Products find by id'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            throw new ModelNotFoundException("Product not found");
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = $request->validated();

            Log::info($product);

            $productUpdate = $this->productRepository->update($product, $id);

            return response()->json([
                'ok' => true,
                'data' => $productUpdate,
                'message' => 'Products update'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            throw new Error($e->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            $this->productRepository->delete($id);

            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            throw new Error($e->getMessage());
        }
    }
}
