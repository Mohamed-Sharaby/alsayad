<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\Sale;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{

    public function index()
    {
        if (auth()->user()->hasOpenShift()) {
            return view('dashboard.sales.create');
        } else {
            $cashiers = Cashier::query()->with('last_receive:id,remaining')
                // ->whereDoesntHave('last_shift')
                ->get();

            return view('dashboard.shifts.index', compact('cashiers'));
        }
    }


    public function create()
    {
//        $cashiers = Cashier::query()->with('last_receive:id,remaining')
//            ->whereRelation('last_shift', 'is_open', 0)->get();
//        dd($cashiers);
//        return view('dashboard.shifts.create', compact('cashiers'));
    }


    public function store(Request $request)
    {
        // create shift
        $shift = auth()->user()->shifts()->create([
            'cashier_id' => $request->cashier_id,
            'start_at' => now(),
        ]);
        // add shift id to cashier last_shift_id
        $cashier = Cashier::findOrFail($request->cashier_id);
        $cashier->update(['last_shift_id' => $shift->id]);
        //redirect to create sales
        return view('dashboard.sales.create');
    }

    public function edit(Shift $shift)
    {

        $totalShift = Sale::whereRelation('transactions', 'created_by', auth()->id())
            ->whereHas('transactions', function ($q) use ($shift) {
                return $q->whereBetween('created_at', [$shift->start_at, now()]);
            })
            ->sum('received');
        $cashierRemaining = optional($shift->cashier->last_receive)->remaining;

        return view('dashboard.shifts.finish-shift', [
            'shift' => $shift,
            'total' => $totalShift + $cashierRemaining,
        ]);
    }

    public function update(Request $request, Shift $shift)
    {
        DB::beginTransaction();
        $request->validate([
            'total' => 'required|numeric',
            'delivered' => 'required|numeric|min:1|max:' . $request->total,
        ]);

        // $request->deliviered
        //finish shift  $shift->finish($delivered)
        $receiving = $shift->receiving()->create([
            'cashier_id' => $shift->cashier_id,
            'total' => $request->total,
            'delivered' => $request->delivered,
        ]);
        $shift->cashier()->update([
            'last_receive_id' => $receiving->id
        ]);
        $shift->update([
            'receiving_id' => $receiving->id,
            'end_at' => now()
        ]);
        //redirect to the dashboard
        DB::commit();

        return redirect()->route('admin.sales.index')->with('success', 'تم تسليم الخزنة بنجاح');
    }
}
