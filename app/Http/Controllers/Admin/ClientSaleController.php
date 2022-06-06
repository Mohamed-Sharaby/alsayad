<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Sale;
use App\Models\StorageInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientSaleController extends Controller
{

    public function __invoke(Client $client)
    {
        return view('dashboard.clients.sales', [
            'client' => $client,
            'sales' => Sale::whereClientId($client->id)->get()
        ]);
    }

}
