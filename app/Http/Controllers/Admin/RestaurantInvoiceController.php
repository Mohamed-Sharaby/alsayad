<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RestaurantInvoicesDataTable;
use App\DataTables\StorageInvoicesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantInvoiceRequest;
use App\Http\Requests\StorageInvoiceRequest;
use App\Models\Product;
use App\Models\StorageInvoice;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class RestaurantInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show RestaurantInvoices', ['only' => ['index']]);
        $this->middleware('permission:Create RestaurantInvoices', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit RestaurantInvoices', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete RestaurantInvoices', ['only' => ['destroy']]);
    }


    public function index(RestaurantInvoicesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.restaurant-invoices.index');
    }


    public function create()
    {
        return view('dashboard.restaurant-invoices.create', [
            'products' => Product::with('storage_quantity')->active()->whereMadeInOrder(0)->get(),
        ]);
    }


    public function store(RestaurantInvoiceRequest $request)
    {
        DB::beginTransaction();
        $invoice = StorageInvoice::query()->create($request->validated());
        foreach ($request->products as $item) {
            $product = Product::whereId($item['product_id'])->first();
            if ($item['quantity'] > $product->quantity) {
                return redirect()->back()->with('error', 'الكمية المطلوبة من ' . $product->name . ' غير متوفرة فى المخزن');
            }
        }
        $invoice->storageInvoiceItems()->createMany($request->products);
        DB::commit();

        return redirect(route('admin.restaurant-invoices.index'))->with('success', 'تم الاضافة بنجاح');
    }

    public function show(StorageInvoice $restaurantInvoice)
    {
        return view('dashboard.restaurant-invoices.show', [
            'restaurantInvoice' => $restaurantInvoice->load('storageInvoiceItems.product'),
        ]);
    }


    public function edit(StorageInvoice $restaurantInvoice)
    {
        return view('dashboard.restaurant-invoices.edit', [
            'invoice' => $restaurantInvoice,
            'products' => Product::with('storage_quantity')->get(),
        ]);
    }


    public function update(RestaurantInvoiceRequest $request, StorageInvoice $restaurantInvoice)
    {
        DB::beginTransaction();
        $restaurantInvoice->update($request->validated());
        $restaurantInvoice->storageInvoiceItems()->delete();
        foreach ($request->products as $item) {
            $product = Product::whereId($item['product_id'])->first();
            if ($item['quantity'] > $product->quantity) {
                return redirect()->back()->with('error', 'الكمية المطلوبة من ' . $product->name . ' غير متوفرة فى المخزن');
            }
        }
        $restaurantInvoice->storageInvoiceItems()->createMany($request->products);

        DB::commit();

        return redirect(route('admin.restaurant-invoices.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(StorageInvoice $restaurantInvoice)
    {
        $restaurantInvoice->delete();
        return 'Done';
    }
}
