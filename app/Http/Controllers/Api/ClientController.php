<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::active()->get();
        return response()->json(ClientResource::collection($clients));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'phone' => 'required|numeric|unique:clients,phone',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'created_by' => 'nullable|numeric|exists:admins,id',
        ]);
        $data['points'] = 0;
        $data['created_by'] = auth()->id();
        $client = Client::create($data);
        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة العميل بنجاح',
            'id'=>$client->id,
            'name'=>$client->name
        ]);
    }


}
