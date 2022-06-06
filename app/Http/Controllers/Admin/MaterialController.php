<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MaterialsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\StorageInvoice;
use App\Models\StorageInvoiceItem;
use App\Models\StorageQuantity;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Materials', ['only' => ['index']]);
        $this->middleware('permission:Create Materials', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Materials', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Materials', ['only' => ['destroy']]);
    }


    public function index(MaterialsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.materials.index');
    }


    public function create()
    {
        return view('dashboard.materials.create', [
            'units' => Unit::pluck('name', 'id'),
        ]);
    }


    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:100|unique:products,name',
            'unit_id' => 'required|exists:units,id',
            'start_quantity' => 'required',
            'buying_price' => 'required'
        ]);
        $validator['created_by'] = auth()->user()->id;
        $validator['type'] = 'material';
        DB::beginTransaction();
        $product = Product::create($validator);
        $this->addStartStorageInvoice($product,$request->start_quantity,$request->buying_price);
        DB::commit();
        return redirect(route('admin.materials.index'))->with('success', 'تم الاضافة بنجاح');
    }


    public function edit($id)
    {
        return view('dashboard.materials.edit', [
            'product' => Product::findOrFail($id),
            'units' => Unit::pluck('name', 'id'),
        ]);
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validator = $request->validate([
            'name' => 'required|string|max:100|unique:products,name,'.$product->id,
            'unit_id' => 'required|exists:units,id',
            'buying_price' => 'required'
        ]);
        $product->update($validator);
        StorageInvoiceItem::whereProductId($product->id)->update(['buying_price'=>$request->buying_price]);
        return redirect(route('admin.materials.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return 'Done';
    }



    public function addStartStorageInvoice($product,$quantity,$buying_price)
    {
        if (!$product->is_runtime_made) {
            /** @var StorageInvoice $storage_invoice */
            $storage_invoice = StorageInvoice::create([
                'code' => Str::random(8),
                'date' => now(),
                'type' => 'in',
                'total' => 0,
                'received' => 0,
                'created_by' => auth()->id(),
            ]);
            $storage_invoice->storageInvoiceItems()->create(
                [
                    'product_id' => $product->id,
                    'buying_price' => $buying_price ?? 0,
                    'quantity' => $quantity,
                ]
            );
        }
    }
}
