<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\ExpenseItem;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Expenses', ['only' => ['index']]);
        $this->middleware('permission:Create Expenses', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Expenses', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Expenses', ['only' => ['destroy']]);
    }


    public function index()
    {
        $expenses = Expense::query()->with('expenseItem');

        $expenses->when(\request('item'), function ($q) {
            $q->where('expense_item_id', \request('item'));
        });
        $expenses->when(\request('from') and \request('to'), function ($q) {
            $q->whereBetween('date', [\request('from'),\request('to')]);
        });

        return view('dashboard.expenses.index', [
            'expenses' => $expenses->get(),
            'expenseItems' => ExpenseItem::pluck('name', 'id'),
        ]);
    }


    public function create()
    {
        return view('dashboard.expenses.create', [
            'expenseItems' => ExpenseItem::pluck('name', 'id')
        ]);
    }


    public function store(ExpenseRequest $request)
    {
        Expense::create($request->validated());
        return redirect(route('admin.expenses.index'))->with('success', 'تم الاضافة بنجاح');
    }


    public function edit(Expense $expense)
    {
        return view('dashboard.expenses.edit', [
            'expense'=>$expense,
            'expenseItems'=>ExpenseItem::pluck('name', 'id'),
        ]);
    }


    public function update(ExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());
        return redirect(route('admin.expenses.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Expense $expense)
    {
        $expense->delete();
        return 'Done';
    }
}
