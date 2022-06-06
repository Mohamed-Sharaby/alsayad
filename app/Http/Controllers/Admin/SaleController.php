<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SaleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Models\Client;
use App\Models\Cooking;
use App\Models\Product;
use App\Models\Sale;
use App\Models\StorageInvoice;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show SalesInvoices', ['only' => ['index']]);
        $this->middleware('permission:Create SalesInvoices', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit SalesInvoices', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete SalesInvoices', ['only' => ['destroy']]);
    }


    public function index(SaleDataTable $dataTable)
    {
        return $dataTable->render('dashboard.sales.index');
    }

    public function create()
    {

        if (!auth()->user()->hasOpenShift()) {
          return  redirect()->route('admin.shifts.index');
        }
      //  return  redirect()->route('admin.shifts.create');
        return view('dashboard.sales.create');
    }


    public function show(Sale $sale)
    {
        return view('dashboard.sales.show', [
            'sale' => $sale->load('items.product'),
        ]);
    }


    public function edit(Sale $sale)
    {
        return view('dashboard.sales.edit', [
            'invoice' => $sale,
            'products' => Product::active()->isProduct()->get(),
            'cookings' => Cooking::all(),
            'clients' => Client::pluck('name', 'id'),
        ]);
    }


    public function update(SaleRequest $request, Sale $sale)
    {

        DB::beginTransaction();
        $sale->update($request->validated());
        $sale->items()->delete();
        $sale->items()->createMany($request->products);

        DB::commit();

        return redirect(route('admin.sales.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Sale $sale)
    {
        $sale->delete();
        return 'Done';
    }

    public function print($uuid)
    {
        $sale = Sale::where('uuid',$uuid)->first();
        $itemsPrice = $sale->items()->get()->sum('total');
        return view('dashboard.sales.print', compact('sale','itemsPrice'));
    }
}
