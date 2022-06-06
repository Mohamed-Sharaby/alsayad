<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseItem;
use App\Models\Payroll;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StorageInvoice;

class ReportController extends Controller
{
    public function getSalesReport()
    {
        $invoices = Sale::query()->with(['client', 'items', 'createdBy'])->latest();
        $invoices->when(\request('from') and \request('to'), function ($q) {
            $q->whereBetween('date', [\request('from'), \request('to')]);
        });

        return view('dashboard.reports.sales', [
            'invoices' => $invoices->get(),
            'total' => $invoices->sum('total'),
        ]);
    }

    public function getExpensesReport()
    {
        $expenses = Expense::query()->with('expenseItem');
        $expenses->when(\request('item'), function ($q) {
            $q->where('expense_item_id', \request('item'));
        });
        return view('dashboard.reports.expenses', [
            'expenses' => $expenses->get(),
            'expenseItems' => ExpenseItem::pluck('name', 'id'),
        ]);
    }

    public function getTaxReport()
    {
        $invoices = Sale::query()->with(['client', 'items', 'createdBy'])->latest();
        $invoices->when(\request('from') and \request('to'), function ($q) {
            $q->whereBetween('date', [\request('from'), \request('to')]);
        });

        return view('dashboard.reports.tax', [
            'invoices' => $invoices->get(),
            'totalTax' => $invoices->sum('tax')
        ]);
    }

    public function getSoldProductsReport()
    {
        $items = SaleItem::query()->with('product');
        $items->when(request()->has('product_id'), function ($q) {
            $q->where('product_id', \request('product_id'));
        });

        $items->when(\request('from') and \request('to'), function ($q) {
            $q->whereDate('created_at', '>=', \request('from'))->whereDate('created_at', '<=', \request('to'));
        });

        return view('dashboard.reports.sold-products', [
            'items' => $items->get(),
            'totalQuantity'=>$items->sum('quantity'),
            'totalPrice'=>$items->sum('total_product_price')
        ]);
    }

    public function getDailyReport()
    {
        $invoices = Sale::when(\request('date'), function ($q) {
            $q->whereDate('date', \request('date'));
        });
        $payrolls = Payroll::whereType('salary')->whereIsPaid(1)
            ->when(\request('date'), function ($q) {
                $q->whereDate('date', \request('date'));
            });
        $expenses = Expense::when(\request('date'), function ($q) {
            $q->whereDate('date', \request('date'));
        });
        $storage_invoices = StorageInvoice::whereType('in')
            ->when(\request('date'), function ($q) {
                $q->whereDate('date', \request('date'));
            });

        return view('dashboard.reports.daily', [
            'sales' => $invoices->sum('total'),
            'payrolls' => $payrolls->sum('amount'),
            'expenses' => $expenses->sum('amount'),
            'storage_invoices' => $storage_invoices->sum('total')
        ]);
    }


    public function getClientReport()
    {
        $invoices = Sale::query()->with(['client', 'items', 'createdBy'])->latest();
        $invoices->when(request()->has('client_id'), function ($q) {
            $q->where('client_id', \request('client_id'));
        });
        $invoices->when(\request('from') and \request('to'), function ($q) {
            $q->whereBetween('date', [\request('from'), \request('to')]);
        });

        return view('dashboard.reports.client', [
            'invoices' => $invoices->get(),
            'total' => $invoices->sum('total'),
            'debit' => $invoices->sum('remaining')
        ]);
    }


}
