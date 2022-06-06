<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ClientsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Clients', ['only' => ['index']]);
        $this->middleware('permission:Create Clients', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Clients', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Clients', ['only' => ['destroy']]);
    }


    public function index(ClientsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.clients.index');
    }


    public function create()
    {
        return view('dashboard.clients.create');
    }


    public function store(ClientRequest $request)
    {
        Client::create($request->validated());
        return redirect(route('admin.clients.index'))->with('success', 'تم الاضافة بنجاح');
    }


    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', [
            'client' => $client
        ]);
    }


    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return redirect(route('admin.clients.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Client $client)
    {
        $client->delete();
        return 'Done';
    }
}
