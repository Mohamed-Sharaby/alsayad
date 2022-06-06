<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\StorageInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantInvoiceController extends Controller
{

    public function get_products()
    {
        $products = Product::active()->get();
        return response()->json(ProductResource::collection($products));
    }

    public function save_invoice(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:storage_invoices,code',
            'date' => 'required|date|date_format:Y-m-d',
            'products' => 'required|array',
            'products.*.product_id' => 'required|numeric|exists:products,id',
            'products.*.buying_price' => 'required|numeric',
            'products.*.quantity' => 'required|numeric',
            'total' => 'required',
            'created_by' => 'nullable|numeric|exists:admins,id',
            'notes' => 'nullable|string',
        ]);
        $data['created_by'] = auth()->id();
        $data['type'] = 'out';

        DB::beginTransaction();

        $invoice = StorageInvoice::query()->create($data);
        $invoice->storageInvoiceItems()->createMany($data['products']);

        DB::commit();

        return response()->json(['status' => true, 'msg' => 'تم حفظ الفاتورة بنجاح']);
    }


}
