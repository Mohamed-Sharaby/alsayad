<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StorageInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MadeProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Edit Products');
    }


    public function getMadeView($id)
    {
        return view('dashboard.products.made-form', [
            'product' => Product::with('productMaterials.unit')->findOrFail($id),
        ]);
    }


    public function madeProduct(Request $request, $id)
    {
        DB::beginTransaction();

        /** @var \App\Models\Product $product */
        $request->validate(['required_quantity' => 'required|numeric']);
        $product = Product::findOrFail($id);
        foreach ($product->productMaterials as $material) {
            if ($material->pivot->quantity < $material->quantity) {
                $storage_invoice = StorageInvoice::create([
                    'code' => Str::random(8),
                    'date' => now(),
                    'type' => 'out',
                    'total' => 0,
                    'received' => 0,
                    'created_by' => auth()->id(),
                ]);
                $storage_invoice->storageInvoiceItems()->create(
                    [
                        'product_id' => $material->id,
                        'buying_price' => $material->buying_price ?? 0,
                        'quantity' => $material->pivot->quantity * $request->required_quantity,
                    ]
                );

            } else {
                return back()->with('error', 'الكمية المتاحة بالمخزن من ' . '( ' . $material->name . ')' . ' غير كافية');
            }
        }
        $product->createProductFactory($request->required_quantity);
        $product->addStartStorageInvoice($request->required_quantity);

        DB::commit();
        return redirect(route('admin.products.index'))->with('success', 'تم التصنيع بنجاح');
    }


}
