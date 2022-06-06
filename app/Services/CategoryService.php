<?php

namespace App\Services;

use Exception;
use App\Models\Category;

class CategoryService
{

    public function list()
    {
        return Category::get();
    }

    public function find(int $id)
    {
        return Category::findOrFail($id);
    }

    public function store($request)
    {
        try {
            return Category::create([
                'category' => $request->category,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($request, int $id)
    {
        try {

            $category = Category::findOrFail($id);

            $category->update([
                'category' => $request->category

            ]);

            return $category;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id)
    {

        try {

            $category = Category::findOrFail($id);

            $category->delete();
        } catch (Exception $th) {
            throw $th;
        }
    }
}
