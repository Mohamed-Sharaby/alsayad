<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\InventoriesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryRequest;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\Product;
use App\Models\StorageInvoice;
use App\Models\StorageInvoiceItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Inventory', ['only' => ['index']]);
        $this->middleware('permission:Create Inventory', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Inventory', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Inventory', ['only' => ['destroy']]);
    }


    public function index(InventoriesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.inventories.index');
    }


    public function create()
    {
        return view('dashboard.inventories.create', [
            'products' => Product::with('storage_quantity')->get(),
        ]);
    }


    public function store(InventoryRequest $request)
    {
        DB::beginTransaction();
        $inventory = Inventory::query()->create($request->validated());

        $inventory->inventoryItems()->createMany($request->products);

        $products = collect($request->products)->map(function ($product) use ($inventory) {
            $product['inventory_id'] = $inventory->id;
            $item = InventoryItem::make($product);
            $arr = [
                'type' => 'equal',
            ];
            if ($item->diff != 0) {
                $arr = [
                    'type' => $item->diff > 0 ? 'out' : 'in',
                    'amount' => abs($item->diff),
                ];
            }

            if ($item->DifferenceHasEdited($product['difference'])) {
                $arr = $item->getEditedQuantity($product['difference']);
            }
            return $item->toArray() + $arr;
        })->groupBy('type')->toArray();

        if (isset($products['in'])) {
            list($product, $invoice) = $this->FixInventoryProductChanges($products['in'], $inventory, 'in');
        }
        if (isset($products['out'])) {
            list($product, $invoice) = $this->FixInventoryProductChanges($products['out'], $inventory, 'out');
        }

        DB::commit();
        return redirect(route('admin.inventories.index'))->with('success', 'تم الاضافة بنجاح');
    }


    public function show(Inventory $inventory)
    {
        return view('dashboard.inventories.show', [
            'inventory' => $inventory->load('inventoryItems.product'),
        ]);
    }


//    public function destroy(Inventory $inventory)
//    {
//        $inventory->delete();
//        return 'Done';
//    }

    /**
     * @param $in
     * @param \Illuminate\Database\Eloquent\Model $inventory
     * @return array
     */
    public function FixInventoryProductChanges($in, \Illuminate\Database\Eloquent\Model $inventory, $type): array
    {
        foreach ($in as $product) {
            $invoice = StorageInvoice::create([
                'code' => Str::random(5),
                'type' => $type,
                'date' => $inventory->date,
                'supplier_id' => null,
                'inventory_id' => $inventory->id,
                'created_by' => auth()->user()->id,
            ]);

            $invoice->storageInvoiceItems()->create([
                'product_id' => $product['product_id'],
                'buying_price' => DB::table('storage_quantities')->where('product_id', $product['product_id'])->value('buying_price'),
                'quantity' => $product['amount']
            ]);

        }
        return array($product, $invoice);
    }
}
