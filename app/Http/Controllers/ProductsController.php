<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\MitraService;
use App\Services\PermissionService;
use App\Services\ProductService;
use Spatie\Permission\Contracts\Permission;

class ProductsController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('admin.pages.product.index', [
            'title' => 'Products',
            'products' => $this->productService->list(),
        ]);
    }

    public function create(MitraService $mitraService)
    {
        return view('admin.pages.product.create', [
            'title' => 'Tambah Product',
            'rekanan' => $mitraService->list()
        ]);
    }

    public function store(CreateProductRequest $createProductRequest)
    {
        try {
            $product = $this->productService->store($createProductRequest);

            return response()->json([
                'status' => true,
                'data' => $product
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit($id, MitraService $mitraService)
    {
        return view('admin.pages.product.edit', [
            'title' => 'Edit Product',
            'product' => $this->productService->find($id),
            'rekanan' => $mitraService->list()
        ]);
    }

    public function update(UpdateProductRequest $updateProductRequest, $id)
    {
        try {
            $data = $this->productService->update($updateProductRequest, $id);

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (Exception $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {

            $this->productService->delete($id);

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
