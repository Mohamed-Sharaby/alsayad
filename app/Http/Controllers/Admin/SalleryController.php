<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Http\Requests\PayrollRequest;
use App\Models\Admin;
use App\Models\Bonus;
use App\Models\Sallary;

class SalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Salaries', ['only' => ['index']]);
        $this->middleware('permission:Create Salaries', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Salaries', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Salaries', ['only' => ['destroy']]);
    }


    public function index()
    {
        return view('dashboard.sallaries.index', [
            'sallaries' => Sallary::with(['admin','admin.roles'])->latest()->get(),
        ]);
    }


    public function create()
    {
        return view('dashboard.sallaries.create', [
            'admins' => Admin::pluck('name', 'id')
        ]);
    }


    public function store(PayrollRequest $request)
    {
        $admin = Admin::findOrFail($request->admin_id);
        $validator = $request->validated();
        $admin->bonuses()->create($validator);
        return redirect(route('admin.sallaries.index'))->with('success', 'تم الاضافة بنجاح');
    }

    public function show(Sallary $sallary)
    {
        return view('dashboard.sallaries.show', [
            'sallary' => $sallary->load('admin.bonuses')
        ]);
    }


    public function edit(Expense $expense)
    {
        return view('dashboard.sallaries.edit', [
            'expense'=>$expense,
            'expenseItems'=>ExpenseItem::pluck('name', 'id'),
        ]);
    }


    public function update(ExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());
        return redirect(route('admin.sallaries.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Expense $expense)
    {
        $expense->delete();
        return 'Done';
    }
}
