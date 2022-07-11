<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductWithGalleryService;

class ProductsController extends Controller
{
    private $productWithGalleryService;

    public function __construct(ProductWithGalleryService $productWithGalleryService)
    {
        $this->productWithGalleryService = $productWithGalleryService;
    }

    public function index()
    {
        return view('front.pages.products', [
            'title' => 'Products | Bunehaba Shop',
            'products' => $this->productWithGalleryService->list()
        ]);
    }

    public function popular()
    {
        return view('front.pages.products', [
            'title' => 'Popular Products | Bunehaba Shop',
            'products' => $this->productWithGalleryService->list()
        ]);
    }

    public function new()
    {
        return view('front.pages.products', [
            'title' => 'New Products | Bunehaba Shop',
            'products' => $this->productWithGalleryService->list()
        ]);
    }
}
