<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends ApiController
{
    public function index()
    {
        return $this->dataResponse(CategoryResource::collection(Category::all()));
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create([
            "name" => $request->input("name"),
            "color" => $request->input("color"),
            "user_id" => auth()->id(),
        ]);

        return $this->successResponse("Category saved successfully.", new CategoryResource($category));
    }

    public function show(Category $category)
    {
        return $this->dataResponse(new CategoryResource($category));
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        $category->update([
            "name" => $request->input("name"),
            "color" => $request->input("color")
        ]);

        return $this->successResponse("Category updated successfully.", new CategoryResource($category));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return $this->successResponse("Category deleted successfully.");
    }
}
