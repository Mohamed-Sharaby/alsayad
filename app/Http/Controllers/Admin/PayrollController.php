<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayrollRequest;
use App\Models\Admin;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Salaries', ['only' => ['index']]);
        $this->middleware('permission:Create Salaries', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Salaries', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Salaries', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $admin = Admin::findOrFail($request->admin);
        /////////////////////////
        $increases = Payroll::whereAdminId($admin->id)->where('type', 'increase')
            ->whereMonth('date', now()->month)->sum('amount');
        $deductions = Payroll::whereAdminId($admin->id)->where('type', 'deduction')
            ->whereMonth('date', now()->month)->sum('amount');
        $totalCurrentMonth = ($admin->salary + $increases) - $deductions;
        ///////////////////////////
        return view('dashboard.payrolls.index', [
            'admin' => $admin,
            'payrolls' => Payroll::whereAdminId($admin->id)->where('type', 'salary')->latest()->get(),
            /////////////////////
            'current_increases' => $increases,
            'current_deductions' => $deductions,
            'total' => $totalCurrentMonth,
        ]);
    }


    public function create(Request $request)
    {
        return view('dashboard.payrolls.create', [
            'admin' => Admin::findOrFail($request->admin)
        ]);
    }


    public function store(PayrollRequest $request)
    {
        $admin = Admin::findOrFail($request->admin_id);
        $date = Carbon::parse(request()->date);
        DB::beginTransaction();
        $validator = $request->validated();
        if ($request->type == 'salary') {
            $increases = Payroll::whereAdminId($admin->id)->where('type', 'increase')
                ->whereMonth('date', $date->month)->sum('amount');
            $deductions = Payroll::whereAdminId($admin->id)->where('type', 'deduction')
                ->whereMonth('date', $date->month)->sum('amount');
            $validator['monthly_total'] = ($admin->salary + $increases) - $deductions;
        }
        $admin->payrolls()->create($validator);
        DB::commit();
        return redirect(route('admin.payrolls.index', ['admin' => $admin->id]))->with('success', 'تم الاضافة بنجاح');
    }

    public function show(Payroll $payroll)
    {
        return view('dashboard.payrolls.show', [
            'payroll' => $payroll
        ]);
    }


    public function edit($payroll_id)
    {
        return view('dashboard.payrolls.edit', [
            'payroll' => Payroll::findOrFail($payroll_id)
        ]);
    }

    public function update(PayrollRequest $request, $id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->update($request->validated());
        return redirect(route('admin.payrolls.index', ['admin' => $payroll->admin_id]))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy($id)
    {
        Payroll::findOrFail($id)->delete();
        return 'Done';
    }

    public function getAdds()
    {
        $date = Carbon::parse(request()->date);
        $month_payroll = Payroll::query()
            ->whereYear('date', $date->year)
            ->whereMonth('date', $date->month)
            ->where('admin_id', request()->admin_id)
            ->get();
        $total_increases = $month_payroll->where('type', 'increase')->sum('amount');
        $total_deduction = $month_payroll->where('type', 'deduction')->sum('amount');
        return [
            'details' => $month_payroll,
            'has_paid_salary' => (bool)$month_payroll->where('type', 'salary')->count(),
            'total_increases' => $total_increases,
            'total_deduction' => $total_deduction,
        ];
    }
}
