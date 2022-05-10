<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\CreateProductGalleryRequest;
use App\Services\ProductGalleryService;
use App\Services\ProductService;

class ProductGalleriesController extends Controller
{
    protected $productService;
    protected $productGalleryService;

    public function __construct(
        ProductService $productService,
        ProductGalleryService $productGalleryService
    ) {
        $this->productService = $productService;
        $this->productGalleryService = $productGalleryService;
    }

    public function show(int $id)
    {
        $product = $this->productService->find($id);

        return view('admin.pages.product-galleries.index', [
            'title' => 'Product Galleries',
            'productId' => $id,
            'productName' => $product->product_name,
            'galleries' => $this->productGalleryService->show($id)
        ]);
    }

    public function create(int $id)
    {
        return view('admin.pages.product-galleries.create', [
            'title' => 'Tambah Product Gallery',
            'productId' => $id
        ]);
    }

    public function store(CreateProductGalleryRequest $createProductGalleryRequest, int $id)
    {
        try {
            $data = $this->productGalleryService->store($createProductGalleryRequest, $id);

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {

            $this->productGalleryService->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Sukses hapus data'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
