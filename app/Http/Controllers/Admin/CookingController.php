<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CookingRequest;
use App\Models\Cooking;

class CookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Cooking', ['only' => ['index']]);
        $this->middleware('permission:Create Cooking', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Cooking', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Cooking', ['only' => ['destroy']]);
    }


    public function index()
    {
        return view('dashboard.cookings.index', [
            'cookings' => Cooking::latest()->get()
        ]);
    }


    public function create()
    {
        return view('dashboard.cookings.create');
    }


    public function store(CookingRequest $request)
    {
        Cooking::create($request->validated());
        return redirect(route('admin.cookings.index'))->with('success', 'تم الاضافة بنجاح');
    }


    public function edit(Cooking $cooking)
    {
        return view('dashboard.cookings.edit', [
            'cooking'=>$cooking
        ]);
    }


    public function update(CookingRequest $request, Cooking $cooking)
    {
        $cooking->update($request->validated());
        return redirect(route('admin.cookings.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Cooking $cooking)
    {
        $cooking->delete();
        return 'Done';
    }
}
