<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\Receiving;
use Illuminate\Http\Request;

class ReceivingController extends Controller
{


    public function index()
    {
        return view('dashboard.receiving.index', ['records' => Receiving::with('shift.admin')->latest()->get()]);
    }


    public function destroy(Receiving $receiving)
    {
        $receiving->delete();
        return 'Done';
    }
}
