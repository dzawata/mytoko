<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProductWithGalleryService;

class HomeController extends Controller
{

    private $productWithGalleryService;

    public function __construct(ProductWithGalleryService $productWithGalleryService)
    {
        $this->productWithGalleryService = $productWithGalleryService;
    }

    public function home()
    {
        return view('front.pages.home', [
            'title' => 'Home | Bunehaba Shop',
            'products' => $this->productWithGalleryService->list()
        ]);
    }
}
