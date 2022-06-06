<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\StorageInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicePaidController extends Controller
{

    public function getPaidView($id)
    {
        return view('dashboard.storage-invoices.paid', [
            'invoice' => StorageInvoice::findOrFail($id)
        ]);
    }

    public function paidInvoice(Request $request, $id)
    {
        $invoice = StorageInvoice::findOrFail($id);
        DB::beginTransaction();

        $validator = $request->validate([
            'received' => 'required|numeric|min:1|max:' . $invoice->remaining,
            'paid_date' => 'required|date'
        ]);

        $invoice->update(['received' => $invoice->received + $validator['received']]);
        $invoice->pay($validator['paid_date'], $validator['received']);

        DB::commit();

        return redirect(route('admin.storage-invoices.index'))->with('success', 'تم السداد بنجاح');
    }


    public function getSalesPaidView($id)
    {
        $invoice = Sale::findOrFail($id);
        return view('dashboard.sales.paid', [
            'invoice' => $invoice,
            'remaining' => $invoice->is_points == 1 ?
                (number_format($invoice->remaining - $invoice->points_paid, 2)) : number_format($invoice->remaining, 2),
        ]);
    }

    public function paidSalesInvoice(Request $request, $id)
    {
        $invoice = Sale::findOrFail($id);
        DB::beginTransaction();

        $validator = $request->validate([
            'received' => 'required|numeric|min:1|max:' . $invoice->remaining,
            'paid_date' => 'required|date'
        ]);

        $invoice->update([
            'received' => $invoice->received + $validator['received'],
            'status' => $request->received == $invoice->remaining ? 'paid' : 'partially',
        ]);
        $invoice->pay($request->paid_date, $request->received, auth()->id());

        DB::commit();

        return redirect(route('admin.sales.index'))->with('success', 'تم السداد بنجاح');
    }

}
