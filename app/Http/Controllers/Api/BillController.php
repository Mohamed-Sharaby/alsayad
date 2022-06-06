<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Client;
use App\Models\Cooking;
use App\Models\MaterialProduct;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BillController extends Controller
{
    public function admin_id()
    {
        return response()->json(['admin_id' => auth()->id()]);
    }


    public function cooking_types()
    {
        $types = Cooking::active()->get();
        return response()->json(CategoryResource::collection($types));
    }

    public function products_by_category($id)
    {
        $products = Product::active()->isProduct()->whereCategoryId($id)->get();
        return response()->json(ProductResource::collection($products));
    }


    public function settings()
    {
        $settings = Setting::get()->mapWithKeys(function ($q) {
            return [$q['name'] => $q->value];
        });
        return response()->json($settings);
    }


    public function save_invoice(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|numeric|exists:products,id',
            'products.*.quantity' => 'required|numeric',
            'products.*.product_price' => 'required|numeric',
            'products.*.cooking_id' => 'nullable|numeric|exists:cookings,id',
            'products.*.cooking_price' => 'nullable|numeric',
            'client_id' => 'nullable',
            'date' => 'nullable|date',
            'total' => 'required|numeric',
            'status' => 'required|in:paid,unpaid,partially',
            'received' => 'required_if:status,partially|numeric|lte:total',
            'notes' => 'nullable|string',
            'is_points' => 'boolean',
        ]);

        DB::beginTransaction();

//        foreach ($request->products as $item) {
//            $product = Product::findOrFail($item['product_id']);
//            if ($product->type == 'made') {
//                if ($product->made_in_order == 0) {
//                    if ($item['quantity'] > $product->bill_quantity) {
//                        return response()->json(['status' => false, 'msg' => 'كمية الصنف المطلوبة غير متاحة فى المحل']);
//                    }
//                }
//                if ($product->made_in_order == 1) {
//                    foreach ($product->productMaterials as $materialItem) {
//                        $totalMaterialRequired = $materialItem->pivot->quantity * $item['quantity'];
//                        if ($totalMaterialRequired > $materialItem->bill_quantity) {
//                            return response()->json([
//                                'status' => false, 'msg' => 'كمية المواد الخام المطلوبة للصنف غير متاحة فى المحل'
//                            ]);
//                        }
//                    }
//                }
//            } else {
//                if ($item['quantity'] > $product->bill_quantity) {
//                    return response()->json([
//                        'status' => false, 'msg' => ' كمية الصنف المطلوبة من' . '( ' . $product['name'] . ' )' . 'غير متاحة فى المحل'
//                    ]);
//                }
//            }
//        }
        if (!is_null($request->client_id)) {
            $client = Client::findOrFail($request->client_id);
            if ($request->is_points) {
                $clientPointsToRiyal = $client->points * getsetting('points');
                if ($request->total > $clientPointsToRiyal) {
                    $points_paid = $clientPointsToRiyal;
                } else {
                    $points_paid = $request->total / getsetting('riyal');
                    $request->received = $request->total;
                }
                $client->decrement('points', $points_paid);
            } else {
                $client->increment('points', $request->total * getsetting('riyal'));
            }
        }


        $invoice = Sale::query()->create([
            'code' => rand(100, 99999),
            'date' => now(),
            'client_id' => $request->client_id,
            'total' => $request->total,
            'status' => $request->status,
            'received' => $request->received,
            'created_by' => auth()->id(),
            'is_points' => $request->is_points,
            'points_paid' => $points_paid ?? null,
            'notes' => $request->notes,
        ]);


        foreach ($request->products as $item) {
            SaleItem::create([
                'sale_id' => $invoice->id,
                'product_id' => $item['product_id'],
                'cooking_id' => $item['cooking_id'] ?? null,
                'cooking_price' => $item['cooking_price'] ?? 0,
                'quantity' => $item['quantity'],
                'product_price' => $item['product_price'],
                'total_product_price' => $item['product_price'] * $item['quantity'],
                'total' => ($item['product_price'] * $item['quantity']) + $item['cooking_price'],
            ]);
        }

        $itemsPrice = $invoice->items()->get()->sum('total');
        $tax = $itemsPrice * getsetting('tax') /100;
        $invoice->update(['tax'=>$tax]);

        if ($request->received > 0){
            $invoice->pay(now(), $request->received, auth()->id());
        }
        DB::commit();

        return response()->json([
            'status' => true,
            'msg' => 'تم حفظ الفاتورة بنجاح',
            'code' => $invoice->code,
            'uuid' => route('printInvoice',$invoice->uuid),
        ]);
    }


}
