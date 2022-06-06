<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;
use App\Models\Unit;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Units', ['only' => ['index']]);
        $this->middleware('permission:Create Units', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Units', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Units', ['only' => ['destroy']]);
    }


    public function index()
    {
        $units = Unit::latest()->get();
        return view('dashboard.units.index', compact('units'));
    }


    public function create()
    {
        return view('dashboard.units.create');
    }


    public function store(UnitRequest $request)
    {
        Unit::create($request->validated());
        return redirect(route('admin.units.index'))->with('success', 'تم الاضافة بنجاح');
    }


    public function edit(Unit $unit)
    {
        return view('dashboard.units.edit', compact('unit'));
    }


    public function update(UnitRequest $request, Unit $unit)
    {
        $unit->update($request->validated());
        return redirect(route('admin.units.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Unit $unit)
    {
        $unit->delete();
        return 'Done';
    }
}
