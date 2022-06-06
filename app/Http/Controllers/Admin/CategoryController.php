<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Categories', ['only' => ['index']]);
        $this->middleware('permission:Create Categories', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Categories', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Categories', ['only' => ['destroy']]);
    }


    public function index()
    {
        return view('dashboard.categories.index', [
            'categories'=>Category::latest()->get()
        ]);
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect(route('admin.categories.index'))->with('success', 'تم الاضافة بنجاح');
    }


    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'category'=>$category
        ]);
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect(route('admin.categories.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return 'Done';
    }
}
