<?php

namespace App\Services;

use App\Services\ProductGalleryService;
use App\Services\ProductService;

class ProductWithGalleryService
{

    private $productService;
    private $productGalleryService;

    public function __construct(ProductService $productService, ProductGalleryService $productGalleryService)
    {
        $this->productService = $productService;
        $this->productGalleryService = $productGalleryService;
    }

    public function list()
    {

        $products = $this->productService->list();

        $data = [];
        foreach ($products as $keyProduct => $product) {

            $galleries = $this->productGalleryService->show($product->id);
            foreach ($galleries as $keyGallery => $gallery) {

                if ($gallery->is_cover) {
                    if (empty($data[$product->id])) {
                        $data[$product->id] = (object)[
                            'id' => $product->id,
                            'product_name' => $product->product_name,
                            'slug' => $product->slug,
                            'owner' => $product->owner,
                            'img' => $gallery->image,
                        ];
                    }
                }
            }
        }

        return $data;
    }
}
