<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Show Admins', ['only' => ['index']]);
        $this->middleware('permission:Create Admins', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Admins', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Admins', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        return view('dashboard.admins.index', [
            'admins' => Admin::with(['roles'])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $superAdminRole = Role::whereName('Super Admin')->first();
        return view('dashboard.admins.create', [
            'roles' => Role::where('id', '!=', $superAdminRole->id)->where('is_active', '1')->get()->pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     */
    public function store(AdminRequest $request)
    {
        $validator = $request->validated();
        $validator['is_active'] = 1;

        $roles = $validator['roles'] ?? [];
        unset($validator['roles']);

        DB::beginTransaction();

        $admin = Admin::create($validator);
        $admin->syncRoles($roles);

        DB::commit();
        return redirect(route('admin.admins.index'))->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return
     */
    public function edit($id)
    {
        $superAdminRole = Role::whereName('Super Admin')->first();
        return view('dashboard.admins.edit', [
            'admin' => Admin::findOrFail($id),
            //'roles' => Role::where('id', '!=', $superAdminRole->id)->get()->pluck('name', 'id')
            'roles' => Role::pluck('name', 'id')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return
     */
    public function update(AdminRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $validator = $request->validated();

        $roles = $validator['roles'] ?? [];
        unset($validator['roles']);
        DB::beginTransaction();
        $admin->syncRoles($roles);
        $admin->update($validator);
        DB::commit();
        return redirect(route('admin.admins.index'))->with('success', 'تم التعديل بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        if (auth()->user()->id == $admin->id) {
            return redirect(route('admin.admins.index'))->with('error', 'عفوا ... لا يمكنك حذف العضوية الخاصة بك');
        }

        $admin->delete();
        return 'Done';
    }
}
