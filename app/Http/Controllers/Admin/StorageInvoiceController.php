<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StorageInvoicesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorageInvoiceRequest;
use App\Models\Product;
use App\Models\StorageInvoice;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class StorageInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show StorageInvoices', ['only' => ['index']]);
        $this->middleware('permission:Create StorageInvoices', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit StorageInvoices', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete StorageInvoices', ['only' => ['destroy']]);
    }


    public function index(StorageInvoicesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.storage-invoices.index');
    }


    public function create()
    {
        return view('dashboard.storage-invoices.create', [
            'products' => Product::active()->pluck('name', 'id'),
            'suppliers' => Supplier::active()->pluck('name', 'id'),
            'units' => Unit::active()->pluck('name', 'id'),
        ]);
    }


    public function store(StorageInvoiceRequest $request)
    {
        DB::beginTransaction();

        $invoice = StorageInvoice::create($request->validated());
        $invoice->storageInvoiceItems()->createMany($request->products);
        if ($request->received > 0){
            $invoice->pay($request->date ,$request->received);
        }

        DB::commit();

        return redirect(route('admin.storage-invoices.index'))->with('success', 'تم الاضافة بنجاح');
    }

    public function show(StorageInvoice $storageInvoice)
    {
        return view('dashboard.storage-invoices.show', [
            'storageInvoice' => $storageInvoice->load('storageInvoiceItems.product','storageInvoiceItems.unit'),
        ]);
    }


    public function edit(StorageInvoice $storageInvoice)
    {
        return view('dashboard.storage-invoices.edit', [
            'invoice' => $storageInvoice,
            'products' => Product::pluck('name', 'id'),
            'suppliers' => Supplier::pluck('name', 'id'),
            'units' => Unit::pluck('name', 'id'),
        ]);
    }


    public function update(StorageInvoiceRequest $request, StorageInvoice $storageInvoice)
    {
        DB::beginTransaction();
        $storageInvoice->update($request->validated());
        $storageInvoice->storageInvoiceItems()->delete();
        $storageInvoice->storageInvoiceItems()->createMany($request->products);

        DB::commit();

        return redirect(route('admin.storage-invoices.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(StorageInvoice $storageInvoice)
    {
        $storageInvoice->delete();
        return 'Done';
    }
}
