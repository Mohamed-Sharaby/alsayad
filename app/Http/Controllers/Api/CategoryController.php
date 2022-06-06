<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::active()->get();
        return response()->json(CategoryResource::collection($categories));
    }


}
