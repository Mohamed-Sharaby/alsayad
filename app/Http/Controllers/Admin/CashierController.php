<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;

class CashierController extends Controller
{


    public function index()
    {
        return view('dashboard.cashiers.index', ['cashiers' => Cashier::latest()->get()]);
    }


    public function create()
    {
        return view('dashboard.cashiers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191'
        ]);
        Cashier::create($request->all());
        return redirect(route('admin.cashiers.index'))->with('success', 'تم الاضافة بنجاح');
    }


    public function edit(Cashier $cashier)
    {
        return view('dashboard.cashiers.edit', compact('cashier'));
    }


    public function update(Request $request, Cashier $cashier)
    {
        $request->validate([
            'name' => 'required|string|max:191'
        ]);
        $cashier->update($request->all());
        return redirect(route('admin.cashiers.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Cashier $cashier)
    {
        $cashier->delete();
        return 'Done';
    }
}
