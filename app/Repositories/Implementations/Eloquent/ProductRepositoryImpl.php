<?php

namespace App\Repositories\Implementations\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepositoryImpl implements ProductRepository
{

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function findAll()
    {
        return Product::all();
    }

    public function findById($id)
    {
        $product = Product::find($id);

        if ($product == null) {
            throw new ModelNotFoundException("Product not found");
        }

        return $product;
    }

    public function update(array $data, $id)
    {
        $product = Product::find($id);

        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->stock = $data['stock'];

        $product->save();

        return $product;
    }


    public function delete($id)
    {
        return Product::destroy($id);
    }
}
