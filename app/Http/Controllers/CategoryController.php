<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.pages.category.index', [
            'title' => 'Categories',
            'categories' => $this->categoryService->list()
        ]);
    }

    public function find()
    {
    }

    public function create()
    {
        return view('admin.pages.category.create', [
            'title' => 'Tambah Category'
        ]);
    }

    public function store(CreateCategoryRequest $createCategoryRequest)
    {
        try {
            $category = $this->categoryService->store($createCategoryRequest);

            return response()->json([
                'status' => true,
                'data' => $category
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(int $id)
    {
        return view('admin.pages.category.edit', [
            'title' => 'Edit Category',
            'category' => $this->categoryService->find($id)
        ]);
    }

    public function update(UpdateCategoryRequest $updateCategoryRequest, int $id)
    {
        try {
            $data = $this->categoryService->update($updateCategoryRequest, $id);

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

    public function delete(int $id)
    {
        try {

            $this->categoryService->delete($id);

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
