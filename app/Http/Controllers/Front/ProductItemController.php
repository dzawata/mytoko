<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\ProductWithGalleryService;
use Illuminate\Http\Request;

class ProductItemController extends Controller
{
    public function index(Request $request, ProductWithGalleryService $productWithGalleryService)
    {
        $product = $productWithGalleryService->item($request->slug);

        return view('front.pages.product-item', [
            'title' => $product->product_name . ' | Bunehaba Shop',
            'product' => $product
        ]);
    }
}
