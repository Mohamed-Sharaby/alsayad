<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SuppliersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Product;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Suppliers', ['only' => ['index']]);
        $this->middleware('permission:Create Suppliers', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Suppliers', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Suppliers', ['only' => ['destroy']]);
    }


    public function index(SuppliersDataTable $dataTable)
    {
        return $dataTable->render('dashboard.suppliers.index');
    }


    public function create()
    {
        return view('dashboard.suppliers.create', [
            'products' => Product::where('type','!=','made')->pluck('name', 'id')
        ]);
    }


    public function store(SupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());
        $supplier->products()->attach($request->product_id);
        return redirect(route('admin.suppliers.index'))->with('success', 'تم الاضافة بنجاح');
    }

    public function show(Supplier $supplier)
    {
        return view('dashboard.suppliers.show', [
            'supplier' => $supplier,
        ]);
    }


    public function edit(Supplier $supplier)
    {
        return view('dashboard.suppliers.edit', [
            'supplier' => $supplier,
            'products' => Product::pluck('name', 'id'),
        ]);
    }


    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        $supplier->products()->sync($request->product_id);
        return redirect(route('admin.suppliers.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return 'Done';
    }
}
