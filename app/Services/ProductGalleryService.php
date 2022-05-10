<?php

namespace App\Services;

use Exception;
use App\Models\ProductGalleries;
use Illuminate\Support\Facades\Storage;

class ProductGalleryService
{

    public function show(int $id)
    {
        return ProductGalleries::where('product_id', $id)->get();
    }

    public function store($request, int $id)
    {
        try {
            return ProductGalleries::create([
                'product_id' => $id,
                'image' => $request->file('image')->store('assets/product-galleries', 'public')
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id)
    {
        try {
            $gallery = ProductGalleries::findOrFail($id);

            if ($gallery->delete()) {

                Storage::disk('public')->delete($gallery->image);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
