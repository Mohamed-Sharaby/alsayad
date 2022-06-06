<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ExpenseItemRequest;
use App\Models\Category;
use App\Models\ExpenseItem;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ExpenseItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show ExpensesItems', ['only' => ['index']]);
        $this->middleware('permission:Create ExpensesItems', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit ExpensesItems', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete ExpensesItems', ['only' => ['destroy']]);
    }


    public function index()
    {
        return view('dashboard.expense-items.index', [
            'expenses' => ExpenseItem::latest()->get()
        ]);
    }


    public function create()
    {
        return view('dashboard.expense-items.create');
    }


    public function store(ExpenseItemRequest $request)
    {
        ExpenseItem::create($request->validated());
        return redirect(route('admin.expense-items.index'))->with('success', 'تم الاضافة بنجاح');
    }


    public function edit(ExpenseItem $expenseItem)
    {
        return view('dashboard.expense-items.edit', [
            'expenseItem' => $expenseItem
        ]);
    }


    public function update(ExpenseItemRequest $request, ExpenseItem $expenseItem)
    {
        $expenseItem->update($request->validated());
        return redirect(route('admin.expense-items.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(ExpenseItem $expenseItem)
    {
        $expenseItem->delete();
        return 'Done';
    }
}
