<?php

namespace App\Services;

use Exception;
use App\Models\Product;

class ProductService
{

    public function list()
    {
        return Product::all();
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function store($request)
    {
        try {
            return Product::create([
                'product_name' => $request->product_name,
                'slug' => $request->slug,
                'owner' => $request->owner
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($request, $id)
    {
        try {

            $product = Product::findOrFail($id);

            $product->update([
                'product_name' => $request->product_name,
                'slug' => $request->slug,
                'owner' => $request->owner

            ]);

            return $product;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id)
    {

        try {

            $product = Product::findOrFail($id);

            $product->delete();
        } catch (Exception $th) {
            throw $th;
        }
    }
}
