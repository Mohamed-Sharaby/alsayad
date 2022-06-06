<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierProductsController extends Controller
{


    public function __invoke(Request $request)
    {
          return Supplier::find(request()->supplier_id)->products->load('storage_quantity');
//        return Product::with('storage_quantity')
//            ->whereRelation('suppliers', 'supplier_id', request()->supplier_id)->get();
    }
}
