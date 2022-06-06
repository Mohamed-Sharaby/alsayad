<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::query()->with('restaurant_quantity','storage_quantity') ;
        $products->active()->where('type', '!=', 'material');

        $products->when($request->category_id, function ($q) {
            $q->where('category_id', \request('category_id'));
        });
        $products = $products->get();
        return response()->json(ProductResource::collection($products));
    }


}
