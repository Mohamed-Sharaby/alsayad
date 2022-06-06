<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Products', ['only' => ['index']]);
        $this->middleware('permission:Create Products', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Products', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Products', ['only' => ['destroy']]);
    }


    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.products.index');
    }


    public function create()
    {
        return view('dashboard.products.create', [
            'categories' => Category::active()->pluck('name', 'id'),
            'units' => Unit::active()->pluck('name', 'id'),
            'materials' => Product::materials()->active()->with('unit')->pluck('name', 'id'),
        ]);
    }


    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        /** @var \App\Models\Product $product */

        $product = Product::query()->create($request->validated());
        if ($request->type == 'made') {
            $product->productMaterials()->attach($request->material);
//            $product->addStartStorageInvoice($request->start_quantity);
//            $product->discountMaterialQuantitiesOfMadeProduct($request->material);
        }

        DB::commit();
        return redirect(route('admin.products.index'))->with('success', 'تم الاضافة بنجاح');
    }

    public function show(Product $product)
    {
        return view('dashboard.products.show', [
            'product' => $product->load('productMaterials.unit')
        ]);
    }


    public function edit(Product $product)
    {
        return view('dashboard.products.edit',
            [
                'product' => $product,
                'categories' => Category::pluck('name', 'id'),
                'units' => Unit::pluck('name', 'id'),
                'materials' => Product::materials()->with('unit')->pluck('name', 'id')
            ]);
    }


    public function update(ProductRequest $request, Product $product)
    {
        DB::beginTransaction();
        $product->update($request->validated());
        if ($request->image) {
            if ($product->image) {
                $image = str_replace(url('/') . '/storage/uploads/', '', $product->image);
                deleteImage('uploads', $image);
            }
        }

        if ($request->type == 'made') {
            $product->productMaterials()->sync($request->material);
        }
        DB::commit();

        return redirect(route('admin.products.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return 'Done';
    }
}
